@include('front.common.header')

<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';
	
?>
<div class="screen-wrap">

<header class="app-header bg-primary">
	<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
	<!-- <div class="header-right"> <button class="btn-header"><i class="fa fa-sort-amount-down"></i></button>  </div> -->
</header> <!-- section-header.// --> 

<main class="app-content">

<div class="bg-primary padding-x padding-bottom">
	<h3 class="title-page text-white">{{$coupon_Categories->name}}</h3>
</div>
<hr class="divider mb-3">

<section class="scroll-horizontal padding-x item-div">


	<?php
	 if(!empty($coupons) && count($coupons) > 0){
		foreach($coupons as $coup){
			$imgUrl = asset('public/assets/front/images/noimage.png');
			$coupon_image = DB::table('vender_product_images')->where('coupan_id',$coup->id)->first();
			if(!empty($coupon_image->product_image)){
				$imgUrl = $coupon_image->product_image;
			}
		?>



	<div class="item">
		<a href="{{url($slug.'/products/'.$coup->id)}}" class="product-sm">
			<div class="img-wrap"> <img src="{{$imgUrl}}"> <span class="tag--">Multi</span></div>
			<div class="text-wrap">
				<p class="title text-truncate mb-2">{{$coup->name}}</p>
				<div class="price">
					
				<!-- <small>MRP:</small> <del>₹{{$coup->c_mrp}}</del> -->
					<span> ₹{{$coup->c_price}}</span>

					
					</div> 
					<div class="d-flex">
					<span class="inclu mr-2">Inclusion</span>
					<span class="inclu">Detail</span>
					</div>
			</div>
			<div style="position: relative;">
			<a class="btn add_btn" onclick="add_to_cart('{{$slug}}','{{$coup->id}}')" style=" color: #03a9f4 !important;position: relative;">Add</a>
			</div>
		</a>
	</div>



















<?php }}else{?>
	<div class="d-md-flex align-items-md-center height-100vh--md">
						<div class="container text-center space-2 space-3--lg">
							<div class="w-md-80 w-lg-60 text-center mx-md-auto">
								<div class="mb-5">
									<span class="u-icon u-icon--secondary u-icon--lg rounded-circle mb-4">
										<!-- <span class="fa fa-shopping-bag u-icon__inner"></span> -->
										<img src="{{asset('public/assets/img/noproduct.png')}}" width="165px" height="143px">
									</span>
									<h1 class="h2">Product Coupons currently empty</h1>
									<p></p>
								</div>
								<a class="btn btn-primary btn-wide" href="{{url('/'.$slug)}}">Start Shopping</a>
							</div>
						</div>
					</div>
<?php }?>



</section> <!-- section body .// -->



</main>
@include('front.common.footer')
