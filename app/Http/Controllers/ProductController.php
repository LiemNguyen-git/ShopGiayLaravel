<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;// thu vien
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect; // thanh cong hay that bai thi tra ve cai trang nao do
session_start();

class ProductController extends Controller
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


    public function add_product()
    {
        $this->AuthLogin();
    	$cate_product = DB::table('tblcategory_product')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
    	
    	return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    	
    }

    public function all_product()
    {
        $this->AuthLogin();
    	//hien thi tat ca sp tu database
    	$all_product = DB::table('tbl_product')
        ->join('tblcategory_product','tblcategory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product',$manager_product);//trang admin-layout se chua all_brand_product la bien $manager_brand_product
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
    	$data = array();
    	//khi ng dung bam submit thi se dua tat ca du lieu qua ham save_brand_product
    	//'brand_name' la ten cot trong sql
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_status'] = $request->product_status;
        $data['created_at'] = $request->product_date;
    	$data['tblcategory_productcategory_id']=$request->product_cate;

    	$get_image = $request->file('product_image');

    	if($get_image)
	    	{
	    		$get_name_image = $get_image->getClientOriginalName();//lay ten cua hinh
	    		/*Hàm current sẽ lấy tên trước dấu chấm .jpg*/
	    		$name_image = current(explode('.',$get_name_image));//phan tach chuoi dua vao dau cham, truyen vao bien get name_image
	    		$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();// lay duoi mo rong cua hinh anh
	    		$get_image->move('public/uploads/product',$new_image);
	    		/*chon hinh anh va insertvao table*/
	    		$data['product_image'] = $new_image;
	    		DB::table('tbl_product')->insert($data);
		    	Session::put('message','Thêm sản phẩm thành công.');
		    	return Redirect::to('add-product');
	    	}
	    $data['product_image'] = '';	
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm giày thành công.');//goi bien $mesage o add_brand_product
    	//neu them thanh cong thi tra kq ve all_brand_product
    	return Redirect::to('all-product');
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
    	Session::put('message','Đã tắt kích hoạt giày thành công.');
    	return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
    	Session::put('message','Kích hoạt giày thành công.');
    	return Redirect::to('all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tblcategory_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

    	$edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get(); //lay ra du lieu thuoc brand_product_id
    	$manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    	return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request,$product_id)
    {
        $this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_status'] = $request->product_status;
        $data['created_at'] = $request->updated_at;
        $data['tblcategory_productcategory_id']=$request->product_cate;

        $get_image = $request->file('product_image');

        if($get_image)
                    {
                        $get_name_image = $get_image->getClientOriginalName();
                        //lay ten cua hinh
                        /*Hàm current sẽ lấy tên trước dấu chấm .jpg*/
                        $name_image = current(explode('.',$get_name_image));
                        //phan tach chuoi dua vao dau cham, truyen vao bien get name_image
                        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();// lay duoi mo rong cua hinh anh
                        
                        $get_image->move('public/uploads/product',$new_image);
                        /*chon hinh anh va insert vao table*/
                        $data['product_image'] = $new_image;

                        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                        Session::put('message','Cập nhật sản phẩm thành công.');
                        return Redirect::to('all-product');
                    }

                DB::table('tbl_product')->where('product_id',$product_id)->update($data);     
                Session::put('message','Cập nhật sản phẩm thành công.');
                //goi bien $mesage o add_brand_product
                //neu them thanh cong thi tra kq ve all_brand_product
                return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
    	DB::table('tbl_product')->where('product_id',$product_id)->delete();
    	Session::put('message','Xóa giày thành công.');
    	return Redirect::to('all-product');
    }
    //end function admin page
    public function details_product($product_id)
    {
        $cate_product = DB::table('tblcategory_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tblcategory_product','tblcategory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        
        foreach ($details_product as $key => $value) 
            {
                $category_id = $value->category_id;
            }
        $related_product = DB::table('tbl_product') //san pham lien quan
        ->join('tblcategory_product','tblcategory_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tblcategory_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get(); // lay ra tat ca sp co id da lay ra o ham @foreach
            //whereNotIn('tbl_product.product_id',[$product_id]) tru di san pham da co va k hien o sp lien quan

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('details_product',$details_product)->with('related',$related_product);
    }
   
  /*  public function show_comment(Request $request)   
    {
         $comment_product = DB::table('tbl_comment') //binh luan
        ->join('tbl_product','tbl_product.product_id','=','tbl_comment.product_id')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_comment.customer_id')
        ->select('tbl_comment.*','tbl_customers.*')->first(4);
        $manage_comment = view('pages.sanpham.show_details')->with('comment_product',$comment_product);
            return view('pages.sanpham.show_details')->with('pages.sanpham.show_detailsr',$manage_comment);
    }*/
}
