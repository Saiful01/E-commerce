<?php

namespace App\Http\Controllers;

use App\Customer;
use App\ProductSell;
use App\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SellController extends Controller
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


    public function confirmed($sell_invoice)
    {
        try {

            Sell::where('sell_invoice', $sell_invoice)->update(['delivery_status' => 1]);
            return back()->with('success', "Updated");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function delivery($sell_invoice)
    {
        try {

            Sell::where('sell_invoice', $sell_invoice)->update(['delivery_status' => 2]);
            return back()->with('success', "Updated");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function received($sell_invoice)
    {
        try {

            Sell::where('sell_invoice', $sell_invoice)->update(['delivery_status' => 3]);
            return back()->with('success', "Updated");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function cancel($sell_invoice)
    {
        try {

            Sell::where('sell_invoice', $sell_invoice)->update(['delivery_status' => 4]);
            return back()->with('success', "Updated");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function details($sell_invoice)
    {
        $result = Sell::join('customers', 'customers.customer_id', '=', 'sells.customer_id')
            ->where('sells.sell_invoice', $sell_invoice)

            ->first(
                [
                    'customers.customer_name',
                    'customers.customer_phone',
                    'customers.customer_city',
                    'customers.customer_address1',
                    'customers.customer_address2',

                    'sells.sub_total_price',
                    'sells.shipping_cost',
                    'sells.discount',
                    'sells.delivery_status',
                    'sells.sell_invoice',
                    'sells.total',
                    'sells.vat',
                    'sells.paid_amount',
                    'sells.coupon',
                    'sells.discount',
                    'sells.comment',
                    'sells.created_at',
                ]
            );
        $products = ProductSell::join('products', 'products.product_id', '=', 'product_sells.product_id')
            ->where('product_sells.sell_invoice', $sell_invoice)
            ->get();
        return view('admin.pages.sell.details')
            ->with('customer', $result)
            ->with('products', $products);
    }

    public function show(Request $request)
    {
        if ($request->isMethod('post')) {
            $from = $request['from'];
            $to = $request['to'];

            $result = Sell::join('customers', 'customers.customer_id', '=', 'sells.customer_id')
                ->where('sells.delivery_status', '!=', 0)
                ->where('sells.delivery_status', '!=', 4)
                ->orderBy('sells.sell_id', "DESC")
                ->whereBetween('sells.updated_at', [$from, $to])
                ->get(
                    [
                        'customers.customer_name',
                        'customers.customer_phone',
                        'customers.customer_city',
                        'customers.customer_address1',
                        'customers.customer_address2',

                        'sells.sub_total_price',
                        'sells.shipping_cost',
                        'sells.discount',
                        'sells.delivery_status',
                        'sells.sell_invoice',
                        'sells.total',
                        'sells.vat',
                        'sells.paid_amount',
                        'sells.coupon',
                        'sells.discount',
                        'sells.comment',
                        'sells.created_at',
                        'sells.paid_amount',

                    ]
                );
        } else {
            $result = Sell::join('customers', 'customers.customer_id', '=', 'sells.customer_id')
                ->where('sells.delivery_status', '!=', 0)
                ->where('sells.delivery_status', '!=', 4)
                ->orderBy('sells.sell_id', "DESC")
                ->get(
                    [
                        'customers.customer_name',
                        'customers.customer_phone',
                        'customers.customer_city',
                        'customers.customer_address1',
                        'customers.customer_address2',

                        'sells.sub_total_price',
                        'sells.shipping_cost',
                        'sells.discount',
                        'sells.delivery_status',
                        'sells.sell_invoice',
                        'sells.total',
                        'sells.vat',
                        'sells.paid_amount',
                        'sells.coupon',
                        'sells.discount',
                        'sells.comment',
                        'sells.created_at',
                        'sells.paid_amount',

                    ]
                );
        }


        return view('admin.pages.sell.index')->with('sells', $result);
    }


    public function customerList()
    {
        $result = Customer::paginate(10);

        return view('admin.pages.customer.index')->with('customers', $result);
    }

    public function customerEdit($id)
    {
        $result = Customer::where('customer_id', $id)->first();

        return view('admin.pages.customer.edit')->with('customer', $result);
    }

    public function customerUpdate(Request $request)
    {

        $customer_id = $request['customer_id'];
        $customer_array = array(
            'customer_name' => $request['customer_name'],
            'customer_phone' => $request['customer_phone'],
            'customer_email' => $request['customer_email'],
            'customer_address1' => $request['customer_address1'],
            'customer_address2' => $request['customer_address2'],
            'customer_city' => $request['customer_city']
        );

        try {
            Customer::where('customer_id', $customer_id)->update($customer_array);
            return back()->with('success', "Successfully updated");

        } catch (\Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }


    public function discount(Request $request)
    {
        $discount_array = array(
            'discount' => $request['discount']
        );

        try {
            Sell::where('sell_invoice', $request['invoice'])->update($discount_array);
            return back()->with('success', "Discount Added");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }

    public function pay(Request $request)
    {
        $res = Sell::where('sell_invoice', $request['invoice'])->first();
        $apid_array = array(
            'paid_amount' => $request['paid_amount'] + $res->paid_amount,
        );

        try {
            Sell::where('sell_invoice', $request['invoice'])->update($apid_array);
            return back()->with('success', "Discount Added");

        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }
}
