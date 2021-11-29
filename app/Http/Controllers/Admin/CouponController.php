<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use App\Helpers\CustomHelper;
use Auth;
use Validator;
use App\User;
use Storage;
use DB;
use Hash;
use App\Category;
use App\Collection;
use App\Vendor;
use App\Coupon;





Class CouponController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }

    public function index(Request $request){
    	$data = [];
      $coupons = Coupon::get();
      $data['coupons'] = $coupons;
      return view('admin.coupons.index',$data);
  }

  public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $coupons = '';
    if(is_numeric($id) && $id > 0){
        $coupons = Coupon::find($id);
        if(empty($coupons)){
            return redirect($this->ADMIN_ROUTE_NAME.'/coupon');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());


        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/coupon';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['name'] = 'required';
        $rules['vender_id'] = 'required';
        $rules['category_id'] = 'required';
        $rules['c_mrp'] = 'required';
        $rules['c_price'] = 'required';
        $rules['expary_date'] = 'required';
        $rules['nomber_of_use'] = 'required';



        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Coupon has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Coupon has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }




    $page_heading = 'Add Coupon';

    if(isset($coupons->name)){
        $coupons_name = $coupons->name;
        $page_heading = 'Update Coupons - '.$coupons_name;
    }  
    $data['vendors'] = Vendor::get();
    $data['categories'] = DB::table('coupan_catagory')->get();
    $data['page_heading'] = $page_heading;

    $data['id'] = $id;
    $data['coupons'] = $coupons;

    return view('admin.coupons.form', $data);

}


public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());
    $data['expary_date'] = CustomHelper::DateFormat($request->expary_date, 'Y-m-d', 'Y-m-d');
    $oldImg = '';

    $coupons = new Coupon;

    if(is_numeric($id) && $id > 0){
        $exist = Coupon::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $coupons = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $coupons->$key = $val;
    }

    $isSaved = $coupons->save();

        // if($isSaved){
        //     $this->saveImage($request, $testimonial, $oldImg);
        // }

    return $isSaved;
}




public function delete(Request $request){

        //prd($request->toArray());

    $id = (isset($request->id))?$request->id:0;

    $is_delete = '';

    if(is_numeric($id) && $id > 0){
        $is_delete = Coupon::where('id', $id)->delete();
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'Coupon has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}



public function get_category(Request $request){
    $vender_id = isset($request->vender_id) ? $request->vender_id :'';
    $html = '<option>Select Category</option>';
    $categories = DB::table('coupan_catagory')->where('vender_id',$vender_id)->get();
    if(!empty($categories)){
        foreach($categories as $cat){
            $html.='<option value='.$cat->id.' >'.$cat->name.'</option>';
        }

    }
    echo $html;


}

public function details(Request $request){
    $coup_id  = isset($request->coup_id) ? $request->coup_id :'';
    $data = [];
    if($coup_id !=''){
        $coupons = Coupon::where('id',$coup_id)->first();
        $data['coupons'] = $coupons;


        return view('admin.coupons.coupon_details', $data);
    }else{
        redirect($this->ADMIN_ROUTE_NAME.'/coupons');
    }

}


public function add_products(Request $request){
    $coup_id  = isset($request->coup_id) ? $request->coup_id :'';
    $product_id = (isset($request->product_id))?$request->product_id:0;

    $product = '';
    if(is_numeric($product_id) && $product_id > 0){
        $product = DB::table('coupan_product')->find($product_id);
        if(empty($product)){
            return redirect($this->ADMIN_ROUTE_NAME.'/coupon');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){
        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/coupon';
        }
        $name = (isset($request->name))?$request->name:'';            
        $rules = [];

            // $rules['name'] = 'required';
            // $rules['vender_id'] = 'required';
            // $rules['category_id'] = 'required';
            // $rules['c_mrp'] = 'required';
            // $rules['c_price'] = 'required';
            // $rules['expary_date'] = 'required';
            // $rules['nomber_of_use'] = 'required';
        $this->validate($request, $rules);

        $createdCat = $this->product_save($request, $product_id,$coup_id);

        if ($createdCat) {
            $alert_msg = 'Coupon has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Coupon has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }
    $data['product'] = $product;
    $data['coupon_id'] = $coup_id ;
    return view('admin.coupons.product_form', $data);




}

public function add_image(Request $request){

    $coup_id = isset($request->coup_id) ? $request->coup_id :'';
    $data = [];
    $ext = 'jpg,jpeg,png,gif';

    $method = $request->method();
    if($method == 'post' || $method == 'POST'){
       if($request->hasFile('image')) {
        $files = $request->file('image');
        $images_result = $this->saveImages($files, $coup_id, $ext);
        if($images_result){
         return redirect()->back();

     }
 }

}



$data['coupon_images'] = DB::table('vender_product_images')->where('coupan_id',$coup_id)->get();
return view('admin.coupons.image_form', $data);

}


public function saveImages($files, $coupan_id, $ext='jpg,jpeg,png,gif'){

    $is_inserted = '';

    if ($files && count($files) > 0) {

            //prd($files);

        $path = 'coupons/';
        $thumb_path = 'coupons/thumb/';

            //UploadImage($file, $path, $ext='', $width=768, $height=768, $is_thumb=false, $thumb_path, $thumb_width=300, $thumb_height=300)


        $IMG_WIDTH = 1600;
        $IMG_HEIGHT = 640;
        $THUMB_WIDTH =400;
        $THUMB_HEIGHT = 400;

        $images_data = [];

        foreach($files as $file){
            $upload_result = CustomHelper::UploadImage($file, $path, $ext, $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

            if($upload_result['success']){
                $images_data[] = array(
                    'coupan_id' => $coupan_id,
                    'product_image' => url('/public/storage/coupons/'.$upload_result['file_name']),
                    'created_at' =>date('Y-m-d-H-i-s'),
                );
            }
        }

        if(!empty($images_data) && count($images_data) > 0){
            $is_inserted = DB::table('vender_product_images')->insert($images_data);
        }

    }

    return $is_inserted;

}


public function delete_img(Request $request){
    $image_id = isset($request->image_id) ? $request->image_id :'';

    DB::table('vender_product_images')->where('id',$image_id)->delete();
    return redirect()->back();

}















}