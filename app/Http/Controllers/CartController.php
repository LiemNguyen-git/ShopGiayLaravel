<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
use Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {

    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;
    	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

    	

    	$data['id'] = $product_info->product_id;
    	$data['qty'] = $quantity;
    	$data['name'] = $product_info->product_name;
    	$data['price'] = $product_info->product_price;
    	$data['options']['image'] = $product_info->product_image;

    	Cart::add($data);
    	return Redirect::to('/show-cart');
    	
    }
    public function show_cart()
    {
    	$cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

    	return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');

    }
     public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
