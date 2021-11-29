@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');

?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
            <div class="row">
  <div class="col-12">
    <div class="content-header">Products List - {{$coupons->name}}</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.add_products',['coup_id'=>$coupons->id])}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Coupon Products</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Products</h4>
        </div>
        <div class="card-content ">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dom-jQuery-events">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Coupon Name</th>
                    <th>Product Name</th>
                    <th>Order Qty</th>
                    <th>Price</th>
                    <th>Unit</th>
                    
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
               
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
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
