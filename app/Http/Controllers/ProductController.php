<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
        return view('admin.pages.product.create')->with('categories', Category::get());
    }

    public function store(Request $request)
    {
        unset($request['_token']); //Remove Token

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $featured_image = "feat_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $featured_image);
        } else {
            $featured_image = 'default.jpg';
        }

        if ($request->hasFile('product_image1')) {
            $image = $request->file('product_image1');
            $image_name1 = "img1" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $image_name1);
        } else {
            $image_name1 = 'default.jpg';
        }
        if ($request->hasFile('product_image2')) {
            $image = $request->file('product_image2');
            $image_name2 = "img3" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $image_name2);
        } else {
            $image_name2 = 'default.jpg';
        }

        $request->request->add(['featured_image' => $featured_image]);
        //return $request->all();
        try {
            $last_id = Product::insertGetId($request->except('feature_image', 'product_image1', 'product_image2'));
            //return $request->except('featured_image', 'product_image2', 'product_image1');
            $this->saveImage($last_id, $image_name1, $image_name2);
            return back()->with('success', "Successfully saved");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }

    }
    public function extrastore(Request $request){
        unset($request['_token']);
        try{
            $product= [
                'brand_id' => 1 ,
                'product_category_id' => 1,
                'publish_status' => false,
                'regular_price' => $request['selling_price'],
                'product_name' => $request['product_name'] ,
                'selling_price' => $request['selling_price'] ,
            ];

            $product_id=Product::insertGetId($product);
            $product_sell= [
                'product_id' =>$product_id ,
                'selling_price' => $request['selling_price'],
                'quantity' => $request['quantity'],
                'sell_invoice' => $request['sell_invoice'],
                'total_price' => $request['quantity'] * $request['selling_price'],
            ];
            ProductSell::create($product_sell);
            return back()->with('success', "Successfully Saved");

        }
        catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }



    }


    public function show(Product $product)
    {
        $products = Product::join('categories', 'categories.category_id', '=', 'products.product_category_id')->paginate(10);
        return view('admin.pages.product.show')->with('products', $products);
    }


    public function edit($id)
    {
        return view('admin.pages.product.edit')
            ->with('categories', Category::get())
            ->with('product', Product::join('categories', 'categories.category_id', '=', 'products.product_category_id')->where('product_id', $id)->first());
    }


    public function update(Request $request)
    {
        $product_id = $request['product_id'];
        unset($request['_token']); //Remove Token
        unset($request['product_id']); //Remove Token
        $product = Product::where('product_id', $product_id)->first();

        if ($request->hasFile('feature_image')) {
            $image = $request->file('feature_image');
            $featured_image = "feat_" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $featured_image);
        } else {
            $featured_image = $product->featured_image;
        }

        if ($request->hasFile('product_image1')) {
            $image = $request->file('product_image1');
            $image_name1 = "img1" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $image_name1);
        } else {
            $image_name1 = 'default.jpg';
        }
        if ($request->hasFile('product_image2')) {
            $image = $request->file('product_image2');
            $image_name2 = "img3" . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/product');
            $image->move($destinationPath, $image_name2);
        } else {
            $image_name2 = 'default.jpg';
        }

        $request->request->add(['featured_image' => $featured_image]);
        //return $request->all();
        try {
            Product::where('product_id', $product_id)->update($request->except('feature_image', 'product_image1', 'product_image2'));
            //return $request->except('featured_image', 'product_image2', 'product_image1');
            $this->updateImage($image_name1, $image_name2, $product_id);
            return back()->with('success', "Successfully Updated");
        } catch (\Exception $exception) {

            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }


    public function destroy($id)
    {

        try {
            Product::where('product_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function publish($id)
    {

        try {
            Product::where('product_id', $id)->update(['publish_status' => true]);
            return back()->with('success', "Successfully Published");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function unPublish($id)
    {

        try {
            Product::where('product_id', $id)->update(['publish_status' => false]);
            return back()->with('success', "Successfully Deleted");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function feature($id)
    {

        try {
            Product::where('product_id', $id)->update(['featured_product' => true]);
            return back()->with('success', "Successfully added as featured product");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    public function featureRemove($id)
    {

        try {
            Product::where('product_id', $id)->update(['featured_product' => false]);
            return back()->with('success', "Successfully Remove from Feature product");
        } catch (\Exception $exception) {
            return back()->with('failed', "There was  a problem " . $exception->getMessage());
        }
    }

    private function saveImage($product_id, $image1, $image2)
    {
        try {
            if ($image1 != "default.jpg") {
                DB::table('images')->insert([
                    'product_id' => $product_id,
                    'image_name' => $image1,
                ]);
            }
            if ($image2 != "default.jpg") {
                DB::table('images')->insert([
                    'product_id' => $product_id,
                    'image_name' => $image2,
                ]);
            }


        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }

    private function updateImage(string $image_name1, string $image_name2, $product_id)
    {
        DB::table('images')->where('product_id', $product_id)->delete();
        try {
            if ($image_name1 != "default.jpg") {
                DB::table('images')->insert([
                    'product_id' => $product_id,
                    'image_name' => $image_name1,
                ]);
            }
            if ($image_name2 != "default.jpg") {
                DB::table('images')->insert([
                    'product_id' => $product_id,
                    'image_name' => $image_name2,
                ]);
            }


        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
