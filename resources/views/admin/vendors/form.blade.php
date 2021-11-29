
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$vendor_id = (isset($vendors->id))?$vendors->id:'';
$image = (isset($vendors->image))?$vendors->image:'';
$business_name = (isset($vendors->business_name))?$vendors->business_name:'';
$status = (isset($vendors->status))?$vendors->status:'';
$slug = (isset($vendors->slug))?$vendors->slug:'';
$phone = (isset($vendors->phone))?$vendors->phone:'';
$address = (isset($vendors->address))?$vendors->address:'';
$alter_contact = (isset($vendors->alter_contact))?$vendors->alter_contact:'';
$owner_name = (isset($vendors->owner_name))?$vendors->owner_name:'';
$gst_number = (isset($vendors->gst_number))?$vendors->gst_number:'';
$email = (isset($vendors->email))?$vendors->email:'';
$fb_url = (isset($vendors->fb_url))?$vendors->fb_url:'';
$insta_url = (isset($vendors->insta_url))?$vendors->insta_url:'';
$password = (isset($vendors->password))?$vendors->password:'';

$category_id = (isset($vendors->category_id))?$vendors->category_id:'';
$category_id = explode(" ,", $category_id);
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
          <div class="content-header"></div>
          <a href="{{ route($ADMIN_ROUTE_NAME.'.vendors.index')}}" class="btn btn-sm btn-success pull-right">Back</a>
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
                    <input type="hidden" name="id" value="{{$vendor_id}}">
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Name</label>
                          <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Enter Business Name"
                          name="business_name" onkeyup="get_slug()" id="business_name" value="{{$business_name}}">
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
                                <a href="javascript:void(0)" data-id="{{ $vendor_id }}" class="del_banner">Delete</a>
                              </div>
                            <?php }}?>

                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-3">Slug</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Name"
                            name="slug" id="slug" value="{{$slug}}" <?php if($vendor_id !='')echo 'readonly';?>>
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-4">Phone</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Name"
                            name="phone" value="{{$phone}}">
                          </div>
                        </div>
                      </div>
                      

                      <div class="form-row">
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-3">Choose Business Category</label>
                            <select class="select2 form-control" placeholder="Choose Business Category" name="category_id[]" multiple>
                              <?php if(!empty($business_category) && count($business_category) > 0){
                                foreach($business_category as $business_cat){
                                ?>
                                <option value="{{$business_cat->id}}" <?php if(in_array($business_cat->id, $category_id)) echo "selected"?>>{{$business_cat->name}}</option>
                              <?php }}?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-6">Status</label>
                            <select id="form-action-6" name="status" class="form-control">
                              <option value="active" <?php if($status == 'active'){echo "selected";}?>>Active</option>
                              <option value="inactive"<?php if($status == 'inactive'){echo "selected";}?>>InActive</option>
                            </select>
                          </div>
                        </div>
                      </div>



                      <div class="form-row">
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-3">Email</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Email"
                            name="email" id="email" value="{{$email}}">
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-4">Alternate Contact Number</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Alternate Contact Number"
                            name="alter_contact" value="{{$alter_contact}}">
                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-3">Address</label>
                            <textarea class="form-control" name="address" placeholder="Enter Address">{{$address}}</textarea>
                          </div>
                        </div>
                          <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-3">Facebook URL</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Facebook Url"
                            name="fb_url" id="fb_url" value="{{$fb_url}}">
                          </div>
                        </div>
                      </div>

                      <div class="form-row">
                          
                        <div class="col-md-6 col-12">
                          <div class="form-group position-relative">
                            <label for="form-action-4">Instagram Url</label>
                            <input type="text" id="form-action-3" class="form-control pickadate" placeholder="Instagram Url"
                            name="insta_url" value="{{$insta_url}}">
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
      <script type="text/javascript">
      function get_slug(){
          var business_name = $("input[name=business_name]").val();
          var slug = $("input[name=slug]").val();
          var id = '<?php echo $vendor_id?>';
          if(id ==''){
          var _token = '{{ csrf_token() }}';
          $.ajax({
              url: "{{ route($routeName.'.vendors.get_slug') }}",
              type: "POST",
              data: {business_name:business_name,id:id},
              dataType:"JSON",
              headers:{'X-CSRF-TOKEN': _token},
              cache: false,
             success: function(resp){
              if(resp.success){
                $("input[name=slug]").val(resp.slug);
              } 
            }
          });
        }

      }
      </script>