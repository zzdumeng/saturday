<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\Product;

class seeddb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 10000; $i++) {
                Product::where('id', $i)
                ->update(['sales' => mt_rand(5, 10000), 'rating' => $faker->randomFloat(2, 2, 5)]);
            # code...
        }
        // $addrs = Address::where('addressable_type', 'sellers')
        // ->get()
        // ->toArray();
        // $x = 1;
        // foreach ($addrs as $add ) {
        //     Address::where('id', $add['id'])
        //     ->update(['addressable_id' => $x]);
        //     $x = $x+1;
        //     echo $x;
        // }
        // Point::where('id', '>', 0)
        //     ->update(['created_at' =>
        //         function () use ($faker) {
        //             return $faker->date();
        //         },
        //         'updated_at' => function () use ($faker) {
        //             return $faker->date();
        //         },
        //     ]);
    }
}
