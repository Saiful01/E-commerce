<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
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
        return view('admin.pages.client.create');
    }


    public function store(Request $request)
    {
        $client_name = $request['client_name'];

        if ($request->hasFile('client_image')) {
            $image = $request->file('client_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/client');
            $image->move($destinationPath, $image_name);
        } else {
            $image_name = 'default.jpg';
        }

        $arr = array(
            'client_image' => $image_name,
            'client_name' => $request['client_name'],
            'client_company' => $request['client_company'],
            'client_quotes' => $request['client_quotes'],
        );

        try {

            Client::create($arr);
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function show()
    {
        return view('admin.pages.client.show')->with('clients', Client::get());
    }


    public function edit(Client $client)
    {
        //
    }


    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            Client::where('client_id', $id)->delete();
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
