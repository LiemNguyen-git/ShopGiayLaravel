<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
session_start();

class AdminController extends Controller
{

    public function AuthLogin() //kiem tra co admin admin id hay k, neu k co thi tra ve dashboard
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

    public function index()
        {
        	return view('admin_login');
        }

    public function show_dashboard()
        {
            $this->AuthLogin();
        	return view('admin.dashboard');
        }

    public function dashboard(Request $request)
        {
        	$admin_email = $request->admin_email;
        	$admin_password = md5($request->admin_password);

        	$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        	if($result) //neu result = true
            {
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return Redirect::to('/dashboard');
            }
            else //neu ng dung nhap sai pass
            {
                Session::put('message','Mật khẩu hoặc tài khoản bị sai! Vui lòng đăng nhập lại.');
                return Redirect::to('/admin');
            }
        }

    public function logout()
        {
            Session::put('admin_name',null);
            Session::put('admin_id',null);
            return Redirect::to('/admin');
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
            /*->select('tbl_order.*','tbl_customers.*', 'tbl_shipping.*','tbl_order_details.*')*/->get();
            //dd($order_by_id);
            $manage_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
            return view('admin_layout')->with('admin.view_order',$manage_order_by_id);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
            
        }
        public function delete_order($order_id)
            {
                $this->AuthLogin();
                DB::table('tbl_order')->where('order_id',$order_id)->delete();
                Session::put('message','Xóa đơn hàng thành công.');
                return Redirect::to('manage-order');
            }
        public function all_customers()
        {
            $this->AuthLogin();
            //hien thi tat ca sp tu database
            $all_customers = DB::table('tbl_customers')->get();
            $manager_customer = view('admin.all_customers')->with('all_customers',$all_customers);
            return view('admin_layout')->with('admin.all_customers',$manager_customer);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
        }
         public function delete_customer($customer_id)
            {
                $this->AuthLogin();
                DB::table('tbl_customers')->where('customer_id',$customer_id)->delete();
                Session::put('message','Xóa khách hàng thành công.');
                return Redirect::to('all-customers');
            }
}

