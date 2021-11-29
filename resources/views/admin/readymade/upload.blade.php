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
    <div class="content-header">Product Image</div>
    <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
  </div>
</div>
<section id="input-file-browser">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Images</h4>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
              @csrf
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                                <label for="basicInputFile">Image</label>
                                <input type="file" class="form-control-file" id="basicInputFile" name="image[]" multiple>
                            </fieldset>
                        </div>

                        <div class="col-md-6 col-12">
                            
                        <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>Save</button>
                    <button type="button" class="btn btn-secondary"><i class="ft-x mr-1"></i>Cancel</button>
            
                        </div>
                
                    </div>
                </div>
            </div>
</form>
        </div>
    </div>
  </div>
</section>









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
              <table class="table table-striped table-bordered dom-jQuery-events">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
              	<?php if(!empty($images) && count($images) > 0){
                  $i = 1;
              		foreach($images as $pro){
              		?>
                  <tr>
                    <td>{{$i++}}</td>
              			<td><?php 
                     if(!empty($pro->image)){
                    if($storage->exists($path.$pro->image)){
                    ?>
                    <a href="{{ url('public/storage/'.$path.$pro->image) }}" target="_blank">
                      <img src="{{ url('public/storage/'.$path.'thumb/'.$pro->image) }}" style="width:70px;">
                      </a>
        
                  <?php }}?>

                    </td>
          
              			<td>
                      <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.delete', $pro->id) }}" onclick="return confirm('Are You Want To Delete')"><i class="ft-trash text-primary cursor-pointer ng-star-inserted"></i></a></td>

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
