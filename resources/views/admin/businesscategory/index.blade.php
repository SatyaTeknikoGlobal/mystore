@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'businesscategory/';
?>
 <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper">
          	<div class="row">
  <div class="col-12">
    <div class="content-header">Business Categories Details</div>
      <a href="{{ route($ADMIN_ROUTE_NAME.'.businesscategory.add')}}" class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> Add Business Category</a>
  </div>
</div>
  @include('snippets.errors')
        @include('snippets.flash')
<section id="dom">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Business Categories</h4>
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
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($categories) && count($categories) > 0){
                  $i=1;
              		foreach($categories as $cat){
              		?>
                  <tr>
                    <td>{{$i++}}</td>
              			<td>{{$cat->name}}</td>



              			<td> <?php 
                     if(!empty($cat->image)){
                    if($storage->exists($path.$cat->image)){
                    ?>
                    <a href="{{ url('public/storage/'.$path.$cat->image) }}" target="_blank">
                      <img src="{{ url('public/storage/'.$path.'thumb/'.$cat->image) }}" style="width:70px;">
                      </a>
        
                  <?php }}?>

                    </td>
              			<td><?php if($cat->status == 'active'){?>
              				<div class="ng-star-inserted"><div class="badge badge-pill bg-light-success">Active</div></div>
              			<?php }else{?>
              			<div class="ng-star-inserted"><div class="badge badge-pill bg-light-danger"> InActive </div></div>
              			<?php }?>
              			</td>
              			<td>
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.businesscategory.edit', $cat->id) }}"><i class="ft-edit text-primary cursor-pointer ng-star-inserted"></i></a> &nbsp;&nbsp;
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.businesscategory.delete', $cat->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a></td>

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
