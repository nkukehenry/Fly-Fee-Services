<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class CouponController extends Controller
{
    public function coupon()
    {
        $data['page_title'] = "Coupon List";
        $data['coupons'] = Coupon::select('id','code','reduce_fee')->latest()->whereNull('used_at')->paginate(config('basic.paginate'));
        return view('admin.coupon.index',$data);
    }
    public function couponUsed()
    {
        $data['page_title'] = "Used Coupon List";
        $data['coupons'] = Coupon::select('id','code','reduce_fee','user_id','used_at')->latest()->whereNotNull('user_id')->with(['user:id,username,email'])->paginate(config('basic.paginate'));
        return view('admin.coupon.used',$data);
    }

    public function store(Request $request)
    {
        $excp = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'level' => 'required|numeric',
            'reduce_fee' => 'required|numeric'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        for($i=0 ; $i < $excp['level']; $i++ ){
            $data = new  Coupon();
            $data->code = code(6);
            $data->reduce_fee = (float) $excp['reduce_fee'];
            $data->used_at = null;
            $data->save();
        }


        return back()->with('success', $excp['level'] .' '.'Coupons Has Been Added.');
    }
}
