
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$pro_id = (isset($products->id))?$products->id:'';
$image = (isset($products->image))?$products->image:'';
$product_name = (isset($products->product_name))?$products->product_name:'';
$status = (isset($products->status))?$products->status:'';
$cat_id = (isset($products->cat_id))?$products->cat_id:'';
$description = (isset($products->description))?$products->description:'';
$mrp = (isset($products->mrp))?$products->mrp:'';
$selling_price = (isset($products->selling_price))?$products->selling_price:'';
$collection_id = (isset($products->collection_id))?$products->collection_id:'';
$varient_type = (isset($products->varient_type))?$products->varient_type:'';
$unit = (isset($products->unit)) ? $products->unit:'';

$routeName = CustomHelper::getAdminRouteName();
$unitArray = config('custom.unit');

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
          <div class="content-header"></div>
          <a href="{{ route($ADMIN_ROUTE_NAME.'.readymadeproducts.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
        </div>
      </div>
      @include('snippets.errors')
      @include('snippets.flash')
      <section id="action-form-layout">
        <div class="row match-height">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">{{$page_heading}}</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="id" value="{{$pro_id}}">
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Name</label>
                          <input type="text" required id="form-action-3" class="form-control pickadate" placeholder="Name"
                          name="product_name" value="{{$product_name}}">
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Image</label>
                          <input type="file" name="image" id="image">
                          <?php
                          if(!empty($image)){
                          if($storage->exists($path.$image)){
                            ?>
                             <div class=" image_box" style="display: inline-block">
                            <a href="{{ url('public/storage/'.$path.$image) }}" target="_blank">
                              <img src="{{ url('public/storage/'.$path.'thumb/'.$image) }}" style="width:70px;">
                            </a>
                            <a href="javascript:void(0)" data-id="{{ $cat_id }}" class="del_banner">Delete</a>
                          </div>
                          <?php }}?>

                        </div>
                        </div>
                    </div>
                    

                      <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Description</label>
                          <textarea name="description" required class="form-control">{{$description}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Unit</label>
                          <select class="form-control" name="unit" required>
                            <option value="" disabled selected>Select Unit</option>
                            <?php foreach($unitArray as $key=>$value){?>
                              <option value="{{$key}}" <?php if($unit == $key) echo "selected"?>>{{$value}}</option>
                            <?php }?>
                          </select>

                        </div>
                        </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">MRP</label>
                         <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Mrp"
                          name="mrp" value="{{$mrp}}" required data-validation-required-message="MRP field is required">
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Selling Price</label>
                          <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Selling Price"
                          name="selling_price" value="{{$selling_price}}" required>
                        </div>
                        </div>
                    </div>




                    <div class="form-group">
                      <label for="form-action-6">Status</label>
                      <select id="form-action-6" name="status" class="form-control">
                        <option value="active" <?php if($status == 'active'){echo "selected";}?>>Active</option>
                        <option value="inactive"<?php if($status == 'inactive'){echo "selected";}?>>InActive</option>
                        </select>
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

      @include('admin.common.footer')
      <script type="text/javascript">
       $(".del_banner").click(function(){

        var current_sel = $(this);

        var image_id = $(this).attr('data-id');

        conf = confirm("Are you sure to Delete this Banner Image?");

        if(conf){

          var _token = '{{ csrf_token() }}';

          $.ajax({
            url: "{{ route($routeName.'.readymadeproducts.ajax_delete_image') }}",
            type: "POST",
            data: {id:image_id},
            dataType:"JSON",
            headers:{'X-CSRF-TOKEN': _token},
            cache: false,
            beforeSend:function(){
             $(".ajax_msg").html("");
           },
           success: function(resp){
            if(resp.success){
              $(".ajax_msg").html(resp.msg);
              current_sel.parent('.image_box').remove();
            }
            else{
              $(".ajax_msg").html(resp.msg);
            }

          }
        });
        }

      });
    </script>