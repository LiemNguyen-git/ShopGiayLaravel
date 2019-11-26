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

    public function AuthLogin() //kiem tra co admin admin id hay k, neu k co thif tra ve dashboard
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
        	$admin_password = $request->admin_password;

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

}
