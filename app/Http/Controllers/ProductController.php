<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    // public function tags() {
    //     return $this->hasMany('App\Models\Tag');
    // }

    public function show(Request $req, $id)
    {
        $p = Product::with('seller')->find($id);
        return $p;
    }

    public function getReviews(Request $req, $id)
    {
        // $page = $req->query('page', 1);
        // $rs = Product::with(array('reviews'=> function($query) {
        //     $query->orderBy('created_at', 'DESC')->paginate(10);
        // }))->find($id)->get();
        // $rs = Product::with('pagedReviews')->find($id)->get();
        $rs = Product::find($id);
        // $rs->paged_reviews;
        // return $rs;
        return $rs->paged_reviews;
    }
    public function search2(Request $req)
    {

        $kw = $req->query('q');
        $query = Product::query();
        if ($kw) {
            $query->orWhere('name', 'like', '%' . $kw . '%');
            $query->orWhere('digest', 'like', '%' . $kw . '%');
        }
        // categories
        $cs = $req->input('categories');
        if ($cs) {
            $query->join('category_product', 'category_product.product_id', '=', 'products.id')
                ->whereIn('category_product.category_id', $cs);
        }

        $sort = $req->query('sort') ?? 'sales';
        $filter = $req->query('filter') ?? 'all';
        if($filter=='next') {
            $query->where('delivery', 1);
        }


        if($sort == 'sales')
        $order = 'DESC';
        if($sort == 'rating')
        $order = 'DESC';

        // if($sort!='priceup' && $sort != 'pricedown') {
        //     $query->orderBy($sort, $order);
        // }
        // return [$sort, $filter];
        
        if ($sort == 'priceup') {
            $order = 'ASC';
        } else if ($sort == 'pricedown') {
            $order = 'DESC';
        }
        if ($sort == 'priceup' || $sort == 'pricedown') {
            $query->orderByRaw('specs->"$[0].current_price" '.$order );
        } else {
            $query->orderBy($sort, $order);
        }

        $result = $query->paginate(8);
        return $result;
    }
    /**
     * The query may cantains :
     * q? :: the keyword to search
     * page? :: the page, default to 1
     * category[]? :: can contain
     * sort? :: [priceup, pricedown, sales, rating], default to sales
     * filter? :: [all, nextday], default to all
     */
    public function search(Request $req)
    {
        $count = 8;
        $kw = $req->query('q');
        // if (!$kw) {
        //     return [error => 1, message => 'keyword can not be empty'];
        // }

        $categories = $req->query('categories', []);
        $page = $req->query('page', 1);
        $sort = $req->query('sort', 'sales');
        $filter = $req->query('filter', 'all');
        $order = 'DESC';
        if ($sort == 'priceup') {
            $sort = 'current_price';
            $order = 'ASC';
        } else if ($sort == 'pricedown') {
            $sort = 'current_price';
            $order = 'DESC';
        }
        $cw = [];
        // if($categories) {
        //     $cw =
        // }
        if ($kw) {
            $w = [];
            $qq = ['name', 'like', '%' . $kw . '%'];
            array_push($w, $qq);
            $w2 = [];
            array_push($w2, ['digest', 'like', '%' . $kw . '%']);
            if ($filter == 'nextday') {
                array_push($w, ['delivery', '=', 1]);
                array_push($w, ['delivery', '=', 1]);
            }
            $builder = Product::where($w)
                ->orWhere($w2);
        } else {
            if ($filter == 'nextday') {
                $div = ['delivery', '=', 1];
            }
            $w = [];
            array_push($w, ['id', '>', 0]);
            if ($filter == 'nextday') {
                $div = ['delivery', '=', 1];
                array_push($w, $div);
            }
            $builder = Product::where($w);
        }
        // return [$div, $qq];
        $ps = $builder->orderBy($sort, $order)
            ->paginate(8);
        // ->skip($count * ($page - 1))
        // ->limit($count)
        // ->get();

        return $ps;
    }
    // public function searchKeyword($kw, ) {
    //     $ps = Product::where('name', 'like', '%' . $kw . '%')
    //         ->orWhere('digest', 'like', '%' . $kw . '%')
    //         ->
    // }
    public function category()
    {
        // Product::f

    }
    public function test(Request $req)
    {
        // Product::where(['name', 'like', '%a%']);
        $items = $req->input('items');
        $i1 = $items[0];
        $i1['price'] = 30;
        $items[0]['sdf'] = 20;
        for ($i = 0; $i < count($items); $i++) {
            $items[$i]['price'] = 30;
        }
        // foreach ($items as $item) {
        //     $item['x'] = 3;
        // }
        return $items;
        // return $i1;
    }
}
