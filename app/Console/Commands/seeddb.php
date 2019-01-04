<?php

namespace App\Console\Commands;

use App\Models\Point;
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
        $points = Point::all()->toArray();

        for ($i=1; $i <= 440; $i++) { 
            Point::where('id', $i)
            ->update([
                'created_at' => $faker->date(),
                'updated_at' => $faker->date(),
            ]);
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
