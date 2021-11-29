
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$coll_id = (isset($collections->id))?$collections->id:'';
$image = (isset($collections->image))?$collections->image:'';
$name = (isset($collections->name))?$collections->name:'';
$status = (isset($collections->status))?$collections->status:'';
$vendor_id = (isset($collections->vendor_id))?$collections->vendor_id:'';

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
          <div class="content-header"></div>
          <a href="{{ route($ADMIN_ROUTE_NAME.'.collections.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
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
                    <input type="hidden" name="id" value="{{$coll_id}}">
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Collection Name</label>
                          <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Name"
                          name="name" value="{{$name}}">
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
                            <a href="javascript:void(0)" data-id="{{ $coll_id }}" class="del_banner">Delete</a>
                          </div>
                          <?php }}?>

                        </div>
                      </div>
                    </div>
                      
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Vendor Name</label>
                          <select name="vendor_id" class="form-control">
                            <option value="" selected disabled>Select Vendors</option>
                            <?php if(!empty($vendors) && count($vendors) > 0){
                              foreach($vendors as $ven){
                              ?>
                              <option value="{{$ven->id}}" <?php if($ven->id == $vendor_id)echo "selected"?>>{{$ven->business_name}}</option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Status</label>
                          <select id="form-action-6" name="status" class="form-control">
                        <option value="active" <?php if($status == 'active'){echo "selected";}?>>Active</option>
                        <option value="inactive"<?php if($status == 'inactive'){echo "selected";}?>>InActive</option>
                      </select>
                          

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

      @include('admin.common.footer')
      <script type="text/javascript">
       $(".del_banner").click(function(){

        var current_sel = $(this);

        var image_id = $(this).attr('data-id');

        conf = confirm("Are you sure to Delete this Image?");

        if(conf){

          var _token = '{{ csrf_token() }}';

          $.ajax({
            url: "{{ route($routeName.'.collections.ajax_delete_image') }}",
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