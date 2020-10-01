<?php

namespace App\Http\Controllers;

use App\PromotionSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PromotionSlideController extends Controller
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


    public function show(PromotionSlide $promotionSlide)
    {
        $promotion = PromotionSlide::get();

        return view('admin.pages.promotion.show')
            ->with('promotions', $promotion);
    }


    public function edit($promotion_id)
    {
        $promotion = PromotionSlide::where('promotion_id', $promotion_id)->first();

        return view('admin.pages.promotion.edit')
            ->with('promotion', $promotion);
    }


    public function update(Request $request)
    {
        $promotion_name = $request['promotion_name'];
        $promotion_id = $request['promotion_id'];

        if ($request->hasFile('promotion_image')) {
            $image = $request->file('promotion_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/promotion');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = $request['promotion_image'];
        }

        $arr = array(
            'promotion_image' => $image_name,
            'promotion_name' => $promotion_name,
        );

        try {

            PromotionSlide::where('promotion_id', $promotion_id)->update($arr);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function destroy(PromotionSlide $promotionSlide)
    {
        //
    }
}
