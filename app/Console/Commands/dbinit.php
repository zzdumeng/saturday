<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;

class dbinit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

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
        $a = ['苹果', '橘子', '🍌'];
        foreach ($a as $p) {
            # code...
            $pro = new Product;
            $pro->title = $p;
            $pro->description = $p;
            $pro->price = rand();
            $pro->save();
        }
    }
}
