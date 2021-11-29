<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;

use App\Vendor;
use App\Users;
use App\CouponCategory;
use Auth;
use DB;
use Validator;
use Storage;
use App\Cart;
use App\Order;
use Session;
use Hash;




class HomeController extends Controller
{

 public function __construct(){


 }
//  public function index(Request $request){
//      return view('welcome');
//  }

 public function index(Request $request){
  $data = [];
  $slug = isset($request->slug) ? $request->slug :'';
  $date = date('Y-m-d');
  $category_id = isset($request->category_id) ? $request->category_id :'all';
  if(!empty($slug)){

    $vendor = Vendor::where('slug',$slug)->first();
    if(!empty($vendor)){
      $data['vendor'] = $vendor;
      $coupon_Categories = DB::table('coupan_catagory')->where('status',1)->where('is_deleted',0)->where('vender_id',$vendor->id)->get();

      if($category_id == 'all'){
      $all_coupons = DB::table('coupan')->where('status',1)->where('vender_id',$vendor->id)->where('is_deleted',0)->where('expary_date','>',$date)->get();
    }else{
      $all_coupons = DB::table('coupan')->where('is_deleted',0)->where('status',1)->where('vender_id',$vendor->id)->where('category_id',$category_id)->where('expary_date','>',$date)->get();
    }




      $top_selling = [];
      $coup_ids = [];
      $order = DB::table('orders')->where('vendor_id',$vendor->id)->where('order_status','completed')->orderby('qty')->get();
      if(!empty($order)){
        foreach($order as $or){
          $coup_ids[] = $or->coupon_id;
        }
      }
      if(!empty($coup_ids)){
        $top_selling = DB::table('coupan')->where('status',1)->where('vender_id',$vendor->id)->wherein('id',$coup_ids)->where('expary_date','>',$date)->where('is_deleted',0)->get();
      }
      $ip_address = $request->ip();
      $visArr = [];
      $visArr['ip_address'] = $ip_address;
      $visArr['vendor_id'] = $vendor->id;

      DB::table('visitors')->insert($visArr);

    
      $data['coupon_Categories'] = $coupon_Categories;
      $data['category_id'] = $category_id;
      $data['all_coupons'] = $all_coupons;
      $data['top_selling'] = $top_selling;
      return view('front.home.index',$data);
    }else{
      abort(404);
    }
  }else{
    abort(404);
  }
}

public function get_cart(Request $request){
  $data = [];
  $slug = isset($request->slug) ? $request->slug : '';
    //prd($slug);

  if(!empty($slug)){
    $vendor = Vendor::where('slug',$slug)->first();
    $data['vendor'] = $vendor;
    $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';

    $carts = Cart::where('vendor_id',$vendor->id)->where('user_id',$user_id)->get();
    $data['carts'] = $carts;

    return view('front.home.cart',$data);

  }else{
    abort(404);
  }

}





public function profile(Request $request){
 $data = [];
 $slug = isset($request->slug) ? $request->slug : '';
 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  $pending_orders = Order::where('vendor_status','pending')->where('order_status','!=','cancel')->where('vendor_id',$vendor->id)->count();
  $cancel_orders = Order::where('order_status','cancel')->where('vendor_id',$vendor->id)->count();
  $complte_orders = Order::where('order_status','completed')->where('vendor_id',$vendor->id)->count();
  $all_order =  Order::where('vendor_id',$vendor->id)->count();
  $rejected_orders = Order::where('vendor_status','reject')->where('vendor_id',$vendor->id)->count();

  $data['pending_orders']= $pending_orders;
  $data['cancel_orders']= $cancel_orders;
  $data['complte_orders']= $complte_orders;
  $data['all_order']= $all_order;
  $data['rejected_orders']= $rejected_orders;


  return view('front.home.profile',$data);

}else{
  abort(404);
}
}

public function search(Request $request){
 $data = [];
 $slug = isset($request->slug) ? $request->slug : '';
 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;

  return view('front.home.search',$data);

}else{
  abort(404);
}
}


public function category_list(Request $request){

 $data = [];
 $slug = isset($request->slug) ? $request->slug : '';
 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;

  return view('front.home.category',$data);

}else{
  abort(404);
}
}




public function edit_profile(Request $request){
  $data = [];
  $slug = isset($request->slug) ? $request->slug : '';
  $user_id = isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id:'';
  $method = $request->method();
  if($method == 'POST' || $method == 'post'){
    $rules = [];
    $rules['name'] = 'required';
    $rules['email'] = 'required|email';
    $rules['mobile'] = 'required|numeric';
    $this->validate($request, $rules);
    $name = isset($request->name) ? $request->name :'';
    $email = isset($request->email) ? $request->email :'';
    $mobile = isset($request->mobile) ? $request->mobile :'';
    $dbArr = [];
    $dbArr['name'] = $name;
    $dbArr['email'] = $email;
    $dbArr['mobile'] = $mobile;
    $saveUser = Users::where('id',$user_id)->update($dbArr);
    if ($saveUser) {
      $alert_msg = 'Updated successfully.';
      return back()->with('alert-success', $alert_msg);
    } else {
      return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
    }
  }

  if(!empty($slug)){
    $vendor = Vendor::where('slug',$slug)->first();
    $data['vendor'] = $vendor;

    return view('front.home.edit_profile',$data);

  }else{
    abort(404);
  }
}

public function upload(Request $request){

 $this->validate($request, [
  'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);
 $user_id = isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id:'';
 if ($request->hasFile('image')) {
  $file = $request->file('image');
  $user = Users::find($user_id);

  $oldImg = isset($user->image) ? $user->image :'';
  $saved = $this->saveImage($file,$user,$oldImg);
  if($saved){
    $alert_msg = 'Updated successfully.';
    return back()->with('alert-success', $alert_msg);
  }else {
    return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
  }
}

}


public function saveImage($file, $user, $oldImg=''){
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

    $user->image = url('/public/storage/users/').'/'.$image;
    $user->save();         
  }

  if(!empty($uploaded_data)){   
    return $uploaded_data;
  }  

}

}

public function coupon_listing(Request $request){
  $data = [];
  $date = date('Y-m-d');
  $slug = isset($request->slug) ? $request->slug : '';
  $cat_id = isset($request->id) ? $request->id : '';
  if(!empty($slug)){
    $vendor = Vendor::where('slug',$slug)->first();
    $data['vendor'] = $vendor;
    $coupon_Categories = DB::table('coupan_catagory')->where('is_deleted',0)->where('status',1)->where('id',$cat_id)->where('vender_id',$vendor->id)->first();
    $coupons = DB::table('coupan')->where('status',1)->where('is_deleted',0)->where('category_id',$cat_id)->where('vender_id',$vendor->id)->where('expary_date','>',$date)->get();

 //prd($coupons);


    $data['coupons'] = $coupons;

    $data['coupon_Categories'] = $coupon_Categories;

    return view('front.home.coupon_listing',$data);

  }else{
    abort(404);
  }

}


public function purchase(Request $request){
  $data = [];
 $slug = isset($request->slug) ? $request->slug : '';
 $status = isset($request->status) ? $request->status : 'all';
 $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
 //echo $status;
 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  if($status == 'all'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->get();
  }elseif($status == 'pending'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('vendor_status','pending')->where('order_status','!=','cancel')->get();

  }elseif($status == 'completed'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('order_status','completed')->get();

  }elseif($status == 'cancel'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('order_status','cancel')->get();

  }elseif($status == 'reject'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('vendor_status','reject')->get();
  }else{
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->get();
  }

  $data['orders'] = $orders;
  return view('front.home.purchase',$data);

}else{
  abort(404);
}


}

public function winer_list(Request $request){
  $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  return view('front.home.winer_list',$data);

}else{
  abort(404);
}
}

public function offers(Request $request){
  $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  return view('front.home.offers',$data);

}else{
  abort(404);
}
}

public function merchant(Request $request){
  $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;

  return view('front.home.merchant',$data);

}else{
  abort(404);
}
}


public function product_listing(Request $request){

 $data = [];
 $date = date('Y-m-d');
 $coup_id = isset($request->id) ? $request->id :'';

 $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  $coupon = DB::table('coupan')->where('is_deleted',0)->where('status',1)->where('id',$coup_id)->where('vender_id',$vendor->id)->first();

  $products = DB::table('coupan_product')->where('coupan_id',$coup_id)->where('vender_id',$vendor->id)->get();

  $data['coupon'] = $coupon;
  $data['products'] = $products;


  return view('front.home.product_listing',$data);

}else{
  abort(404);
}


}

public function all_coupon_cat(Request $request){

 $data = [];
 $date = date('Y-m-d');
 $coup_id = isset($request->id) ? $request->id :'';
 $date = date('Y-m-d');
 $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  $coupon_Categories = DB::table('coupan_catagory')->where('is_deleted',0)->where('status',1)->where('vender_id',$vendor->id)->get();
  $all_coupons = DB::table('coupan')->where('is_deleted',0)->where('status',1)->where('vender_id',$vendor->id)->where('expary_date','>',$date)->get();
  $products = DB::table('coupan_product')->where('vender_id',$vendor->id)->count();

  $data['all_count_product'] = $products;

  $data['coupon_Categories'] = $coupon_Categories;
  $data['all_coupons'] = $all_coupons;

  return view('front.home.all_category',$data);

}else{
  abort(404);
}


}

public function add_to_cart(Request $request){
  $data = [];
  $date = date('Y-m-d');
  $slug = isset($request->slug) ? $request->slug :'';
  
  $coupon_id = isset($request->coupon_id) ? $request->coupon_id : '';
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
  if($user_id != ''){
    if($coupon_id !=''){
      if($slug !=''){
       $vendor = Vendor::where('slug',$slug)->first();
       $exists = Cart::where('user_id',$user_id)->where('coupon_id',$coupon_id)->where('vendor_id',$vendor->id)->first();

       $exist_coupon = DB::table('coupan')->where('id',$coupon_id)->first();
       $coupon_no = $exist_coupon->nomber_of_use - $exist_coupon->used;
       if(!empty($exists)){
        if($coupon_no != 0 && $exists->qty < $coupon_no){
         $dbArr = [];
         $dbArr['user_id'] = $user_id;
         $dbArr['coupon_id'] = $coupon_id;
         $dbArr['qty'] = ($exists->qty +1);
         $dbArr['vendor_id'] = $vendor->id;
         $res = Cart::where('id',$exists->id)->update($dbArr);
         echo json_encode(array('status'=>true,'message'=>'Cart Updated successfully'));


       }else{
         echo json_encode(array('status'=>false,'message'=>'Out of Stock'));

       }
     }
     else{
      if($coupon_no > 0){
       $dbArr = [];
       $dbArr['user_id'] = $user_id;
       $dbArr['coupon_id'] = $coupon_id;
       $dbArr['qty'] = 1;
       $dbArr['vendor_id'] = $vendor->id;
       $res = Cart::create($dbArr);
       echo json_encode(array('status'=>true,'message'=>'Add cart successfully'));
     }else{
       echo json_encode(array('status'=>false,'message'=>'Out of Stock'));

     }

   }




 }else{
  echo json_encode(array('status'=>false,'message'=>'Please Choose Vendor'));

}
}else{
  echo json_encode(array('status'=>false,'message'=>'Please Choose Coupon'));

}

}else{
  echo json_encode(array('status'=>false,'message'=>'Please Login'));
}



}


public function cart_minus(Request $request){
  $cart_id = isset($request->cart_id) ? $request->cart_id :'';
  $coupon_id = isset($request->coupon_id) ? $request->coupon_id :'';
  $vendor_id = isset($request->vendor_id) ? $request->vendor_id :'';
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
  $cart_qty = 0;
  if($cart_id !=''){
    $exists = Cart::where('id',$cart_id)->first(); 
    $qty = $exists->qty;
    $dbArr = [];
    $cart_qty = $qty;
    if($qty >1){

      $dbArr['qty'] = ($qty -1);
      $cart_qty = $dbArr['qty'];
      $res = Cart::where('id',$exists->id)->update($dbArr);
    }

    if(!empty($user_id)){
      $carts = Cart::where('user_id',$user_id)->where('vendor_id',$vendor_id)->get();
      if(!empty($carts)){
        $total =  0;
        foreach($carts as $cart){
         $coupon = DB::table('coupan')->where('id',$cart->coupon_id)->where('vender_id',$vendor_id)->first();
         $price = $cart->qty * $coupon->c_price;
         $total +=$price;
       }
     }
     echo json_encode(array('status'=>true,'total'=>$total,'qty'=>$cart_qty));

   }else{
    echo json_encode(array('status'=>false,'total'=>0,'message'=>'User Id Required'));

  }


}


}



public function cart_plus(Request $request){
  $cart_id = isset($request->cart_id) ? $request->cart_id :'';
  $coupon_id = isset($request->coupon_id) ? $request->coupon_id :'';
  $vendor_id = isset($request->vendor_id) ? $request->vendor_id :'';
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
  $cart_qty = 0;
  $exist_coupon = DB::table('coupan')->where('id',$coupon_id)->first();
  $coupon_no = $exist_coupon->nomber_of_use - $exist_coupon->used;


  if($cart_id !=''){
    $exists = Cart::where('id',$cart_id)->first(); 
    $qty = $exists->qty;
    $dbArr = [];
    $coupon = DB::table('coupan')->where('id',$coupon_id)->first();
    if($coupon_no >= $qty +1){
      $dbArr['qty'] = ($qty +1);
      $cart_qty = $dbArr['qty'];
      $res = Cart::where('id',$exists->id)->update($dbArr);

      if(!empty($user_id)){
        $carts = Cart::where('user_id',$user_id)->where('vendor_id',$vendor_id)->get();
        if(!empty($carts)){
          $total =  0;
          foreach($carts as $cart){
           $coupon = DB::table('coupan')->where('id',$cart->coupon_id)->where('vender_id',$vendor_id)->first();
           $price = $cart->qty * $coupon->c_price;
           $total +=$price;
         }
       }
       echo json_encode(array('status'=>true,'total'=>$total,'qty'=>$cart_qty));

     }else{
      echo json_encode(array('status'=>false,'total'=>0,'message'=>'User Id Required'));

    }
  }else{
    echo json_encode(array('status'=>false,'total'=>0,'message'=>'Out of Stock'));

  }

}


}

public function delete_cart_item(Request $request){
  $cart_id = isset($request->cart_id) ? $request->cart_id :'';
  $coupon_id = isset($request->coupon_id) ? $request->coupon_id :'';
  $vendor_id = isset($request->vendor_id) ? $request->vendor_id :'';
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';

  if($cart_id !=''){
    $exists = Cart::where('id',$cart_id)->first(); 

    if(!empty($exists)){
      $res = Cart::where('id',$exists->id)->delete();
      if(!empty($user_id)){
        $carts = Cart::where('user_id',$user_id)->where('vendor_id',$vendor_id)->get();
        if(!empty($carts)){
          $total =  0;
          foreach($carts as $cart){
           $coupon = DB::table('coupan')->where('id',$cart->coupon_id)->where('vender_id',$vendor_id)->first();
           $price = $cart->qty * $coupon->c_price;
           $total +=$price;
         }
       }
       echo json_encode(array('status'=>true,'total'=>$total));

     }else{
      echo json_encode(array('status'=>false,'total'=>0,'message'=>'User Id Required'));

    }


  }
}else{
  echo json_encode(array('status'=>false,'total'=>0,'message'=>'Cart Id Required'));

}




}


public function place_order(Request $request){
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
  $slug = isset($request->slug) ? $request->slug : '';
  $data = [];
  $cartArr = [];
  $order_ids = [];
  if(!empty($slug)){
    $vendor = Vendor::where('slug',$slug)->first();
    $data['vendor'] = $vendor;
    $users = DB::table('web_users')->where('id',$user_id)->first();
    $carts = Cart::where('user_id',$user_id)->where('vendor_id',$vendor->id)->get();

    if(!empty($carts)){
     foreach($carts as $cart){
      $dbArray = [];
      $coupon = DB::table('coupan')->where('id',$cart->coupon_id)->first();
      $dbArray['name'] = isset($users->name) ? $users->name :'';
      $dbArray['email'] = isset($users->email) ? $users->email :'';
      $dbArray['phone'] = isset($users->mobile) ? $users->mobile :'';
      $dbArray['order_status'] = 'pending';
      $dbArray['vendor_id'] = $vendor->id;
      $dbArray['total_price'] = $cart->qty * $coupon->c_price;
      $dbArray['vendor_status'] = 'accept';
      $dbArray['user_id'] = $user_id;
      $dbArray['expary_date'] = $coupon->expary_date;
      $dbArray['coupon_id'] = $cart->coupon_id;
      $dbArray['qty'] = $cart->qty;
      $dbArray['price'] = $coupon->c_price;

      //$dbArray['vendor_status'] = 'pending';
         // $order_item_id = DB::table('order_coupons')->insertGetId($itemArr);


      $order_id = DB::table('orders')->insert($dbArray);

      $getCoupon = DB::table('coupan')->where('id',$cart->coupon_id)->first();
      $used = $getCoupon->used;
      $qtyUpdate = [];
      $qtyUpdate['used'] = $used += $cart->qty;


      DB::table('coupan')->where('id',$cart->coupon_id)->update($qtyUpdate);
      $last_entry = DB::table('orders')->latest()->first();
      $order_ids[] = $last_entry;

      $cartArr[] = $cart;
      $request->session()->put('carts', $cart);


    }
    $data['order_ids'] = $order_ids;
    //pr($cartArr);

    //Session::push('carts', $cartArr);

    $cart_delete = Cart::where('user_id',$user_id)->where('vendor_id',$vendor->id)->delete();
    $data['carts'] = $carts;
    
    //prd($data);

    return view('front.home.order_success',$data);   
  }else{
    return back()->with('alert-danger', 'Add Something in Your Cart.');
  }

}else{
  abort(404);
}

}


public function secrch_suggest(Request $request){
  $secrch_keyword = isset($request->secrch_keyword) ? $request->secrch_keyword :'';
  $vender_id = isset($request->vendor_id) ? $request->vendor_id :'';

  $vendor = Vendor::where('id',$vender_id)->first();
  $coupons = DB::table('coupan')->where('name', 'like', '%' .$secrch_keyword . '%')->where('vender_id',$vender_id)->get();

  $html = '<section class="padding-x">
  <ul class="list-search-suggestion">';
  if(!empty($coupons) && count($coupons) > 0){
    foreach($coupons as $coup){
      $html.= '<li>
      <a href='.url($vendor->slug.'/products/'.$coup->id).' class="text">'.$coup->name.'</a>

      </li>';
    }
  }

  $html.='</ul>';


  echo $html;
}

public function order_details(Request $request){
 $data = [];
 $date = date('Y-m-d');
 $coup_id = isset($request->id) ? $request->id :'';

 $slug = isset($request->slug) ? $request->slug : '';

 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  $coupon = DB::table('coupan')->where('status',1)->where('id',$coup_id)->where('vender_id',$vendor->id)->first();

  $products = DB::table('coupan_product')->where('coupan_id',$coup_id)->where('vender_id',$vendor->id)->get();



  $data['coupon'] = $coupon;
  $data['products'] = $products;


  return view('front.home.order_details',$data);

}else{
  abort(404);
}
}





public function order_list(Request $request){
 $data = [];
 $slug = isset($request->slug) ? $request->slug : '';
 $status = isset($request->status) ? $request->status : '';
 $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
 //echo $status;
 if(!empty($slug)){
  $vendor = Vendor::where('slug',$slug)->first();
  $data['vendor'] = $vendor;
  if($status == 'all'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->get();
  }elseif($status == 'pending'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('vendor_status','pending')->where('order_status','!=','cancel')->get();

  }elseif($status == 'completed'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('order_status','completed')->get();

  }elseif($status == 'cancel'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('order_status','cancel')->get();

  }elseif($status == 'reject'){
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->where('vendor_status','reject')->get();
  }else{
    $orders = Order::where('user_id',$user_id)->where('vendor_id',$vendor->id)->get();
  }

  $data['orders'] = $orders;
  return view('front.home.orders_list',$data);

}else{
  abort(404);
}
}

public function cancel_order(Request $request){

  $order_id = $request->order_id ?? '';
  $orders = Order::where('id',$order_id)->first();
  if(!empty($orders)){
      $coupon_id = $orders->coupon_id;
      $coupons = DB::table('coupan')->where('id',$coupon_id)->first(); 
      $qty = $coupons->used - $orders->qty;
      DB::table('coupan')->where('id',$coupon_id)->update(array('used'=>$qty)); 
  }
  $update_order = Order::where('id',$order_id)->update(['order_status'=>'cancel']);
  if($update_order){
    echo json_encode(array('status'=>true,'message'=>'Order Canceled successfully'));
  }else{
    echo json_encode(array('status'=>false,'message'=>'Something Went Wrong'));
  }
}


public function change_password(Request $request){
  $data = [];
  $slug = isset($request->slug) ? $request->slug : '';
  $method = $request->method();
  $user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';

  if(!empty($slug)){
    $vendor = Vendor::where('slug',$slug)->first();
    $data['vendor'] = $vendor;
    if($method == 'post' || $method == 'POST'){
      $rules['old_password'] = 'required|min:6|max:20';
      $rules['password'] = 'required|min:6|max:20';
      $rules['confirm_password'] = 'required|min:6|max:20|same:password';
      $this->validate($request,$rules);

      $old_password = isset($request->old_password) ? $request->old_password :'';
      $password = isset($request->password) ? $request->password :'';
      $confirm_password = isset($request->confirm_password) ? $request->confirm_password :'';

      $user = Users::where(['id'=>$user_id])->first();
      $existing_password = (isset($user->password))?$user->password:'';
      $hash_chack = Hash::check($old_password, $existing_password);
      if($hash_chack){
        $update_data['password']=bcrypt(trim($password));
        $is_updated = DB::table('web_users')->where('id', $user_id)->update($update_data);
        if($is_updated){

          return back()->with('alert-success', 'Password Changed successfully.');
        }
        else{
         return back()->with('alert-danger', 'something went wrong, please try again or contact the administrator.');
       }
     }else{
      return back()->with('alert-danger', 'old Password Not Matched.');
    }

  }
  return view('front.home.change_password',$data);
}else{
  abort(404);
}

}












}
