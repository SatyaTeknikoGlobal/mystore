@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';
	
?>
<style type="text/css">
	.rcorners1 {
  border-radius: 25px;
  background: #73AD21;
  padding: 20px; 
  width: 100%;
  height: 150px;  
}
body{
	background: #313aeb !important;
}
</style>
<!-- =============== screen-wrap =============== -->
<?php
$imgUrl = asset('public/assets/front/images/noimage.png');
if(!empty($vendor->image)){
	$imgUrl = $vendor->image;
}
$current_day = date('D');
if($current_day == 'Mon'){
	$opening_time =date("g:iA", strtotime($vendor->mon_from )).'-'.date("g:iA", strtotime($vendor->mon_to ));
}
if($current_day == 'Tue'){
	$opening_time = date("g:iA", strtotime($vendor->tue_from )).'-'.date("g:iA", strtotime($vendor->tue_to ));
}
if($current_day == 'Wed'){
	$opening_time = date("g:iA", strtotime($vendor->wed_from )).'-'.date("g:iA", strtotime($vendor->wed_to ));
}
if($current_day == 'Thu'){
	$opening_time = date("g:iA", strtotime($vendor->thur_from )).'-'.date("g:iA", strtotime($vendor->thur_to ));
}
if($current_day == 'Fri'){
	$opening_time = date("g:iA", strtotime($vendor->fri_from )).'-'.date("g:iA", strtotime($vendor->fri_to ));
}
if($current_day == 'Sat'){
	$opening_time = date("g:iA", strtotime($vendor->sat_from )).'-'.date("g:iA", strtotime($vendor->sat_to ));
}
if($current_day == 'Sun'){
	$opening_time = date("g:iA", strtotime($vendor->sun_from )).'-'.date("g:iA", strtotime($vendor->sun_to ));
}



?>
<div class="screen-wrap">

<header class="app-header bg-primary">
   
</header>

<main class="app-content">

<section class="mb-2 scroll-horizontal" >

</section>



<!-- <h5 class="title-section">Categories</h5> -->

<section class="padding-around">

</section>

<section class="app-header" style="background-color: #fff">


   	<ul class="row" style="display: flex;">
	<li style="border: 2px solid #03a9f4; border-radius: 5px; margin-left: 9px">
	<img style="border-radius:100%;height: 70px;width:80px" class="img-fluid" src="{{$imgUrl}}" alt="">
	

</li>
<li><h5 class="title-header ml-2" style="text-transform: capitalize; font-size: 16px"><b>{{$vendor->business_name}} Shop </b></h5>
	<p style="font-size: 15px; text-align: center; color: #03a9f4;"><i class="fa fa-clock"></i><b>{{$opening_time}}</b></p>

</li>



</section>











<section class="padding-around">
    
<ul class="row">
	<li >
		<a href="#" class="btn-card-icontop btn" style="font-size: 15px;">
			<small class="text text-center" ><i class="fa fa-phone-square" style="font-size: 15px;">{{$vendor->phone}}</i></small>
		</a>
	</li>
	<li >
		<a href="#" class="btn-card-icontop btn" style="font-size: 15px;">
			<small class="text text-center" ><i class="fa fa-envelope" style="font-size: 15px;">{{$vendor->email}}</i></small>
		</a>
	</li>


</ul>
</section>

</div>
</main>
@include('front.common.footer')