<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\CustomHelper;
use Illuminate\Support\Facades\Auth;
use App\Vendor;
use App\CouponCategory;
use App\Cart;




class CartController extends Controller
{
	


	public function index(Request $request){
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


}