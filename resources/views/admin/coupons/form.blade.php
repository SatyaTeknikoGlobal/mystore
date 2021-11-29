
@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();


$coup_id = (isset($coupons->id))?$coupons->id:'';
$name = (isset($coupons->name))?$coupons->name:'';
$status = (isset($coupons->status))?$coupons->status:'';
$vender_id = (isset($coupons->vender_id))?$coupons->vender_id:'';
$category_id = (isset($coupons->category_id))?$coupons->category_id:'';
$nomber_of_use = (isset($coupons->nomber_of_use))?$coupons->nomber_of_use:'';
$c_mrp = (isset($coupons->c_mrp))?$coupons->c_mrp:'';
$c_price = (isset($coupons->c_price))?$coupons->c_price:'';
$expary_date = (isset($coupons->expary_date))?$coupons->expary_date:'';
$expary_time = (isset($coupons->expary_time))?$coupons->expary_time:'';
$description = (isset($coupons->description))?$coupons->description:'';
$details = (isset($coupons->details))?$coupons->details:'';

$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'coupons/';

$categories = DB::table('coupan_catagory')->where('vender_id',$vender_id)->get();
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
                <h4 class="card-title">{{$page_heading}}</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$coup_id}}">
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Vendor Name</label>
                         <select class="select2 form-control " name="vender_id" id="vender_id">
                           <option value="">Select Vendor</option>
                           <?php if(!empty($vendors)){
                            foreach($vendors as $ven){
                            ?>
                            <option value="{{$ven->id}}" <?php if($vender_id == $ven->id || $ven->id == old('vender_id')) echo 'selected'?>>{{$ven->business_name}}</option>
                          <?php }}?>
                         </select>
                            @include('snippets.errors_first', ['param' => 'vender_id'])

                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Category Name</label>
                         <select class="select2 form-control" name="category_id" id="category_id">
                           <option>Select Category</option>
                              <?php if(!empty($categories)){
                            foreach($categories as $cat){
                            ?>
                            <option value="{{$cat->id}}" <?php if($category_id == $cat->id) echo 'selected'?>>{{$cat->name}}</option>
                          <?php }}?>
                         </select>
                            @include('snippets.errors_first', ['param' => 'category_id'])

                        </div>
                      </div>
                    </div>
                      
                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Coupon Name</label>
                            <input type="text" name="name" value="{{old('name', $name)}}" class="form-control" placeholder="Coupon Name">

                        </div>
                            @include('snippets.errors_first', ['param' => 'name'])

                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">No of Uses</label>
                            <input type="text" name="nomber_of_use" value="{{old('nomber_of_use',$nomber_of_use)}}" class="form-control" placeholder="No of Uses">
                        </div>
                            @include('snippets.errors_first', ['param' => 'nomber_of_use'])

                      </div>
                    </div>


                     <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">MRP</label>
                            <input type="text" name="c_mrp" value="{{old('c_mrp',$c_mrp)}}" class="form-control" placeholder="Mrp">
                        </div>
                            @include('snippets.errors_first', ['param' => 'c_mrp'])

                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Selling Price</label>
                            <input type="text" name="c_price" value="{{old('c_price',$c_price)}}" class="form-control" placeholder="Selling Price">
                        </div>
                            @include('snippets.errors_first', ['param' => 'c_price'])

                      </div>
                    </div>

                    <div class="form-row">
                      <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Expire Date</label>
                            <input type="date" name="expary_date" value="{{old('expary_date',$expary_date)}}" class="form-control">
                        </div>
                            @include('snippets.errors_first', ['param' => 'expary_date'])

                      </div>

                       <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Expire Time</label>
                            <input type="time" name="expary_time" value="{{old('expary_time',$expary_time)}}" class="form-control">
                        </div>
                            @include('snippets.errors_first', ['param' => 'expary_time'])

                      </div>
                     



                    </div>

                     <div class="form-row">

                       <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-3">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Description">{{old('description',$description)}}</textarea>
                        </div>
                            @include('snippets.errors_first', ['param' => 'description'])

                      </div>

                       <div class="col-md-6 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Status</label>
                          <select id="form-action-6" name="status" class="form-control">
                        <option value="1" <?php if($status == '1' || old('status') ==1){echo "selected";}?>>Active</option>
                        <option value="0"<?php if($status == '0' || old('status') == 0){echo "selected";}?>>InActive</option>
                      </select>
                            @include('snippets.errors_first', ['param' => 'status'])
                          

                        </div>
                      </div>
                     
                    </div>



                     <div class="form-row">
                       <div class="col-md-12 col-12">
                        <div class="form-group position-relative">
                          <label for="form-action-4">Details</label>
                          <textarea name="details" class="form-control" placeholder="Enter Details">{{old('details',$details)}}</textarea>
                            @include('snippets.errors_first', ['param' => 'details'])
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
  $( "#vender_id" ).change(function() {
    var vender_id = $(this).val();
      if(vender_id == ''){
        return false;
      }
      var _token = '{{ csrf_token() }}';

          $.ajax({
            url: "{{ route($routeName.'.coupon.get_category') }}",
            type: "POST",
            data: {vender_id:vender_id},
            dataType:"HTML",
            headers:{'X-CSRF-TOKEN': _token},
            cache: false,
           
           success: function(resp){
              $('#category_id').html(resp);
          }
        });
});
</script>



     