<?php

namespace App\Http\Controllers;

use App\Category;
use App\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $categories= ParentCategory::get();
        return view('admin.pages.category.create')->with('categories', $categories);
    }


    public function store(Request $request)
    {
        $category_name = $request['category_name'];

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $image_name = "img3" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/category');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = 'default.jpg';
        }

        $arr = array(
            'category_image' => $image_name,
            'category_name' => $category_name,
            'parent_category_id' => $request['parent_category_id'],
        );

        try {

            Category::create($arr);
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }

    public function show(Category $category)
    {
        $category=Category::join('parent_categories', 'parent_categories.parent_category_id', '=', 'categories.parent_category_id')
            ->get();
        return view('admin.pages.category.show')->with('categories', $category);
    }


    public function edit($id)
    {
       $category=Category::join('parent_categories', 'parent_categories.parent_category_id', '=', 'categories.parent_category_id')
            ->where('categories.category_id', $id)->first();
        $Parent_categories= ParentCategory::get();

        return view('admin.pages.category.edit')
            ->with('category',$category )
            ->with('categories',$Parent_categories );
    }


    public function update(Request $request)
    {

        $category_name = $request['category_name'];
        $category_id = $request['category_id'];

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $image_name = "img3" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/category');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = 'default.jpg';
        }

        $arr = array(
            'category_image' => $image_name,
            'category_name' => $category_name,
            'parent_category_id' => $request['parent_category_id'],

        );

        try {

            Category::where('category_id', $category_id)->update($arr);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }


    public function destroy($id)
    {
        try {
            Category::where('category_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
