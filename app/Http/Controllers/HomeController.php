<?php

namespace App\Http\Controllers;

use Anam\Phpcart\Cart;
use App\Category;
use App\Client;
use App\Product;
use App\Promo;
use App\PromotionSlide;
use App\Shop;
use App\Shopping\Lol;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    protected $cart;

    public function __construct(Lol $cart)
    {
        $this->cart = $cart;
    }


    public function categoryAll()
    {

        return view('ecommerce.pages.categories.index')
            ->with('categories', Category::orderBy('created_at', 'DESC')->get());
    }

    public function category()
    {

        $status = "success";
        $code = 200;
        $message = "Successfully getting Data";
        $data = Category::orderBy('created_at', 'DESC')->get();
        $data = [
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'categories' => $data,
        ];
        return $data;
    }


    public function index()
    {
        $featured_item = Product::where('featured_product', true)->where('publish_status', true)->get();
        $new_products = Product::orderBy('product_id', 'DESC')->where('publish_status', true)->limit(3)->get();
        $category = Category::orderBy('created_at', 'ASC')->get();
        $slider = Slider::get();
        $promo = Promo::orderBy('promo_id', 'DESC')->first();
        $promotions = PromotionSlide::limit(2)->get();

        return view('ecommerce.pages.home.index')
            ->with('categories', $category)
            ->with('featured_items', $featured_item)
            ->with('sliders', $slider)
            ->with('shop', Shop::first())
            ->with('promo', $promo)
            ->with('clients', Client::limit(3)->get())
            ->with('hot_item', Product::limit(1)->where('publish_status', true)->orderBy('product_id', 'DESC')->limit(12)->first())
            ->with('promotions', $promotions)
            ->with('new_products', $new_products);


    }

    public function productDetails($id, $headline)
    {
        $images = DB::table('images')->where('product_id', $id)->get();
        $product = Product::where('products.product_id', $id)
            ->join('categories', 'categories.category_id', '=', 'products.product_category_id')
            ->where('products.publish_status', true)
            ->first();
        if (is_null($product)) {

            return redirect()->to('/404');

        }
        $promo = Promo::orderBy('promo_id', 'DESC')->first();
        return view('ecommerce.pages.product.index')
            ->with('images', $images)
            ->with('products', Product::limit(4)->get())
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get())
            ->with('shop', Shop::first())
            ->with('promo', $promo)
            ->with('product', $product);
    }

    public function productDetails2($id)
    {
        $images = DB::table('images')->where('product_id', $id)->get();
        $product = Product::where('products.product_id', $id)
            ->join('categories', 'categories.category_id', '=', 'products.product_category_id')
            ->where('products.publish_status', true)
            ->first();
        if (is_null($product)) {
            return back()->with('failed', "Product Not found");
        }
        $promo = Promo::orderBy('promo_id', 'DESC')->first();
        return view('ecommerce.pages.product.index')
            ->with('images', $images)
            ->with('products', Product::limit(4)->get())
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get())
            ->with('shop', Shop::first())
            ->with('promo', $promo)
            ->with('product', $product);
    }

    public function quickview($id)
    {
        $images = DB::table('images')->where('product_id', $id)->get();
        $product = Product::where('product_id', $id)->first();
        return view('ecommerce.pages.home.quickview')
            ->with('images', $images)
            ->with('product', $product);
    }

    public function addTocart(Request $request)
    {
        $product_id = $request['id'];
        $product = Product::where('product_id', $product_id)->first();
        $cart = new Lol();
        $cart->add([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'quantity' => 1,
            'price' => $product->selling_price,
        ]);

        return response()->json([
            'status' => "Success"
        ], 200);
    }

    public function addTocartMultiple(Request $request)
    {

        //return Redirect::to("/");
        $product_id = $request['id'];
        $qnt = $request['qnt'];
        $product = Product::where('product_id', $product_id)->first();
        $cart = new Lol();
        $cart->add([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'quantity' => $qnt,
            'price' => $product->selling_price,
        ]);

        return response()->json([
            'status' => "Success"
        ], 200);
    }

    public function removeFromCart(Request $request)
    {
        $product_id = $request['id'];

        $cart = new Lol();
        $cart->remove($product_id);

        return response()->json([
            'status' => "Success"
        ], 200);
    }

    public function getCart()
    {

        $cart = new Lol();
        return response()->json([
            'sum' => $cart->getTotal(),
            'items' => $cart->getItems(),
            'itemCount' => $cart->count()
        ], 200);
    }


    public function categiriseProducts($id)
    {
        $category_name = Category::where('category_id', $id)->pluck('category_name')->first();
        return view('ecommerce.pages.category_post.index')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get())
            ->with('category_name', $category_name)
            ->with('products', Product::where('publish_status', true)->where('product_category_id', $id)->get());
    }

    public function about()
    {
        return view('ecommerce.pages.extras.about')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function howTo()
    {
        return view('ecommerce.pages.extras.howto')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function identify()
    {
        return view('ecommerce.pages.extras.identify')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function way()
    {
        return view('ecommerce.pages.extras.way')
            ->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());

    }

    public function search(Request $request)
    {

        return $request->all();

    }


    public function cartAll()
    {
        $cart = new Cart();
        // $cart->clear();
        $items = $cart->getItems();
        $total_quantity = $cart->count();
        $total_money = $cart->getTotal();
        $data = [
            'status' => "success",
            'code' => 200,
            'message' => "successfully getting data",
            'items' => $items,
            'total_quantity' => $total_quantity,
            'total_money' => $total_money,
        ];
        return $data;
    }

    public function addIntoCart(Request $request)
    {
        $cart = new Cart();
        $status = "success";
        $code = 200;
        $message = "Successfully Saving Data";
        $data = array(
            'id' => $request['id'],
            'name' => $request['product_name'],
            'quantity' => $request['qnt'],
            'price' => $request['price']
        );
        try {

            $cart->add($data);

        } catch (\Exception $exception) {
            $status = "failed";
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return $data = [
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

    }

    public function removeItem(Request $request)
    {
        $cart = new Cart();
        $status = "success";
        $code = 200;
        $message = "Successfully Saving Data";
        $data = null;
        try {
            $cart->remove($request['id']);
        } catch (\Exception $exception) {
            $status = "failed";
            $code = $exception->getCode();
            $message = $exception->getMessage();
        }

        return $data = [
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

    }


    /* Igoner*/

    public function cartAdd()
    {
        $this->cart->add(2, 2, 3);
    }

    public function removeAll()
    {
        Lol::removeAll();
    }

    public function getAll()
    {
        return $items = Lol::getItem();
    }

    public function removeSingle()
    {
        return $items = Lol::remove(1);
    }

    public function removeAll2()
    {
        //dd(Cart::getLastName());
        //Cart::removeAll();
        //$this->cart->add(1,2,3);
        //return $this->cart->add(5,2,3);
        return $items = Lol::getItem();
        //return $items= Cart::count();
        foreach ($items as $item) {
            echo $item['product_price'] . "<br>";
        }
        return;

    }

    public function Error()
    {
        return view('ecommerce.pages.404')->with('categories', Category::orderBy('created_at', 'DESC')->limit(10)->get());
    }


}
