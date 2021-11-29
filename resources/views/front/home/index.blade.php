@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';
	
?>

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
<style type="text/css">
	.rcorners1 {
  border-radius: 25px;
  background: #73AD21;
  padding: 20px; 
  width: 100%;
  height: 150px;  
}

.activenew{
	color: red;
	background-color: #313aeb;
}

body{
	background: #313aeb !important;
}
</style>
<!-- =============== screen-wrap =============== -->

<div class="screen-wrap">

<header class="app-header bg-primary">
    <!-- <button class="btn-header" type="button" data-trigger="#sidebar_left"><i class="fa fa-bars"></i></button> -->
	<div style="text-align: center;">
	<img style="border-radius:100%;height: 38px;width:38px" class="img-fluid" src="https://www.booksplanet.in/admin/uploads/products/product1612958965.jpg" alt="">
	<h5 class="title-header ml-2">{{$vendor->business_name}} Shop </h5>
	</div>
    <div class="header-right" style="text-align: right;color:#fff;margin-top: 27px;">
	<div><i class="fas fa-clock"></i></div>
		<h6 style="font-size: 12px;">{{$opening_time}}</h6>
		
</div>
</header>

<main class="app-content">

<section class="mb-2 scroll-horizontal" >
<!--     <a href="#" class="item-slider card-banner">
        <div class="card-body bg-warning" style="height:220px; background-image: url('{{asset('public/assets/front/images/banners/home1.jpg')}}')"> </div>
        <div class="text-bottom"><h5 class="title">Super discount</h5></div>
    </a>
    <a href="#" class="item-slider card-banner">
        <div class="card-body bg-warning" style="height:220px; background-image: url('{{asset('public/assets/front/images/banners/banner2.jpg')}}')"> </div>
        <div class="text-bottom"><h5 class="title">Get offers</h5></div>
    </a>
    <a href="#" class="item-slider card-banner">
        <div class="card-body bg-warning" style="height:220px; background-image: url('{{asset('public/assets/front/images/banners/banner3.jpg')}}')"> </div>
        <div class="text-bottom"><h5 class="title">Best deals now</h5></div>
    </a> -->
    <!-- <p class="rcorners1">Rounded corners!</p> -->
</section>



<!-- <h5 class="title-section">Categories</h5> -->
<?php

//echo $category_id;
?>
<section class="padding-around">
    
<ul class="row">
	<li class="">
		<a href="{{url($slug.'/all')}}" class="btn-card-icontop btn <?php if($category_id == 'all') echo 'activenew'?>">
			<small class="text text-center ">All</small>
		</a>
	</li>


	<?php if(!empty($coupon_Categories) && count($coupon_Categories) > 0){
		foreach($coupon_Categories as $cat){
			$imgUrl = asset('public/assets/front/images/noimage.png');
			if(!empty($cat->img)){
				$imgUrl = $cat->img;
			}

		?>
	<li>
		<a href="{{url($slug.'/'.$cat->id)}}" class="btn-card-icontop btn <?php if($category_id == $cat->id) echo 'activenew'?>">
			<small class="text text-center">{{$cat->name}}</small>
		</a>
	</li>
<?php }}?>
</ul>
</section>
<hr class="divider mb-3">

<section class="scroll-horizontal padding-x item-div">
	<?php if(!empty($all_coupons) && count($all_coupons) > 0){
		foreach($all_coupons as $all_coup){
			$imgUrl1 = asset('public/assets/front/images/noimage.png');
			$coupon_image = DB::table('vender_product_images')->where('coupan_id',$all_coup->id)->first();
			if(!empty($coupon_image->product_image)){
				$imgUrl1 = $coupon_image->product_image;
			}

			$type = isset($all_coup->type) ? $all_coup->type :'Single';

			?>
		<div class="item">
		<div class="product-sm">
			<div class="img-wrap"> <img src="{{$imgUrl1}}"> <span class="tag--">{{$type}}</span></div>
			<div class="text-wrap">
				<p class="title text-truncate mb-2">{{$all_coup->name}}</p>
				<div class="price">
					<span>₹{{$all_coup->c_price}}</span>
					</div> 
					<div class="d-flex">
					<button class="btn add_btn"  data-toggle="modal" data-target="#detailmodal{{$all_coup->id}}">Details</button>&nbsp;&nbsp;
					<button class="btn add_btn"  data-toggle="modal" data-target="#inclusionmodal{{$all_coup->id}}">Inclusion</button>&nbsp;&nbsp;



					<a class="btn add_btn" onclick="add_to_cart('{{$slug}}','{{$all_coup->id}}')" style=" color: #03a9f4 !important;position: relative;">Add</a>
					</div>
			</div>
			<div style="position: relative;display: none;">
			<a class="btn add_btn" onclick="add_to_cart('{{$slug}}','{{$all_coup->id}}')" style=" color: #03a9f4 !important;position: relative;">Add</a>
			</div>
		</div>
	</div>
<!-- Detail Modal -->

<div class="modal fade" id="detailmodal{{$all_coup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coupon Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    	<p>{{$all_coup->details}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>









<!-- Inclusion Modal -->


<div class="modal fade" id="inclusionmodal{{$all_coup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coupon Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           	<p>{{$all_coup->description}}</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






























<?php }}else{?>
	<p>No Coupon Found</p>
<?php  }?>
	
</section>







</main>
@include('front.common.footer')



<script>
 if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
        console.log("Yes, it did.");
     }).catch(function(err) {
        console.log("No it didn't. This happened:", err)
    });
 }
</script>