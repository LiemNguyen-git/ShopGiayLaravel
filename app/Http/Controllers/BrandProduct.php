<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
session_start();

class BrandProduct extends Controller
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

    public function add_brand_product()
    {
        $this->AuthLogin();
    	return view('admin.add_brand_product');
    }

    public function all_brand_product()
    {
        $this->AuthLogin();
    	//hien thi tat ca sp tu database
    	$all_brand_product = DB::table('tbl_brand_product')->get();
    	$manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
    }

    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
    	$data = array();
    	//khi ng dung bam submit thi se dua tat ca du lieu qua ham save_brand_product
    	//'brand_name' la ten cot trong sql
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_desc'] = $request->brand_product_desc;
    	$data['brand_status'] = $request->brand_product_status;
    	$data['created_at'] = $request->brand_product_date;

    	DB::table('tbl_brand_product')->insert($data);
    	Session::put('message','Thêm thương hiệu giày thành công.');//goi bien $mesage o add_brand_product
    	//neu them thanh cong thi tra kq ve all_brand_product
    	return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>1]);
    	Session::put('message','Đã tắt kích hoạt thương hiệu giày thành công.');
    	return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status'=>0]);
    	Session::put('message','Kích hoạt thương hiệu giày thành công.');
    	return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
    	$edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get(); //lay ra du lieu thuoc brand_product_id
    	$manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

    	return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['brand_name'] = $request->brand_product_name;
    	$data['brand_desc'] = $request->brand_product_desc;
    	$data['created_at'] = $request->brand_product_date;
    	DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
    	Session::put('message','Cập nhật thương hiệu giày thành công.');
    	return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
    	Session::put('message','Xóa thương hiệu giày thành công.');
    	return Redirect::to('all-brand-product');
    }
    //end fuction admin page
    public function show_brand_home($brand_id)
        {   

            $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

            $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
            $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();//lay tat ca ten san pham cua 1 loai

            return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
           
        }
}
