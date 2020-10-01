<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PromoController extends Controller
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

    public function create()
    {
        return view('admin.pages.promo.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'promo_code' => 'required',
            'discount_rate' => 'required',
            'max_discount' => 'required',
        ]);

        unset($request['_token']);
        try {
            Promo::create($request->all());
            return back()->with('success', "Successfully created");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function show(Promo $promo)
    {
        return view('admin.pages.promo.show')->with('promos', Promo::get());
    }


    public function edit($id)
    {
        return view('admin.pages.promo.edit')->with('promo', Promo::where('promo_id', $id)->first());
    }


    public function update(Request $request, Promo $promo)
    {

        $promo_id = $request['promo_id'];
        unset($request['_token']);
        unset($request['promo_id']);
        try {

            Promo::where('promo_id', $promo_id)->update($request->all());
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            Promo::where('promo_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function inactive($id)
    {
        try {
            Promo::where('promo_id', $id)->update(['active_status' => false]);
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function active($id)
    {
        try {
            Promo::where('promo_id', $id)->update(['active_status' => true]);
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
