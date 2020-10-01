<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
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
        return view('admin.pages.slider.create');
    }


    public function store(Request $request)
    {
        $slider_name = $request['slider_name'];

        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/slider');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = 'default.jpg';
        }

        $arr = array(
            'slider_image' => $image_name,
            'slider_name' => $slider_name,
        );

        try {

            Slider::create($arr);
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function show(Slider $slider)
    {
        return view('admin.pages.slider.show')->with('sliders', Slider::get());
    }


    public function edit($id)
    {
        return view('admin.pages.slider.edit')->with('slider', Slider::where('slider_id',$id)->first());
    }


    public function update(Request $request)
    {
        $slider_name = $request['slider_name'];
        $slider_id = $request['slider_id'];

        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/slider');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = 'default.jpg';
        }

        $arr = array(
            'slider_image' => $image_name,
            'slider_name' => $slider_name,
        );

        try {

            Slider::where('slider_id',$slider_id)->update($arr);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {

            Slider::where('slider_id',$id)->delete();
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
