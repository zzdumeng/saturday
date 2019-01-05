<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Address;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function __invoke(Request $req)
    {
        $sort = $req->input('sort');
        $q = Seller::with(['addresses']);
        if ($sort) {
            $q->orderBy($sort, 'ASC');
        }

        return $q->paginate(12);
        // $query = Seller::query()->with('addresses');
        // $query->join('products', 'products.id', '=', 'seller.id')

    }
    public function test() {
        // return Seller::with('addresses')->find(1)->addresses;
        return Address::find(1)->addressable;
    }
}
