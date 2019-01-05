<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Footprint;
use App\Models\Message;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class MeController extends Controller
{

    // retrieve my information
    public function getOrders(Request $req)
    {
        $user = auth()->user();
        $filter = $req->input('filter') ?? 'all';
        $map = ['all' => [0],
            'to-pay' => [0],
            'to-ship' => [1],
            'to-confirm' => [2],
            'to-review' => [4],
            'finished' => [5, 10, 11]];
        $status = $map[$filter];
        // $page = $req->input('page') || 1;
        $query = User::find($user->id)
            ->orders()->with(['items', 'seller']);
        if ($filter != 'all' && $status) {
            $query = $query->whereIn('status', $status);
        }
        return $query->paginate(10);
    }
    public function test(Request $req)
    {
        return User::find(1)->favorites;
        // $query = User::find(1)
        //     ->orders()->with(['items', 'seller'])->where('status', '=', $req->input('status'));
    }
    public function getMessages(Request $req)
    {
        $user = auth()->user();
        // $page = $req->input('page') || 1;
        return User::find($user->id)
            ->paged_messages;
        // return Message::where('user_id', $user->id)
        // ->sort('created_at', 'DESC')
        // ->skip(($page-1)*10)
        // ->limit(10)
        // ->get();
        // return
    }
    public function getMessage($id)
    {
        return Message::find($id);
    }

    public function deleteMessage(Request $req)
    {
        $id = $req->input('id');
        return Message::where('id', $id)
            ->delete();
    }
    public function updateMessageStatus(Request $req)
    {
        $id = $req->input('id');
        $status = $req->input('status');
        return Message::where('id', $id)
            ->update(['status' => $status]);
    }
    public function getPoints(Request $req)
    {

        $user = auth()->user();
        return User::find($user->id)
            ->paged_points;
    }
    public function getAddresses(Request $req)
    {
        $user = auth()->user();
        return User::find($user->id)
            ->addresses();
    }
    public function getFootprints(Request $req)
    {
        $user = auth()->user();
        return User::find($user->id)
            ->paged_footprints;
    }
    public function getBills(Request $req)
    {
        $user = auth()->user();
        return User::find($user->id)
            ->paged_bills;
    }
    // profile
    public function updateProfile(Request $req)
    {
        // $validated = Validator::make($req->all(),[
        //     'name' => '',
        //     'birthday' => 'date|nullable',
        //     'sex' => 'in:0,1,2'
        // ]);
        // if($validated->fails()) {
        //     return ['error' => 1, 'message' => $validated->errors()];
        // }
        $avatar = $req->file('avatar');
        $user = auth()->user();
        $in = $req->all();
        // return $in;
        # save the file to avatar diretory
        if ($avatar) {
            $path = $avatar->store('public/avatars');
            $path = '/storage/' . preg_replace('/^public\//', '', $path);
        }
        # update database
        $updates = ['name' => $in['name'],
            'sex' => $in['sex']];
        if (isset($in['birthday'])) {
            $updates['birthday'] = $in['birthday'];
        }

        if ($avatar) {
            $updates['avatar'] = $path;
        }

        User::where('id', $user->id)->update($updates);
        return User::find($user->id);

    }
    public function changeMobile(Request $req)
    {
        $user = auth()->user();
        return User::where('id', $user->id)->update(['mobile' => $req->input('mobile')]);
    }
    public function modifyPassword(Request $req)
    {
        $pw = $req->input('password');
        try {
            User::where('id', auth()->user()->id)->update(['password' => bcrypt($pw)]);
            return ['success' => 1];
        } catch (Exception $ex) {
            return ['error' => 1];
        }
    }
    // address
    public function addAddress(Request $req)
    {
        // $in = $req->input();
        // list($p) = [$in->province, $in->region, $in->city, $in->detail];
        $default = $req->input('isDefault');
        $in = $req->input();
        try {
            $addr = Address::create(
                ['contact' => $in->contact,
                    'detail' => $in->detail,
                    'province_id' => $in->province,
                    'region_id' => $in->region,
                    'city_id' => $in->city,
                    'mobile' => $in->mobile,
                    'phone' => $in->phone,
                ]
            );
            if ($default) {
                User::where('id', auth()->user()->id)->update(['default_address' => $addr->id]);
            }

        } catch (Exception $ex) {
            return ['error' => 1];
        }
        return $addr;
    }
    public function updateAddress(Request $req)
    {
        $id = $req->input('address_id');

        Address::where('id', $id)
            ->update(['contact' => $in->contact,
                'detail' => $in->detail,
                'province_id' => $in->province,
                'region_id' => $in->region,
                'city_id' => $in->city,
                'mobile' => $in->mobile,
                'phone' => $in->phone,
            ]);
    }

    public function deleteAddress(Request $req)
    {
        return Address::where('id', $req->input('address_id'))->delete();
    }

    public function setDefaultAddress(Request $req)
    {
        # TODO: should check if the address exists
        $id = $req->input('address_id');
        if (!Address::find($id)) {
            return ['error' => 1];
        }

        $user = auth()->user();
        try {
            User::where('id', $user->id)->update(['default_address' => $id]);
            return [success => 1];
        } catch (Exception $ex) {
            return ['error' => 1];
        }
    }

    // footprint
    public function addFootprint(Request $req)
    {
        $user = auth()->user();
        return Footprint::create(['user_id' => $user->id,
            'product_id' => $req->input('product_id')]);
    }
    public function deleteFootprint(Request $req)
    {
        $id = $req->input('footprint_id');
        return Footprint::where('id', $id)->delete();
    }

    // order
    public function addOrder(Request $req)
    {
        $user = auth()->user();
        $items = $req->input('items');
        $pids = [];
        foreach ($items as $item) {
            array_push($pids, $item['product_id']);
        }

        $order = Order::create(['user_id' => $user->id,
            status => 0]);
        $order->items()->saveMany(
            $items
        );
        // and remove the items in cartitems
        CartItem::where('user_id', '=', $user->id)
            ->whereIn('product_id', $pids)
            ->delete();
        return $order;
    }

    public function payOrder(Request $req)
    {
        $order = Order::where('id', $req->input('order_id'))
            ->update(['status' => 1]);
        return $order;
    }
    public function cancelOrder(Request $req)
    {
        $r = Order::where('id', $req->input('order_id'))
            ->update(['status' => 11]);
        return $r;
    }
    public function deleteOrder(Request $req)
    {
        return Order::where('id', $req->input('order_id'))->delete();
    }
    /**
     * confirm the orde has delivered
     */
    public function confirmOrder(Request $req)
    {
        # code...
        $r = Order::where('id', $req->input('order_id'))
            ->update(['status' => 4]);
        return $r;
    }
    // cart
    public function getCartItems(Request $req)
    {
        $user = User::find(auth()->user()->id)->with('cartitems');
        return $user->cartitems;
    }
    public function addCartItem(Request $req)
    {
        # [product_id,]
        // create a new cart item
        $user = auth()->user();
        $item = CartItem::create(['user_id' => $user->id,
            'product_id' => $req->input('item.product_id'),
            'quantity' => $req->input('item.quantity'),
            'spec' => $req->input('item.spec')]);
        return ['id' => $item->id];
    }
    /**
     * NOTE: this is a method to remove an array of itemsj
     */
    public function deleteCartItem(Request $req)
    {
        $ids = $req->input('items');
        return CartItem::whereIn('id',$ids)
            ->delete();

    }
    public function alterCartItem(Request $req)
    {
        $quantity = $req->input('quantity');
        $id = $req->input('id');
        return CartItem::where('id', $id)->update(['quantity' => $quantity ]);
    }

    // favorites
    public function getFavorites() {
        return User::find(auth()->user()->id)->favorites;
    }
    /**
     * {favorites: [product_id]}
     */
    public function addFavorites(Request $req) {
        $favs = $req->input('favorites');
        $user= auth()->user();
        $result = [];
        foreach ($favs as $fav ) {
            Favorite::create(['product_id' => $fav,
            'user_id' => $user->id]);
        }
        return ;
    }
    /** 
     * {favorites: [id, id,]}
     * note: and are product ids 
     */
    public function deleteFavorites(Request $req) {
        $pids = $req->input('favorites');
        Favorite::whereIn('product_id', $pids)->delete();
        return ;
    }
}
