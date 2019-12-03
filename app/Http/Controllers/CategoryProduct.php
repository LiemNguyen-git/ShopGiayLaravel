<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
session_start();

class CategoryProduct extends Controller
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

    public function add_category_product()
    {
        $this->AuthLogin();
    	return view('admin.add_category_product');
    }

    public function all_category_product()
    {
        $this->AuthLogin();
    	//hien thi tat ca sp tu database
    	$all_category_product = DB::table('tblcategory_product')->get();
    	$manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product',$manager_category_product);//trang admin-layout se chua all_category_product la bien $manager_category_product
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
    	$data = array();
    	//khi ng dung bam submit thi se dua tat ca du lieu qua ham save_category_product
    	//'category_name' la ten cot trong sql
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;
        $data['created_at'] = $request->category_product_date;

    	DB::table('tblcategory_product')->insert($data);
    	Session::put('message','Thêm loại sản phẩm thành công.');//goi bien $mesage o add_category_product
    	//neu them thanh cong thi tra kq ve all_category_product
    	return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
    	DB::table('tblcategory_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
    	Session::put('message','Đã tắt kích hoạt loại sản phẩm thành công.');
    	return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
    	DB::table('tblcategory_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
    	Session::put('message','Kích hoạt loại sản phẩm thành công.');
    	return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
    	$edit_category_product = DB::table('tblcategory_product')->where('category_id',$category_product_id)->get(); //lay ra du lieu thuoc category_product_id
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

    	return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
        $data['created_at'] = $request->category_product_date;
    	DB::table('tblcategory_product')->where('category_id',$category_product_id)->update($data);
    	Session::put('message','Cập nhật loại sản phẩm thành công.');
    	return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
    	DB::table('tblcategory_product')->where('category_id',$category_product_id)->delete();
    	Session::put('message','Xóa loại sản phẩm thành công.');
    	return Redirect::to('all-category-product');
    }

    //end function admin page
    public function show_category_home($category_id)
        {   

            $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

            $category_by_id = DB::table('tbl_product')->join('tblcategory_product','tbl_product.category_id','=','tblcategory_product.category_id')->where('tbl_product.category_id',$category_id)->get();

            $category_name = DB::table('tblcategory_product')->where('tblcategory_product.category_id',$category_id)->limit(1)->get();//lay tat ca ten san pham cua 1 loai

            return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
           
        }

    
}
