@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'category/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Orders Details</div>
      <!-- <a href="{{ route($ADMIN_ROUTE_NAME.'.category.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Coupon Category</a> -->
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Orders</h4>
        </div>
        <div class="card-content ">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dom-jQuery-events">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Vendor Name</th>
                    <th>Coupon Name</th>
                    <th>Coupon Price</th>
                    <th>Quantity</th>
                    <th>Order Status</th>
                    <th>Total Price</th>
                    <th>Vendor Status</th>
                    <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($orders)){
                  $i=1;
                  foreach($orders as $order){
                    $coupon_name = '';
                    $vendor_name = '';
                    $coupon = DB::table('coupan')->where('id',$order->coupon_id)->first();
                    if(!empty($coupon)){
                      $coupon_name = $coupon->name;
                    }
                    $vendor = DB::table('vendors')->where('id',$order->vendor_id)->first();
                    if(!empty($vendor)){
                      $vendor_name = $vendor->business_name;
                    }

                  ?>
              	
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$coupon_name}}</td>
                    <td>{{$vendor_name}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{$order->order_status}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->vendor_status}}</td>
                    <td>{{$order->created_at}}</td>
                    

                  </tr>
              <?php }}?>
             	</tbody>
               
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</div>
@include('admin.common.footer')
