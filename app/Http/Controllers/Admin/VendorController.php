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
use App\Vendor;
use App\BusinessCategory;





Class VendorController extends Controller
{

    private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }
    public function index(Request $request){
      $data = [];
      $vendors = Vendor::get();
      $business_category = BusinessCategory::get();
      
      $data['vendors'] = $vendors;
      $data['business_category'] = $business_category;
      return view('admin.vendors.index',$data);
  }


  public function add(Request $request){
    $data = [];

    $id = (isset($request->id))?$request->id:0;

    $vendors = '';
    if(is_numeric($id) && $id > 0){
        $vendors = Vendor::find($id);
        if(empty($vendors)){
            return redirect($this->ADMIN_ROUTE_NAME.'/vendors');
        }
    }

    if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());


        if(empty($back_url)){
            $back_url = $this->ADMIN_ROUTE_NAME.'/vendors';
        }

        $name = (isset($request->name))?$request->name:'';


        $rules = [];

        $rules['business_name'] = 'required';
        $rules['phone'] = 'required|numeric';
        $rules['slug'] = 'required';
        $rules['category_id'] = 'required';
        $rules['status'] = 'required';


        $this->validate($request, $rules);

        $createdCat = $this->save($request, $id);

        if ($createdCat) {
            $alert_msg = 'Vendor has been added successfully.';
            if(is_numeric($id) && $id > 0){
                $alert_msg = 'Vendor has been updated successfully.';
            }
            return redirect(url($back_url))->with('alert-success', $alert_msg);
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }




    $page_heading = 'Add Vendor';

    if(isset($categories->name)){
        $categories_name = $categories->name;
        $page_heading = 'Update Vendor - '.$categories_name;
    }  
    $business_category = BusinessCategory::where('status','active')->get();
    $data['page_heading'] = $page_heading;
    $data['business_category'] = $business_category;
    $data['id'] = $id;
    $data['vendors'] = $vendors;

    return view('admin.vendors.form', $data);

}


public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image','password']);

        //prd($request->toArray());
    $cat_id = isset($request->category_id) ? $request->category_id : '';
    if(!empty($cat_id)){
        DB::table('vender_cat')->where('vender_id',$id)->delete();
        foreach($cat_id as $key => $value){
           $dbArray = [];
           $dbArray['vender_id'] = $id;  
           $dbArray['cat_id'] = $value;
           DB::table('vender_cat')->insert($dbArray);

       }
   }

   $data['category_id'] = implode(" ,", $request->category_id);
   $oldImg = '';

   $testimonial = new Vendor;

   if(is_numeric($id) && $id > 0){
    $exist = Vendor::find($id);

    if(isset($exist->id) && $exist->id == $id){
        $testimonial = $exist;

        $oldImg = $exist->image;
    }
}
        //prd($oldImg);

foreach($data as $key=>$val){
    $testimonial->$key = $val;
}

$isSaved = $testimonial->save();

if($isSaved){
    $this->saveImage($request, $testimonial, $oldImg);
}

return $isSaved;
}

private function saveImage($request, $testimonial, $oldImg=''){

    $file = $request->file('image');

        //prd($old_file);

    if ($file) {
        $path = 'vendors/';
        $thumb_path = 'vendors/thumb/';
        $storage = Storage::disk('public');
            //prd($storage);


        $IMG_WIDTH = 768;
        $IMG_HEIGHT = 768;
        $THUMB_WIDTH = 336;
        $THUMB_HEIGHT = 336;

        $uploaded_data = CustomHelper::UploadImage($file, $path, $ext='', $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);


        if($uploaded_data['success']){

            if(!empty($oldImg)){
                if($storage->exists($path.$oldImg)){
                    $storage->delete($path.$oldImg);
                }
                if($storage->exists($thumb_path.$oldImg)){
                    $storage->delete($thumb_path.$oldImg);
                }
            }

            $image = $uploaded_data['file_name'];

            $testimonial->image = $image;
            $testimonial->save();         
        }

        if(!empty($uploaded_data)){   
            return $uploaded_data;
        }  

    }

}


public function delete(Request $request){

        //prd($request->toArray());

    $id = (isset($request->id))?$request->id:0;

    $is_delete = '';

    if(is_numeric($id) && $id > 0){
        $is_delete = Vendor::where('id', $id)->delete();
    }

    if(!empty($is_delete)){
        return back()->with('alert-success', 'Vendor has been deleted successfully.');
    }
    else{
        return back()->with('alert-danger', 'something went wrong, please try again...');
    }
}

/* ajax_delete_image */
public function ajax_delete_image(Request $request){

        // prd($request->toArray());

    $response['success'] = false;

    $id = ($request->has('id'))?$request->id:0;

    if (is_numeric($id) && $id > 0) {
        $testimonial = Vendor::find($id);

        if(isset($testimonial->id) && $testimonial->id == $id){

            $path = 'vendors/';
            $thumb_path = 'vendors/thumb/';
            $storage = Storage::disk('public');

            $image = $testimonial->image;

            $isImgDeleted = false;

            if(!empty($image)){
                if($storage->exists($path.$image)){
                    $isImgDeleted = $storage->delete($path.$image);
                }
                if($storage->exists($thumb_path.$image)){
                    $isImgDeleted = $storage->delete($thumb_path.$image);
                }
            }

            if($isImgDeleted){
                $response['success'] = true;
            }
        }

    }

    return response()->json($response);
}

public function get_slug(Request $request){
    $id = isset($request->id) ? $request->id : '';
    $business_name = isset($request->business_name) ? $request->business_name : '';
    $slug = CustomHelper::GetSlug('vendors', 'id', $id, $business_name);
    $response = [];
    $response['success'] = true;
    $response['slug'] = $slug;
    return response()->json($response);
}

public function working_hour(Request $request){
    $data = [];

    $vendor_id = isset($request->ven_id) ? $request->ven_id : '';


    $ven_id = isset($request->vendor_id) ? $request->vendor_id : '';

    $method = $request->method();
    if($method == 'post' || $method =='POST'){
        $createdCat = $this->savehour($request, $ven_id);

        if ($createdCat) {
            return back()->with('alert-success','Hour Updated successfully');
        } else {
            return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
        }
    }





    if($vendor_id !=''){
        $vendor = Vendor::where('id',$vendor_id)->first(); 


        $data['vendor'] = $vendor;


        $data['vendor_id'] = isset($vendor->id) ? $vendor->id :'';

        $data['vendor_name'] = isset($vendor->business_name) ? $vendor->business_name :'';
        return view('admin.vendors.working_hours', $data);

    }else{
        redirect('/admin');
    }

}


public function savehour(Request $request, $id=0){
    $data_update = array();
    $mon_from = isset($request->mon_from) ? $request->mon_from :'';
    $mon_to = isset($request->mon_to) ? $request->mon_to :'';
    $mon_status = isset($request->mon_status) ? $request->mon_status :'';

    $tue_from = isset($request->tue_from) ? $request->tue_from :'';
    $tue_to = isset($request->tue_to) ? $request->tue_to :'';
    $tue_status = isset($request->tue_status) ? $request->tue_status :'';


    $wed_from = isset($request->wed_from) ? $request->wed_from :'';
    $wed_to = isset($request->wed_to) ? $request->wed_to :'';
    $wed_status = isset($request->wed_status) ? $request->wed_status :'';


    $thur_from = isset($request->thur_from) ? $request->thur_from :'';
    $thur_to = isset($request->thur_to) ? $request->thur_to :'';
    $thur_status = isset($request->thur_status) ? $request->thur_status :'';


    $fri_from = isset($request->fri_from) ? $request->fri_from :'';
    $fri_to = isset($request->fri_to) ? $request->fri_to :'';
    $fri_status = isset($request->fri_status) ? $request->fri_status :'';

    $sat_from = isset($request->sat_from) ? $request->sat_from :'';
    $sat_to = isset($request->sat_to) ? $request->sat_to :'';
    $sat_status = isset($request->sat_status) ? $request->sat_status :'';

    $sun_from = isset($request->sun_from) ? $request->sun_from :'';
    $sun_to = isset($request->sun_to) ? $request->sun_to :'';
    $sun_status = isset($request->sun_status) ? $request->sun_status :'';


    if (isset($mon_from) && !empty($mon_from)) {
        $data_update['mon_from'] = $mon_from;
    }
    if (isset($mon_to) && !empty($mon_to)) {
        $data_update['mon_to'] = $mon_to;
    }
    if (isset($mon_status) && !empty($mon_status)) {
        $data_update['mon_status'] = $mon_status;
    }

    if (isset($tue_from) && !empty($tue_from)) {
        $data_update['tue_from'] = $tue_from;
    }
    if (isset($tue_status) && !empty($tue_status)) {
        $data_update['tue_status'] = $tue_status;
    }
    if (isset($tue_to) && !empty($tue_to)) {
        $data_update['tue_to'] = $tue_to;
    }


    if (isset($wed_from) && !empty($wed_from)) {
        $data_update['wed_from'] = $wed_from;
    }
    if (isset($wed_to) && !empty($wed_to)) {
        $data_update['wed_to'] = $wed_to;
    }
    if (isset($wed_status) && !empty($wed_status)) {
        $data_update['wed_status'] = $wed_status;
    }

    if (isset($thur_from) && !empty($thur_from)) {
        $data_update['thur_from'] = $thur_from;
    }
    if (isset($thur_to) && !empty($thur_to)) {
        $data_update['thur_to'] = $thur_to;
    }
    if (isset($thur_status) && !empty($thur_status)) {
        $data_update['thur_status'] = $thur_status;
    }


    if (isset($fri_from) && !empty($fri_from)) {
        $data_update['fri_from'] = $fri_from;
    }
    if (isset($fri_to) && !empty($fri_to)) {
        $data_update['fri_to'] = $fri_to;
    }
    if (isset($fri_status) && !empty($fri_status)) {
        $data_update['fri_status'] = $fri_status;
    }


    if (isset($sat_from) && !empty($sat_from)) {
        $data_update['sat_from'] = $sat_from;
    }
    if (isset($sat_to) && !empty($sat_to)) {
        $data_update['sat_to'] = $sat_to;
    }
    if (isset($sat_status) && !empty($sat_status)) {
        $data_update['sat_status'] = $sat_status;
    }

    if (isset($sun_from) && !empty($sun_from)) {
        $data_update['sun_from'] = $sun_from;
    }
    if (isset($sun_to) && !empty($sun_to)) {
        $data_update['sun_to'] = $sun_to;
    }
    if (isset($sun_status) && !empty($sun_status)) {
        $data_update['sun_status'] = $sun_status;
    }
    
    $isSaved = Vendor::where('id',$id)->update($data_update);

    return $isSaved;
}







}