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
use App\Users;
use App\ReadyMade;
use App\ProductImage;

Class ReadyMadeController extends Controller
{
    
    private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $request){
    	$data = [];
    	$products = ReadyMade::get();

    	$data['products'] = $products;
    	return view('admin.readymade.index',$data);

    }


    public function add(Request $request){
        $data = [];

        $id = (isset($request->id))?$request->id:0;

        $products = '';
        if(is_numeric($id) && $id > 0){
            $products = ReadyMade::find($id);
            if(empty($products)){
                return redirect($this->ADMIN_ROUTE_NAME.'/readymadeproducts');
            }
        }

        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());


            if(empty($back_url)){
                $back_url = $this->ADMIN_ROUTE_NAME.'/readymadeproducts';
            }

            $name = (isset($request->name))?$request->name:'';
            

            $rules = [];

            $rules['product_name'] = 'required';
            $rules['mrp'] = 'required';
            $rules['selling_price'] = 'required';
            $rules['unit'] = 'required';
           

            $this->validate($request, $rules);

            $createdUser = $this->save($request, $id);

            if ($createdUser) {
                $alert_msg = 'Products has been added successfully.';
                if(is_numeric($id) && $id > 0){
                    $alert_msg = 'Products has been updated successfully.';
                }
                return redirect(url($back_url))->with('alert-success', $alert_msg);
            } else {
                return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
            }
        }

       
      

        $page_heading = 'Add Products';

        if(isset($products->product_name)){
            $products_name = $products->product_name;
            $page_heading = 'Update Products - '.$products_name;
        }  

        $data['page_heading'] = $page_heading;
        $data['id'] = $id;
        $data['products'] = $products;

        return view('admin.readymade.form', $data);

    }


    public function save(Request $request, $id=0){

        $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());

        $oldImg = '';

        $testimonial = new ReadyMade;

        if(is_numeric($id) && $id > 0){
            $exist = ReadyMade::find($id);

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
            $path = 'products/';
            $thumb_path = 'products/thumb/';
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

                $testimonial->image = url('/products/').$image;
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
            $is_delete = ReadyMade::where('id', $id)->delete();
        }

        if(!empty($is_delete)){
            return back()->with('alert-success', 'Product has been deleted successfully.');
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
            $testimonial = ReadyMade::find($id);

            if(isset($testimonial->id) && $testimonial->id == $id){

                $path = 'products/';
                $thumb_path = 'products/thumb/';
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


    public function add_image(Request $request){
        $data = [];

        $product_id = isset($request->id) ? $request->id : '';
        if(!empty($product_id)){
        $images = ProductImage::where('product_id',$product_id)->get();
        $method = $request->method();
        if($method =='post' || $method =='POST'){
        if($request->hasFile('image')) {
            $ext='jpg,jpeg,png,gif';
            $files = $request->file('image');
            $images_result = $this->saveImages($files, $product_id, $ext);
        }
    }


        

        $data['images'] = $images;
        return view('admin.readymade.upload',$data);
    }else{
        abort(404);
    }

    }

    public function saveImages($files, $product_id, $ext='jpg,jpeg,png,gif'){

        $is_inserted = '';

        if ($files && count($files) > 0) {

            //prd($files);

           $path = 'products/';
            $thumb_path = 'products/thumb/';
            $storage = Storage::disk('public');
            //prd($storage);

    
            $IMG_WIDTH = 768;
            $IMG_HEIGHT = 768;
            $THUMB_WIDTH = 336;
            $THUMB_HEIGHT = 336;


            $images_data = [];

            foreach($files as $file){
                $upload_result = CustomHelper::UploadImage($file, $path, $ext, $IMG_WIDTH, $IMG_HEIGHT, $is_thumb=true, $thumb_path, $THUMB_WIDTH, $THUMB_HEIGHT);

                if($upload_result['success']){
                    $images_data[] = array(
                        'product_id' => $product_id,
                        'image' => $upload_result['file_name']
                    );
                }
            }

            if(!empty($images_data) && count($images_data) > 0){
                $is_inserted = ProductImage::insert($images_data);
            }

        }

        return $is_inserted;

    }



}