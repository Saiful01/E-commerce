<?php

namespace App\Http\Controllers;

use App\DeliveryCharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            DeliveryCharge::create($request->all());
            return back()->with('success',"Successfully Saved");

    }
    catch (\Exception $exception) {
        return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCharge $deliveryCharge)
    {
        $result=DeliveryCharge::get();
        return view('admin.pages.delivery_charge.show')->with('result', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=DeliveryCharge::where('delivery_charge_id', $id)->first();
        return view('admin.pages.delivery_charge.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryCharge $deliveryCharge)
    {
        unset($request['_token']);
        try {
            DeliveryCharge::where('delivery_charge_id', $request['delivery_charge_id'])->update($request->all());
            return back()->with('success',"Successfully Updated");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DeliveryCharge::where('delivery_charge_id', $id)->delete();
            return back()->with('success',"Successfully Deleted");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
