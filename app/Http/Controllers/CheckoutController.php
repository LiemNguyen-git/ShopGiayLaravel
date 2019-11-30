<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
session_start();

class CheckoutController extends Controller
{
    public function login_checkout()
    {
    	$cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request)
    {
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = $request->customer_password;
    	$data['customer_address'] = $request->customer_address;
    	$data['customer_sex'] = $request->customer_sex;
    	$data['customer_birthday'] = $request->customer_birthday;

    	$customer_id = DB::table('tbl_customers')->insertGetId($data);//khi insertGetId la lay luon du lieu ma minh moi insert vao

    	Session::put('customer_id',$customer_id);//lay du lieu cai ma vua insert truyen vao bien $insert_user
    	Session::put('customer_name',$request->customer_name);//khi ng dung dang ky, thi no se sinh ra 1 giao dich

    	return Redirect('/checkout');
    }

    public function checkout()
    {
        $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;
        
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);//khi insertGetId la lay luon du lieu ma minh moi insert vao

        Session::put('shipping_id',$shipping_id);//lay du lieu cai ma vua insert truyen vao bien $insert_user
        
        return Redirect('/payment');
    }
     public function payment()
    {
        
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = $request->password_account;
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();

        if($result)
        {
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        }
        else
        {
            return Redirect::to('/login-checkout');
        }
        
       
        
    }
}
