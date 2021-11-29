@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'vendors/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Vendors List</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.vendors.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Vendors</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vendor</h4>
        </div>
        <div class="card-content ">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dom-jQuery-events">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Business Category</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($vendors) && count($vendors) > 0){
                  $i=1;
              		foreach($vendors as $ven){
              		?>
                  <tr>
                    <td>{{$i++}}</td>
              			<td>{{$ven->business_name}}</td>
              			<td> <?php 
                     if(!empty($ven->image)){
                    if($storage->exists($path.$ven->image)){
                    ?>
                    <a href="{{ url('public/storage/'.$path.$ven->image) }}" target="_blank">
                      <img src="{{ url('public/storage/'.$path.'thumb/'.$ven->image) }}" style="width:70px;">
                      </a>
        
                  <?php }}?>

                    </td>
                    <td><a href="{{url('/'.$ven->slug)}}" target="_blank">{{url('/'.$ven->slug)}}</a></td>


                    <td>
                      <?php
                      if(!empty($ven->category_id)){
                      $vendor_cat_id = explode(' ,',$ven->category_id);
                      foreach($vendor_cat_id as $key => $value){
                      $bus_cat = \App\BusinessCategory::where('id',$value)->first();
                      echo $bus_cat->name;echo "<br>";
                    }}
                        // if(!empty($business_category) && count($business_category) > 0){
                        //   foreach($business_category as $business_cat){
                        //       if($business_cat->id == )
                        //   }
                        // }
                      ?>
                    </td>


              			<td><?php if($ven->status == 'active'){?>
              				<div class="ng-star-inserted"><div class="badge badge-pill bg-light-success">Active</div></div>
              			<?php }else{?>
              			<div class="ng-star-inserted"><div class="badge badge-pill bg-light-danger"> InActive </div></div>
              			<?php }?>
              			</td>
              			<td>
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.vendors.edit', $ven->id) }}"><i class="ft-edit text-primary cursor-pointer ng-star-inserted"></i></a> &nbsp;&nbsp;
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.vendors.delete', $ven->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a>&nbsp;&nbsp;

                        <a href="{{ route($ADMIN_ROUTE_NAME.'.orders.index',['type'=>'vendor','id'=>$ven->id]) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>&nbsp;&nbsp;

                        <a href="{{ route($ADMIN_ROUTE_NAME.'.vendors.working-hour', $ven->id) }}"><i class="fa fa-clock-o" aria-hidden="true"></i></a>


                    </td>

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
