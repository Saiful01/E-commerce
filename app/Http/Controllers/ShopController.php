<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return Redirect::to('/admin/login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        return view('admin.pages.shop.setting')
            ->with('shop', Shop::first());
    }


    public function edit(Shop $shop)
    {
        //
    }


    public function update(Request $request, Shop $shop)
    {

        if ($request->hasFile('shop_logo')) {
            $image = $request->file('shop_logo');
            $logo = "logo1." . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/shop');
            $image->move($destinationPath, $logo);
        } else {
            $logo = 'default.jpg';
        }
        $shop_id = $request['shop_id'];
        try {
            Shop::where('shop_id', $shop_id)->update($request->except('shop_id', '_token', 'shop_logo') + ['shop_logo' => $logo]);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }

}
