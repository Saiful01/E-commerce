<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
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
        return view('admin.pages.admin.create');
    }


    public function store(Request $request)
    {

        unset($request['_token']);

        $request->request->add(['password' => Hash::make($request['password'])]); //add request

        try {
            User::create($request->all());

            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function show()
    {
        return view('admin.pages.admin.show')->with('admins', User::get());
    }


    public function edit($id)
    {

        try {
            $admin = User::where('id', $id)->first();
            return view('admin.pages.admin.profile')->with('admin', $admin);
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function update(Request $request)
    {
        unset($request['_token']);

        $request->request->add(['password' => Hash::make($request['password'])]); //add request

        try {
            User::where('id', $request['id'])->update($request->all());

            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {

            User::where('id', $id)->delete();
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function profile()
    {


        $id = Auth::user()->id;
        try {

            $admin = User::where('id', $id)->first();
            return view('admin.pages.admin.profile')->with('admin', $admin);
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
