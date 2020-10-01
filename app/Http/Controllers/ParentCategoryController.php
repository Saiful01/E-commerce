<?php

namespace App\Http\Controllers;

use App\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.parent_category.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        unset($request['_token']);
        try {
            ParentCategory::create($request->all());
            return back()->with('success',"Successfully Saved");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ParentCategory $parentCategory)
    {

        $result=ParentCategory::get();
        return view('admin.pages.parent_category.show')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $result=ParentCategory::where('parent_category_id', $id)->first();
        return view('admin.pages.parent_category.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentCategory $parentCategory)
    {
        unset($request['_token']);
        try {
            ParentCategory::where('parent_category_id', $request['parent_category_id'])->update($request->all());
            return back()->with('success',"Successfully Updated");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        try {
            ParentCategory::where('parent_category_id', $id)->delete();
            return back()->with('success',"Successfully Deleted");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
