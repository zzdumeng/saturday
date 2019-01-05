<?php

namespace App\Console\Commands;

use App\Models\Point;
use App\Models\Seller;
use App\Models\Address;
use Illuminate\Console\Command;

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
        $addrs = Address::where('addressable_type', 'sellers')
        ->get()
        ->toArray();
        $x = 1;
        foreach ($addrs as $add ) {
            Address::where('id', $add['id'])
            ->update(['addressable_id' => $x]);
            $x = $x+1;
            echo $x;
        }
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
