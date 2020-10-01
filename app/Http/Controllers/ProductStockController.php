<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductStock;
use App\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductStockController extends Controller
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



    public function store(Request $request)
    {
         $result=ProductStock::where('products_id',$request['product_id'])->first();
        if(is_null($result)){
            try {
                ProductStock::create(array('product_quantity' => $request['product_quantity'], 'products_id' => $request['product_id']));
                StockHistory::create(array('product_quantity' => $request['product_quantity'], 'product_id' => $request['product_id']));
                return back()->with('success', "Successfully Added");
            } catch (\Exception $exception) {
                return back()->with('failed', "There was  a problem " . $exception->getMessage());
            }
        }else{
            $product_quantity=$result->product_quantity+$request['product_quantity'];
            try {
                ProductStock::where( 'products_id', $request['product_id'])->update(array('product_quantity' => $product_quantity));
                StockHistory::create(array('product_quantity' => $request['product_quantity'], 'product_id' => $request['product_id']));
                return back()->with('success', "Successfully Added");
            } catch (\Exception $exception) {
                return back()->with('failed', "There was  a problem " . $exception->getMessage());
            }
        }



    }


    public function show(ProductStock $productStock)
    {
        $results = Product::leftJoin('product_stocks', 'product_stocks.products_id', '=', 'products.product_id')->get();
        return view('admin.pages.stock.show')
            ->with('products', $results);
    }


    public function edit(ProductStock $productStock)
    {
        //
    }


    public function update(Request $request, ProductStock $productStock)
    {
        //
    }


    public function destroy(ProductStock $productStock)
    {
        //
    }
}
