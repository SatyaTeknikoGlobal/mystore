@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'products/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Ready Made Products</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Products</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">ReadyMade Products List</h4>
        </div>
        <div class="card-content ">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dom-jQuery-events ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>MRP</th>
                    <th>Selling Price </th>
                    <th>Collections</th>
                    <th>Varients</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($products) && count($products) > 0){
                  $i = 1;
              		foreach($products as $pro){
              		?>
                  <tr>
                    <td>{{$i++}}</td>
              			<td>{{$pro->product_name}}</td>
              			<td><?php 
                     if(!empty($pro->image)){
                    if($storage->exists($path.$pro->image)){
                    ?>
                    <a href="{{ url('public/storage/'.$path.$pro->image) }}" target="_blank">
                      <img src="{{ url('public/storage/'.$path.'thumb/'.$pro->image) }}" style="width:70px;">
                      </a>
        
                  <?php }}?>

                    </td>
                    <td>{{$pro->product_name}}</td>
                    <td>{{$pro->mrp}}</td>
                    <td>{{$pro->selling_price}}</td>
                    <td>{{$pro->collection_id}}</td>
                    <td>{{$pro->varient_type}}</td>
              			<td><?php if($pro->status == 'active'){?>
              				<div class="ng-star-inserted"><div class="badge badge-pill bg-light-success">Active</div></div>
              			<?php }else{?>
              			<div class="ng-star-inserted"><div class="badge badge-pill bg-light-danger"> InActive </div></div>
              			<?php }?>
              			</td>
              			<td><a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.add_image', $pro->id) }}" title="Gallery"><i class="fa fa-picture-o" aria-hidden="true"></i></a> &nbsp;&nbsp;

                      <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.edit', $pro->id) }}"><i class="ft-edit text-primary cursor-pointer ng-star-inserted" title="Edit"></i></a> &nbsp;&nbsp;
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.delete', $pro->id) }}" onclick="return confirm('Are You Want To Delete')" title="Delete"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a></td>

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
