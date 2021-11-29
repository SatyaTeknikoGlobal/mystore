@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';
$imgUrl = asset('public/assets/front/images/noimage.png');
$coupon_image = DB::table('vender_product_images')->where('coupan_id',$coupon->id)->first();
if(!empty($coupon_image->product_image)){
	$imgUrl = $coupon_image->product_image;
}
?>

<div class="screen-wrap">


	<header class="app-header bg-primary">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<h5 class="title-header">Coupon Details</h5>
		<div class="header-right">  </div>
	</header>
	<main class="app-content">

		<section class="gallery-wrap">
			<a href="{{$imgUrl}}" data-fancybox="gallery" class="img-big-wrap"><img src="{{$imgUrl}}"></a>
			<div class="thumbs-wrap scroll-horizontal">
				<?php 

				$coupon_image = DB::table('vender_product_images')->where('coupan_id',$coupon->id)->get();
				if(!empty($coupon_image)){
					foreach($coupon_image as $img){
						$imgUrl1 = asset('public/assets/front/images/noimage.png');
						if(!empty($img->product_image)){
							$imgUrl1 = $img->product_image;
						}

						?>
						<a href="{{$imgUrl1}}" data-fancybox="gallery" class="item-thumb"> <img src="{{$imgUrl1}}"></a>
					<?php }}?>
				</div>
			</section>

			<section class="padding-around">
				<h6 class="title-detail">{{$coupon->name}}</h6>	
				<div class="price-wrap mb-2">
					<span class="h6 price text-warning">MRP : ₹<del>{{$coupon->c_mrp}}</del></span> <br>
					<span class="h6 price text-warning">Selling Price : ₹{{$coupon->c_price}}</span> 
				</div> 
					<h6 class="title-sm">Expire Date: {{$coupon->expary_date}}</h6>
					<h6 class="title-sm">Expire Time: {{$coupon->expary_time}}</h6>
				<article class="info-detail-wrap">
					<p>
						<h5>Description :</h5>
						{{$coupon->description}}
					</p>
					<h6 class="title-sm">Coupon Inclusion :</h6>

					{{$coupon->details}}

					<!-- <?php if(!empty($products)){?>
						<ul class="list-bullet">
							
							<?php foreach($products as $pro){
								?>
								<li>Name : {{$pro->name}}<br>
									Price : {{$pro->price}}<br>
									Unit : {{$pro->unite}}<br>
								</li>

							<?php }?>
							
						</ul>
					<?php }else{?>
						<p>NO Products Found</p>
					<?php }?> -->

				</article>


<hr>





				<div id="add_cart{{$coupon->id}}">
					<div class="d-flex" >
						<div class="flex-grow-1 mr-2"><a class="btn btn-primary btn-block" onclick="add_to_cart('{{$slug}}','{{$coupon->id}}')" <?php if(empty($products) || count($products) ==0) {echo 'disabled';}?>>Add to cart</a></div>

					</div>
				</div>

				<div id="go_cart{{$coupon->id}}" style="display: none;">
					<div class="d-flex" >
						<div class="flex-grow-1 mr-2"><a class="btn btn-primary btn-block" onclick="add_to_cart('{{$slug}}','{{$coupon->id}}')" <?php if(empty($products) || count($products) ==0) {echo 'disabled';}?>>Add to cart</a></div>

					</div>
				</div>
			</section>




		</main>


	</div>









	@include('front.common.footer')
