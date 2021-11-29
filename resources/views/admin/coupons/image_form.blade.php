
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$routeName = CustomHelper::getAdminRouteName();

?>


<div class="main-panel">
  <!-- BEGIN : Main Content-->
  <div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="content-header"></div>
          <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
        </div>
      </div>
  
      @include('snippets.flash')
      <section id="action-form-layout">
        <div class="row match-height">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add Images</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Images </label>
                        <input type="file" name="image[]" multiple class="form-control">
                            @include('snippets.errors_first', ['param' => 'category_id'])

                        </div>
                      </div>
                    </div>


                    <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>Save</button>
                    <button type="button" class="btn btn-secondary"><i class="ft-x mr-1"></i>Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


<div class="container">
  <?php if(!empty($coupon_images)){
    foreach($coupon_images as $imag){

    ?>          
  <a href="{{$imag->product_image}}" target="_blank"><img src="{{$imag->product_image}}" class="img-rounded" alt="Cinque Terre" width="304" height="236"></a>
  <a href="{{ route($ADMIN_ROUTE_NAME.'.coupon.delete_img',['image_id'=>$imag->id])}}" onclick="return confirm('Are you Want to Delete!!')"><i class="fa fa-trash"></i></a>

  <?php }}?> 
</div>


      @include('admin.common.footer')



     