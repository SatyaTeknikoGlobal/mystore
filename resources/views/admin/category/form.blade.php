
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$cat_id = (isset($categories->id))?$categories->id:'';
$image = (isset($categories->image))?$categories->image:'';
$name = (isset($categories->name))?$categories->name:'';
$status = (isset($categories->status))?$categories->status:'';
$vender_id = (isset($categories->vender_id))?$categories->vender_id:'';

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
          <div class="content-header"></div>
          <a href="{{ route($ADMIN_ROUTE_NAME.'.category.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
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
                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$cat_id}}">
                    <div class="form-row">

                       <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Vendor Name</label>
                         <select name="vender_id" class="select2 form-control">
                          
                            <?php if(!empty($vendors)){
                              foreach($vendors as $ven){
                              ?>
                              <option value="{{$ven->id}}" <?php if($ven->id == $vender_id || old('vender_id') == $ven->id) echo 'selected'?>>{{$ven->business_name}}</option>
                            <?php }}?>
                         </select>
                        </div>
                      </div>



                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Category Name</label>
                          <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Category Name"
                          name="name" value="{{old('name',$name)}}">
                        </div>
                      </div>
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="form-action-6">Status</label>
                      <select id="form-action-6" name="status" class="form-control">
                        <option value="1" <?php if($status == '1' ||  old('status') == '1'){echo "selected";}?>>Active</option>
                        <option value="0"<?php if($status == '0' ||  old('status') == '0'){echo "selected";}?>>InActive</option>
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

        conf = confirm("Are you sure to Delete this Image?");

        if(conf){

          var _token = '{{ csrf_token() }}';

          $.ajax({
            url: "{{ route($routeName.'.businesscategory.ajax_delete_image') }}",
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