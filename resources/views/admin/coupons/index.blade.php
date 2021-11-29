@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'coupons/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Coupon List</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Coupon</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Coupons</h4>
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
                    <th>Coupon Category</th>
                    <!-- <th>Image</th> -->
                    <th>No of Use</th>
                    <th>Price</th>
                    <th>Expairy Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($coupons) && count($coupons) > 0){
                  $i=1;
              		foreach($coupons as $coup){
                    $vendor = \App\Vendor::where('id',$coup->vender_id)->first();
                    $coup_img = DB::table('vender_product_images')->where('coupan_id',$coup->id)->first();
                    $imgUrl = '';
                    if(!empty($coup_img)){
                      $imgUrl = $coup_img->product_image;
                    }
                    $category = DB::table('coupan_catagory')->where('id',$coup->category_id)->first();
              		?>
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$vendor->business_name ?? ''}}</td>
                    <td>{{$coup->name}}
                      <!-- <a href="{{route($ADMIN_ROUTE_NAME.'.coupon.details', $coup->id)}}">{{$coup->name}}</a></td> -->
                    <td>{{isset($category->name) ? $category->name :''}}</td>
                    <!-- <td> -->
                      <?php //if($imgUrl != ''){?>
                        <!-- <img src="{{$imgUrl}}" width="50" height="50"> -->
                      <?php //}?>

                    <!-- </td> -->
              			<td>{{$coup->nomber_of_use}}</td>
                    <td>{{$coup->c_price}}</td>
                    <td>{{$coup->expary_date}}</td>
                    
              			<td><?php if($coup->status == '1'){?>
              				<div class="ng-star-inserted"><div class="badge badge-pill bg-light-success">Active</div></div>
              			<?php }else{?>
              			<div class="ng-star-inserted"><div class="badge badge-pill bg-light-danger"> InActive </div></div>
              			<?php }?>
              			</td>
              			<td>
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.edit', $coup->id) }}"><i class="ft-edit text-primary cursor-pointer ng-star-inserted"></i></a> &nbsp;&nbsp;

                      <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.add_image', $coup->id) }}"><i class="fa fa-image"></i></a>



                      &nbsp;&nbsp;
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.delete', $coup->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a></td>

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
