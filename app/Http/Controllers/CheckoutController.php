<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin() //kiem tra co admin id hay k, neu k co thif tra ve dashboard
        {
            $admin_id = Session::get('admin_id');
            if($admin_id)
            {
               return Redirect::to('dashboard');
            }
            else
            {
               return Redirect::to('admin')->send();
            }
        }

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
    	$data['customer_password'] = md5($request->customer_password);
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
        
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);//khi insertGetId la lay luon du lieu ma minh vua insert vao

        Session::put('shipping_id',$shipping_id);//lay du lieu vua insert truyen vao bien $insert_user
        
        return Redirect('/payment');
    }
     public function payment()
    {
        $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
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

    public function order_place(Request $request)
        {
            
            //lay hinh thuc thanh toan
            $data = array();
            $data['payment_method'] = $request->payment_option;
            $data['payment_status'] = 'Đang chờ xử lý';
            $payment_id = DB::table('tbl_payment')->insertGetId($data);//khi insertGetId la lay luon du lieu ma minh vua insert vao

            // insert vao order 
            $content = Cart::content();
            foreach ($content as $val_content)
            {

                $order_data = array();
               /* $order_data['customer_name'] = Session::get('customer_name');*/
                $order_data['customer_id'] = Session::get('customer_id');
                $order_data['shipping_id'] = Session::get('shipping_id');
                $order_data['payment_id'] = $payment_id;
                $order_data['order_total'] = Cart::total();
                $order_data['order_status'] = 'Đang chờ xử lý';
                $order_data['product_name'] = $val_content->name;
                /*$order_data['order_address'] = Session::get('shipping_address');*/
                $order_data['order_quantity'] = $val_content->qty;
                $order_id = DB::table('tbl_order')->insertGetId($order_data);
            }
            
            
            //insert vao order details
            $content = Cart::content();
            foreach ($content as $v_content) 
                {
                    $order_details_data = array();

                    $order_details_data['order_id'] = $order_id;
                    $order_details_data['product_id'] = $v_content->id;
                    $order_details_data['product_name'] = $v_content->name;
                    $order_details_data['product_price'] = $v_content->price;
                    /*$order_details_data['product_size'] = Session::get('product_size');
                    $order_details_data['product_color'] = Session::get('product_color');*/
                    $order_details_data['product_sales_quantity'] = $v_content->qty;

                    DB::table('tbl_order_details')->insert($order_details_data);
                }
            if($data['payment_method'] == 1)
                {
                    echo 'Thanh toán qua thẻ ATM';
                }
            elseif ($data['payment_method'] == 2) 
                {
                    Cart::destroy();
                    $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
                    $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

                    return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
                   
                }
            else
                {
                    echo 'Thanh toán qua ví điện tử Momo';
                }
           

            //return Redirect('/payment');
        }
        public function manage_order()
        {
            $this->AuthLogin();
            //hien thi tat ca sp tu database
            $all_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')
            ->orderby('tbl_order.order_id','desc')->get();
            
            $manage_order = view('admin.manage_order')->with('all_order',$all_order);
            return view('admin_layout')->with('admin.manage_order',$manage_order);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
            
        }


        public function view_order($orderId)
        {
            

            $this->AuthLogin();
            //hien thi tat ca sp tu database
            $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            ->select('tbl_order.*','tbl_customers.*', 'tbl_shipping.*','tbl_order_details.*')->first();
            
            $manage_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
            return view('admin_layout')->with('admin.view_order',$manage_order_by_id);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
            
        }
}
