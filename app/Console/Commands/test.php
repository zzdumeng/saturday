<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play:jwt';

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
        $a = [3,4,5,6,7,8];

        $carts = \App\Models\Cart::all()->toArray();
        $ps = \App\Models\Product::all()->toArray();
        for ($i=0; $i < 10; $i++) { 
            # code...
            echo array_random($carts)['id']."\n";
        }
    }
        //

        // $token = (new Builder())
        //     // ->setAudience('http://example.org') // Configures the audience (aud claim)
        //     // ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
        //     // ->setIssuedAt(time()) // Configures the time that the token was issued (iat claim)
        //     // ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
        //     // ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
        //     ->set('uid', 1) // Configures a new claim, called "uid"
        //     ->getToken(); // Retrieves the generated token

        // $token->getHeaders(); // Retrieves the token headers
        // $token->getClaims(); // Retrieves the token claims

        // // echo $token->getHeader('jti'); // will print "4f1g23a12aa"
        // // echo $token->getClaim('iss'); // will print "http://example.com"
        // echo $token->getClaim('uid'); // will print "1"
        // echo $token; // The string representation of the object is a JWT string (pretty easy, right?)
        // $signer = new Sha256();
// $signer = new Sha256();
// $token = (new Builder())->setIssuer('http://example.com') // Configures the issuer (iss claim)
//                         ->setAudience('http://example.org') // Configures the audience (aud claim)
//                         ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
//                         ->setIssuedAt(time()) // Configures the time that the token was issued (iat claim)
//                         ->setNotBefore(time() + 60) // Configures the time that the token can be used (nbf claim)
//                         ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
//                         ->set('uid', 1) // Configures a new claim, called "uid"
//                         ->sign($signer, 'testing') // creates a signature using "testing" as key
//                         ->getToken(); // Retrieves the generated token


// var_dump($token->verify($signer, 'testing 1')); // false, because the key is different
// var_dump($token->verify($signer, 'testing')); // true, because the key is the same
//     }
}
