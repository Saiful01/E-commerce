<?php

namespace App\Http\Controllers;

use Anam\Phpcart\Cart;
use App\Category;
use App\Customer;
use App\ProductSell;
use App\Sell;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Array_;
use SoapClient;

class CustomerController extends Controller
{


    public function checkout()
    {
        return view('ecommerce.pages.checkout.index')->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());
    }


    public function cart()
    {
        //$cart = new Cart();

        if (Session::get('customer_id')) {
            return view('ecommerce.pages.cart.index')
                ->with('customer', Customer::where('customer_id', Session::get('customer_id'))->first())
                ->with('categories', Category::orderBy('created_at', 'DESC')
                    ->limit(10)
                    ->get());
        } else {
            return view('ecommerce.pages.cart.index')
                ->with('customer', null)
                ->with('categories', Category::orderBy('created_at', 'DESC')
                    ->limit(10)
                    ->get());
        }

    }

    public function placeOrder(Request $request)
    {
        $flag = false;
        if ($request['customer_name'] == null || $request['customer_name'] == "") {
            $flag = true;
        }
        if ($request['customer_phone'] == null || $request['customer_phone'] == "") {
            $flag = true;
        }

        if ($request['customer_address1'] == null || $request['customer_address1'] == "") {
            $flag = true;
        }
        if ($flag) {
            return "Error";
        } else {
            $customer_array = array(
                'customer_name' => $request['customer_name'],
                'customer_phone' => $request['customer_phone'],
                'customer_email' => $request['customer_email'],
                'customer_address1' => $request['customer_address1'],
                'customer_city' => $request['customer_city'],
                'customer_country' => $request['customer_country']
            );

            $is_exist = Customer::where('customer_phone', $request['customer_phone'])->first();
            if (is_null($is_exist)) {
                $user_id = Customer::insertGetId($customer_array);
            } else {
                $user_id = $is_exist->customer_id;
            }


            $invoice =  rand(1,9).time().rand(1,9);
            $shipping_cost = $request['shipping_cost'];
            $total_price = $request['total_price'];

            $sell_array = array(
                'sell_invoice' => $invoice,
                'sub_total_price' => $total_price,
                'shipping_cost' => $shipping_cost,
                'customer_id' => $user_id,
                'total' => $total_price + $shipping_cost,
            );

            try {
                Sell::create($sell_array);

                foreach ($request['items'] as $item) {
                    $product_array = array(
                        'product_id' => $item['id'],
                        'selling_price' => $item['price'],
                        'quantity' => $item['qnt'],
                        'total_price' => $item['qnt'] * $item['price'],
                        'sell_invoice' => $invoice,
                    );

                    ProductSell::create($product_array);
                }


                $this->sendSms($request['customer_name'], $request['customer_phone'],$invoice);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Saved',
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'There was a problem' . $exception->getMessage(),
                ], 200);
            }

        }

    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }


    public function update(Request $request, Customer $customer)
    {
        //
    }


    public function register(Customer $customer)
    {
        return view('ecommerce.pages.auth.registration')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function customerStore(Request $request)
    {


        $validatedData = $request->validate([
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address1' => 'required',
        ]);

        unset($request['_token']); //Remove Token
        $password = $request['customer_password'];
        unset($request['customer_password']); //Remove Token
        $request->request->add(['customer_password' => Hash::make($password)]);

        try {

            $id = Customer::insertGetId($request->all());

            $request->session()->put('customer_id', $id);
            $request->session()->put('customer_name', $request['customer_name']);
            return Redirect::to('/customer/cart')->with('success', 'You have been successfully registered');

        } catch (\Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }

    public function login()
    {
        return view('ecommerce.pages.auth.login')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function customerProfile(Request $request)
    {
        try {
            $customer = Customer::where('customer_id', $request['customer_id'])->first();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Saved',
                'customer' => $customer
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'customer' => null,
                'message' => 'There was a problem' . $exception->getMessage(),
            ], 200);
        }
    }

    public function doLogin(Request $request)
    {

        $request->validate([
            'customer_phone' => 'required',
            'customer_password' => 'required'
        ]);

        $customer_phone = $request['customer_phone'];
        $customer_password = $request['customer_password'];

        $validate_admin = Customer::where('customer_phone', $customer_phone)->first();

        if ($validate_admin && Hash::check($customer_password, $validate_admin->customer_password)) {

            $request->session()->put('customer_id', $validate_admin->customer_id);
            $request->session()->put('customer_name', $validate_admin->customer_name);
            return Redirect::to('/customer/cart');
        } else {
            return back()->with('failed', "Phone number or Password does not match");
        }

    }

    public function doLogout()
    {
        Session::forget('customer_id');
        return Redirect::to('/');
    }

    private function sendSms($customer_name, $customer_phone, $invoice)
    {
        $message = "Dear, " . $customer_name . " Your order have been submitted. Your invoice number is: ".$invoice;
        $owner = "kenarhat.com";
        try {
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "01717849968",
                'userPassword' => "3f718e",
                'mobileNumber' => $customer_phone,
                'smsText' => $message . " - " . $owner,
                'type' => "TEXT",
                'maskName' => '',
                'campaignName' => '',
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));

            return 1;

        } catch (\Exception $exception) {

            return $exception->getMessage();
            return 0;
            //echo $e->getMessage();
            //echo '{"status" : "sms_send_decline", "message": "' . $e->getMessage() . '"}';
        }
    }

}
