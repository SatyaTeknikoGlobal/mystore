@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'collections/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Collection List</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.collections.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Collection</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Collections</h4>
        </div>
        <div class="card-content ">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dom-jQuery-events">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($collections) && count($collections) > 0){
                  $i=1;
              		foreach($collections as $coll){
              		?>
                  <tr>
                    <td>{{$i++}}</td>
              			<td><?php 
                    //echo $coll->vendor_id;
                    $vendor = \App\Vendor::where('id',$coll->vendor_id)->first();
                    //pr($vendor);
                    echo $vendor->business_name;
                    ?></td>
                    <td>{{$coll->name}}</td>



              			<td> <?php 
                     if(!empty($coll->image)){
                    if($storage->exists($path.$coll->image)){
                    ?>
                    <a href="{{ url('public/storage/'.$path.$coll->image) }}" target="_blank">
                      <img src="{{ url('public/storage/'.$path.'thumb/'.$coll->image) }}" style="width:70px;">
                      </a>
        
                  <?php }}?>

                    </td>
              			<td><?php if($coll->status == 'active'){?>
              				<div class="ng-star-inserted"><div class="badge badge-pill bg-light-success">Active</div></div>
              			<?php }else{?>
              			<div class="ng-star-inserted"><div class="badge badge-pill bg-light-danger"> InActive </div></div>
              			<?php }?>
              			</td>
              			<td>
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.collections.edit', $coll->id) }}"><i class="ft-edit text-primary cursor-pointer ng-star-inserted"></i></a> &nbsp;&nbsp;
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.collections.delete', $coll->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a></td>

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
