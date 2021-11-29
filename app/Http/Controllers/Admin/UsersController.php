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
Class UsersController extends Controller
{
    
    private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
    }

    public function index(Request $equest){

    	$data = [];
    	$users = Users::get();
    	$data['users'] = $users;
    	return view('admin.users.index',$data);
    }
public function add(Request $request){
        $data = [];

        $id = (isset($request->id))?$request->id:0;

        $users = '';
        if(is_numeric($id) && $id > 0){
            $users = Users::find($id);
            if(empty($users)){
                return redirect($this->ADMIN_ROUTE_NAME.'/users');
            }
        }

        if($request->method() == 'POST' || $request->method() == 'post'){

            //prd($request->toArray());


            if(empty($back_url)){
                $back_url = $this->ADMIN_ROUTE_NAME.'/users';
            }

            $name = (isset($request->name))?$request->name:'';
            

            $rules = [];

            $rules['name'] = 'required';
            $rules['city'] = 'required';
            $rules['mobile'] = 'required';
            $rules['address'] = 'required';
           

            $this->validate($request, $rules);

            $createdUser = $this->save($request, $id);

            if ($createdUser) {
                $alert_msg = 'User has been added successfully.';
                if(is_numeric($id) && $id > 0){
                    $alert_msg = 'User has been updated successfully.';
                }
                return redirect(url($back_url))->with('alert-success', $alert_msg);
            } else {
                return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
            }
        }

       
      

        $page_heading = 'Add User';

        if(isset($users->name)){
            $users_name = $users->name;
            $page_heading = 'Update User - '.$users_name;
        }  

        $data['page_heading'] = $page_heading;
        $data['id'] = $id;
        $data['users'] = $users;

        return view('admin.users.form', $data);

    }


    public function save(Request $request, $id=0){

        $data = $request->except(['_token', 'back_url', 'image']);

        //prd($request->toArray());

        $oldImg = '';

        $testimonial = new Users;

        if(is_numeric($id) && $id > 0){
            $exist = Users::find($id);

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
            $path = 'users/';
            $thumb_path = 'users/thumb/';
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
            $is_delete = Category::where('id', $id)->delete();
        }

        if(!empty($is_delete)){
            return back()->with('alert-success', 'Category has been deleted successfully.');
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
            $testimonial = Category::find($id);

            if(isset($testimonial->id) && $testimonial->id == $id){

                $path = 'users/';
                $thumb_path = 'users/thumb/';
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


}