<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller{
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index(Request $request){

        if (auth()->user()){
           return redirect('admin');
       }

       $method = $request->method();

       if($method == 'POST' || $method == 'post'){
        $rules = [];
        $rules['username'] = 'required';
        $rules['password'] = 'required';

        $this->validate($request, $rules);
        //prd($request->toArray());
        $credentials = $request->only('username', 'password');
        //if (Auth::attempt($credentials))
        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password]))
        {
            
            $request->session()->regenerate();
            return redirect('admin');
        }else{
           
        }



    }

    return view('admin/login/index');
}


// public function auth(Request $request){

//         //prd($request->toArray());
//     $this->validate($request, [
//         'username' => 'required|email',
//         'password' => 'required',
//     ]);
//     if (auth()->guard('admin')->attempt(['email' => $request->input('username'), 'password' => $request->input('password')]))
//     {
//         return redirect('admin');
//     }
//     else{
//             //dd('your username and password are wrong.');

//         $errors['err_msg'] = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Your username or password is wrong</strong>.</div>';

//         return back()->with($errors);
//     }
// }

public function logout(Request $request){


    // auth()->user('admin')->logout();
    Auth::logout();

    $request->session()->invalidate();

    return redirect('/admin');
}

/*End of controller */
}