<?php
namespace App\Console\Commands;
// require_once __DIR__.'../../../vendor/fzaninotto/faker/src/autoload.php';

use App\Models\Product;
use App\Models\Review;
use Illuminate\Console\Command;
use Faker\Factory as Faker;
use Faker\Generator as Generator;

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
    public function initProduct()
    {

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
    public function initReview()
    {
        $product = Product::find()->first();
        for ($i = 0; $i < 3; $i++) {
            $r = new Review();
            $r->content = '1111';
            $r->product_id = $product->id;
            $r->save();
        }
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        // $this->initProduct();
        // $this->initReview();
        $generator = Faker::create();
        $populator = new \Faker\ORM\Eloquent\Populator($generator);
        $populator->addEntity('App\Models\Product', 5);
        // $populator->addEntity('Book', 10);
        $insertedPKs = $populator->execute();
    }
}
