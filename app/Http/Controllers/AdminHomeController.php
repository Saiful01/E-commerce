<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminHomeController extends Controller
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

    public function index()
    {
        /*        return view('admin.pages.dashboard.index');*/
        $result = Sell::join('customers', 'customers.customer_id', '=', 'sells.customer_id')
            ->where('sells.delivery_status', 0)
            ->orderBy('sells.sell_id', "DESC")
            ->get(
                [
                    'customers.customer_id',
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
        return view('admin.pages.sell.dashboard')->with('sells', $result);
    }

    public function cancelledOrder()
    {
        /*        return view('admin.pages.dashboard.index');*/
        return $result = Sell::join('customers', 'customers.customer_id', '=', 'sells.customer_id')
            ->where('sells.delivery_status', 4)
            ->orderBy('sells.sell_id', "DESC")
            ->get(
                [
                    'customers.customer_name',
                    'customers.customer_phone',
                    'customers.customer_city',
                    'customers.customer_address1',

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
        return view('admin.pages.sell.dashboard')->with('sells', $result);
    }

    public function addressSave(Request $request)
    {
        $address_array = array(
            'customer_address2' => $request['customer_address2'],
        );
        try {
            Customer::where('customer_id', $request['customer_id'])->update($address_array);
            return back()->with('success', "Address Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }
}
