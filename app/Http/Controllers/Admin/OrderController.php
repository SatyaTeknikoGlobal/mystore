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
use App\Order;




Class OrderController extends Controller
{
    
    private $ADMIN_ROUTE_NAME;

    public function __construct(){

        $this->ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


    }
	public function index(Request $request){
		$data = [];
        $type = isset($request->type) ? $request->type :'';
        $id = isset($request->id) ? $request->id :'';
        $orders = [];
        if($type == 'all' && $id == 0){
		$orders = Order::orderby('id','desc')->get();
        }
        if($type == 'user'){
            $orders = Order::where('user_id',$id)->orderby('id','desc')->get();
        }
        if($type == 'vendor'){
            $orders = Order::where('vendor_id',$id)->orderby('id','desc')->get();
        }
        $data['orders'] = $orders;
        return view('admin.orders.index',$data);
    }






}