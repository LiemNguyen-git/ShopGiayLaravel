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
}
