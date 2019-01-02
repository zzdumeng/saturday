<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        App\Models\Address::truncate();
        (new Faker\Generator)->seed(123);
        $users = App\Models\User::all()->toArray();

        # for each use , create 5 addresses and set one as default
        foreach ($users as $key => $user) {
            # code...

            $addrs = factory(App\Models\Address::class, 5)->create(
                ['addressable_type' => 'user',
                    'addressable_id' => $user['id']]
            );
            App\Models\User::where('id', $user['id'])->update(['default_address'=>$addrs[0]['id']]);
        }
        // factory(App\Models\Address::class, 200)->create(
        //     ['addressable_type' => 'user',
        //     'addressable_id' => function() use($users) {
        //         srand();
        //         return $users[array_rand($users)]['id'];
        //     }]
        // );
        // $addrs = App\Models\Address::all()->toArray();
        // foreach ($users as $key =>$user  ) {
        //     # select an address as default address
        //     App\Models\User::where('id', $user['id'])->update(['default_address'=>$addrs[$key]['id']]);
        // }
    }
}
