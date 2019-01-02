<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Footprint;
use App\Models\User;
use Illuminate\Http\Request;

class MeController extends Controller
{
    // profile
    public function updateProfile(Request $req)
    {
        $avatar = $req->file('avatar');
        $user = auth()->user();
        $in = $req->input();
        # save the file to avatar diretory
        if ($avatar) {
            $path = $avatar->store('avatars');
        }
        # update database
        $updates = ['name' => $in->name,
            'birthday' => $in->birthday,
            'sex' => $in->sex];
        if($avatar) $updates['avatar'] = $path;
        return User::where('id', $user->id)->update($updates);

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
}
