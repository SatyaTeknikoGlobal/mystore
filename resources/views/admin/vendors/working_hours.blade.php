@include('admin.common.header')
<?php
$BackUrl = CustomHelper::BackUrl();
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();
$routeName = CustomHelper::getAdminRouteName();
$storage = Storage::disk('public');
$path = 'vendors/';

$mon_from = isset($vendor->mon_from) ? $vendor->mon_from :'';
$mon_to = isset($vendor->mon_to) ? $vendor->mon_to :'';
$mon_status = isset($vendor->mon_status) ? $vendor->mon_status :'';

$tue_from = isset($vendor->tue_from) ? $vendor->tue_from :'';
$tue_to = isset($vendor->tue_to) ? $vendor->tue_to :'';
$tue_status = isset($vendor->tue_status) ? $vendor->tue_status :'';


$wed_from = isset($vendor->wed_from) ? $vendor->wed_from :'';
$wed_to = isset($vendor->wed_to) ? $vendor->wed_to :'';
$wed_status = isset($vendor->wed_status) ? $vendor->wed_status :'';


$thur_from = isset($vendor->thur_from) ? $vendor->thur_from :'';
$thur_to = isset($vendor->thur_to) ? $vendor->thur_to :'';
$thur_status = isset($vendor->thur_status) ? $vendor->thur_status :'';


$fri_from = isset($vendor->fri_from) ? $vendor->fri_from :'';
$fri_to = isset($vendor->fri_to) ? $vendor->fri_to :'';
$fri_status = isset($vendor->fri_status) ? $vendor->fri_status :'';

$sat_from = isset($vendor->sat_from) ? $vendor->sat_from :'';
$sat_to = isset($vendor->sat_to) ? $vendor->sat_to :'';
$sat_status = isset($vendor->sat_status) ? $vendor->sat_status :'';

$sun_from = isset($vendor->sun_from) ? $vendor->sun_from :'';
$sun_to = isset($vendor->sun_to) ? $vendor->sun_to :'';
$sun_status = isset($vendor->sun_status) ? $vendor->sun_status :'';


?>
<div class="main-panel">
  <!-- BEGIN : Main Content-->
  <div class="main-content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
     <div class="row">
      <div class="col-12">
        <div class="content-header">Working Hours - {{$vendor_name}}</div>

      </div>
    </div>
    @include('snippets.errors')
    @include('snippets.flash')

    <section id="action-form-layout">
      <div class="row match-height">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Working Hour Update</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="vendor_id" value="{{$vendor_id}}">
                  <div class="form-row">
                    <div class="col-md-3 col-12">
                      <div class="form-group position-relative">
                        <label for="form-action-3"><b>Day</b></label><br>
                        <label for="form-action">Mon Day</label>
                      </div>
                    </div>
                    <div class="col-md-3 col-12">
                      <div class="form-group position-relative">
                        <label for="form-action-3">Start Time</label>
                        <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                        name="mon_from"  id="" value="{{$mon_from}}">
                      </div>
                    </div>
                    <div class="col-md-3 col-12">
                      <div class="form-group position-relative">
                        <label for="form-action-3">End Time</label>
                        <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                        name="mon_to"  id="" value="{{$mon_to}}">
                      </div>
                    </div>


                    <div class="col-md-3 col-12">
                      <div class="form-group position-relative">
                        <label for="form-action-3">Status</label>
                        <select class="form-control" name="mon_status">
                         <option value="1" <?php if($mon_status == 1) echo 'selected'?>>Active</option>
                         <option value="2" <?php if($mon_status == 2) echo 'selected'?>>InActive</option>
                       </select>
                     </div>
                   </div>

                 </div>

                 <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Tues Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="tue_from"  id="" value="{{$tue_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="tue_to"  id="" value="{{$tue_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="tue_status">
                       <option value="1" <?php if($tue_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($tue_status == 2) echo 'selected'?>>InActive</option>
                     </select>
                   </div>
                 </div>

               </div>




               <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Wednes Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="wed_from"  id="" value="{{$wed_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="wed_to"  id="" value="{{$wed_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="wed_status">
                     
                       <option value="1" <?php if($wed_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($wed_status == 2) echo 'selected'?>>InActive</option>
                     </select>
                   </div>
                 </div>

               </div>






                <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Thurs Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="thur_from"  id="" value="{{$thur_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="thur_to"  id="" value="{{$thur_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="thur_status">
                      
                       <option value="1" <?php if($thur_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($thur_status == 2) echo 'selected'?>>InActive</option>
                     </select>
                   </div>
                 </div>

               </div>



                <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Fri Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="fri_from"  id="" value="{{$fri_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="fri_to"  id="" value="{{$fri_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="fri_status">
                      
                       <option value="1" <?php if($fri_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($fri_status == 2) echo 'selected'?>>InActive</option>
                     </select>
                   </div>
                 </div>

               </div>




                <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Satur Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="sat_from"  id="" value="{{$sat_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="sat_to"  id="" value="{{$sat_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="sat_status">
                      
                       <option value="1" <?php if($sat_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($sat_status == 2) echo 'selected'?>>InActive</option>
                     </select>
                   </div>
                 </div>

               </div>


               <div class="form-row">
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3"><b>&nbsp;</b></label><br>
                      <label for="form-action">Sun Day</label>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="sun_from"  id="" value="{{$sun_from}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <input type="time" id="form-action-3" class="form-control pickadate" placeholder=""
                      name="sun_to"  id="" value="{{$sun_to}}">
                    </div>
                  </div>

                  <div class="col-md-3 col-12">
                    <div class="form-group position-relative">
                      <label for="form-action-3">&nbsp;</label>
                      <select class="form-control" name="sun_status">
                     
                       <option value="1" <?php if($sun_status == 1) echo 'selected'?>>Active</option>
                       <option value="2" <?php if($sun_status == 2) echo 'selected'?>>InActive</option>
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



</div>
</div>
</div>
@include('admin.common.footer')
