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
    public function add_user(Request $request)
    {
    	$data = array();
    	$data['user_name'] = $request->user_name;
    	$data['user_phone'] = $request->user_phone;
    	$data['user_email'] = $request->user_email;
    	$data['user_password'] = $request->user_password;
    	$data['user_address'] = $request->user_address;
    	$data['user_sex'] = $request->user_sex;
    	$data['user_birthday'] = $request->user_birthday;

    	$user_id = DB::table('tbl_user')->insertGetId($data);//khi insertGetId la lay luon du lieu ma minh moi insert vao

    	Session::put('user_id',$user_id);//lay du lieu cai ma vua insert truyen vao bien $insert_user
    	Session::put('user_name',$request->user_name);//khi ng dung dang ky, thi no se sinh ra 1 giao dich

    	return Redirect('/checkout');
    }

    public function checkout()
    {

    }
}
