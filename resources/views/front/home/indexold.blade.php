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
</style>
<!-- =============== screen-wrap =============== -->

<div class="screen-wrap">

<header class="app-header bg-primary">
    <button class="btn-header" type="button" data-trigger="#sidebar_left"><i class="fa fa-bars"></i></button>
    <h5 class="title-header ml-2">{{$vendor->business_name}} Shop </h5>
    <div class="header-right"> </div>
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
    <p class="rcorners1">Rounded corners!</p>
</section>



<h5 class="title-section">Categories</h5>

<section class="padding-around">
    
<ul class="row">
	<?php if(!empty($coupon_Categories) && count($coupon_Categories) > 0){
		foreach($coupon_Categories as $cat){
			$imgUrl = asset('public/assets/front/images/noimage.png');
			if(!empty($cat->img)){
				$imgUrl = $cat->img;
			}
		?>
	<li class="col-4">
		<a href="{{url($slug.'/coupons/'.$cat->id)}}" class="btn-card-icontop btn">
			<span class="icon"> <img src="{{$imgUrl}}" alt="">  </span>
			<small class="text text-center">{{$cat->name}}</small>
		</a>
	</li>
<?php }}?>
	<?php if(!empty($coupon_Categories) && count($coupon_Categories) > 0){?>
 	<li class="col-4">
		<a href="{{url($slug.'/all-category')}}" class="btn-card-icontop btn">
			<span class="icon"> <i class="fa fa-ellipsis-h"></i> </span>
			<small class="text text-center"> View All </small>
		</a>
	</li>
	<?php }else{?>
			<p>No Category Found</p>
	<?php }?>
</ul>
</section>

<hr class="divider mb-3">

<h5 class="title-section">All Coupons</h5>

<section class="scroll-horizontal padding-x">
	<?php if(!empty($all_coupons) && count($all_coupons) > 0){
		foreach($all_coupons as $all_coup){
			$imgUrl1 = asset('public/assets/front/images/noimage.png');
			$coupon_image = DB::table('vender_product_images')->where('coupan_id',$all_coup->id)->first();
			if(!empty($coupon_image->product_image)){
				$imgUrl1 = $coupon_image->product_image;
			}


			?>
	<div class="item">
		<a href="{{url($slug.'/products/'.$all_coup->id)}}" class="product-sm">
			<div class="img-wrap"> <img src="{{$imgUrl1}}"> </div>
			<div class="text-wrap">
				<p class="title text-truncate">{{$all_coup->name}}</p>
				<div class="price"><small>MRP:</small> <del>₹{{$all_coup->c_mrp}}</del><br> <small>Selling Price</small> ₹{{$all_coup->c_price}}</div> <!-- price-wrap.// -->
			</div>
		</a>
	</div>

<?php }}else{?>
	<p>No Coupon Found</p>
<?php  }?>
	
</section>


<hr class="divider my-3">


<h5 class="title-section">Top Selling Coupons</h5>


<section class="scroll-horizontal  padding-x">


	<?php if(!empty($top_selling) && count($top_selling) > 0){
		foreach($top_selling as $all_coup){
			$imgUrl2 = asset('public/assets/front/images/noimage.png');
			$coupon_image = DB::table('vender_product_images')->where('coupan_id',$all_coup->id)->first();
			if(!empty($coupon_image->product_image)){
				$imgUrl2 = $coupon_image->product_image;
			}


			?>
	<div class="item">
		<a href="{{url($slug.'/products/'.$all_coup->id)}}" class="product-sm">
			<div class="img-wrap"> <img src="{{$imgUrl2}}"> </div>
			<div class="text-wrap">
				<p class="title text-truncate">{{$all_coup->name}}</p>
				<div class="price"><small>MRP:</small> <del>₹{{$all_coup->c_mrp}}</del><br> <small>Selling Price</small> ₹{{$all_coup->c_price}}</div> <!-- price-wrap.// -->
				<!-- price-wrap.// -->
			</div>
		</a>
	</div>

<?php }}else{?>
	<p>NO Coupons Found</p>
<?php }?>


	
	
</section> 

</main>
@include('front.common.footer')