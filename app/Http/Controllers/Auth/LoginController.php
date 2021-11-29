<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\CustomHelper;

use DB;
use Validator;
use App\Users;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    ////Auth::guard('appusers')->user()->name;
    public function index_old(Request $request){
        $referer = isset($request->referer) ? $request->referer :'';

        $data['referer'] = $referer;
        $method = $request->method();
        if($method == 'POST' || $method == 'post'){
            $rules = [];
            $rules['mobile'] = 'required|numeric';
            $rules['password'] = 'required';
            $this->validate($request, $rules);
            if (Auth::guard('appusers')->attempt(['mobile' => $request->mobile, 'password' => $request->password]))
            { 
                $url = url('/').'/'.$referer;
                return redirect($url);
            }else{
                return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
            }



        }

        return view('front.login',$data);
        

    }

    public function index(Request $request){
        $referer = isset($request->referer) ? $request->referer :'';
        $full_url = isset($request->full_url) ? $request->full_url :'';

        $data['referer'] = $referer;
        $method = $request->method();
        if($method == 'POST' || $method == 'post'){
            $rules = [];
            $rules['mobile'] = 'required|numeric';
            //echo $request->mobile;
            $this->validate($request, $rules);



            $user_exist = Users::where('mobile',$request->mobile)->first();
            if (!empty($user_exist)) {
              // Auth::guard('appusers')->loginUsingId($user_exist->id);


                Auth::guard('appusers')->loginUsingId($user_exist->id,true);


             $url = url('/').'/'.$referer;

             return response()->json(array('success'=>true,'url'=>$url));

             
         }else{
            return response()->json(array('success'=>true,'url'=>$full_url));

        }


    }

    return view('front.login',$data);


}



public function register(Request $request){
 $referer = isset($request->referer) ? $request->referer :'';
 $id = isset($request->id) ? $request->id :'';
 $data['referer'] = $referer;
 $method = $request->method();
 if($method == 'POST' || $method == 'post'){
    $rules = [];
    $rules['name'] = 'required';
    $rules['email'] = 'required|email|unique:web_users,email';
    $rules['mobile'] = 'required|numeric|unique:web_users,mobile';
    $rules['password'] = 'required';
    $this->validate($request, $rules);
    $saveUser = $this->save($request, $id);
    if ($saveUser) {
        $alert_msg = 'Registered successfully.';
        return redirect(url($referer))->with('alert-success', $alert_msg);
    } else {
        return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
    }




}




return view('front.register',$data);
}


public function save(Request $request, $id=0){

    $data = $request->except(['_token', 'back_url', 'image','referer']);

        //prd($request->toArray());
    $data['password'] = bcrypt($request->password);
    $oldImg = '';

    $user = new Users;

    if(is_numeric($id) && $id > 0){
        $exist = Users::find($id);

        if(isset($exist->id) && $exist->id == $id){
            $user = $exist;

            $oldImg = $exist->image;
        }
    }
        //prd($oldImg);

    foreach($data as $key=>$val){
        $user->$key = $val;
    }

    $isSaved = $user->save();

    return $isSaved;
}




public function logout(Request $request){

        //prd($request->toArray());
    $referer = isset($request->referer) ? $request->referer :'';
        //$this->guard('appusers')->logout();

    $request->session()->invalidate();

    return redirect($referer);
}


}
