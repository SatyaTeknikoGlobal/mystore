@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';


?>

<div class="screen-wrap">


	<header class="app-header bg-primary">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<h5 class="title-header"> Your Cart ({{count($carts)}}) </h5>
		<div class="header-right">  </div>
	</header> <!-- section-header.// -->


	<main class="app-content">
		<section class="section-products padding-around">


			<?php if(!empty($carts) && count($carts) > 0){
				$total = 0;
				foreach($carts as $cart){
					$user_id =  isset(Auth::guard('appusers')->user()->id) ? Auth::guard('appusers')->user()->id :'';
					$imgUrl = asset('public/assets/front/images/noimage.png');

					$coupon = DB::table('coupan')->where('id',$cart->coupon_id)->where('vender_id',$vendor->id)->first();
					if(!empty($coupon)){
						$coupon_img = DB::table('vender_product_images')->where('coupan_id',$coupon->id)->first();
						if(!empty($coupon_img)){
							$imgUrl = $coupon_img->product_image;
						}

						$total = $total + ($coupon->c_price * $cart->qty);

					}
					$qty = isset($cart->qty) ? $cart->qty :1;

					$max_qty = $coupon->nomber_of_use - $coupon->used;
					//echo $max_qty;
					?>
					<figure class="itemside item-cart">
						<div class="aside"><img src="{{$imgUrl}}" class="rounded img-md"></div>
						<figcaption class="info align-self-center">
							<a href="#" class="title">{{$coupon->name}}</a>
							<span class="price">₹{{$coupon->c_price}}</span> <small class="text-muted"> / per Coupon</small>
							<div style="display: flex;">
								<div class="form-inline mt-2">
									<a href="#"  onclick="delete_cart_item('{{$cart->id}}','{{$coupon->id}}','{{$vendor->id}}')" class="mr-2 btn-sm btn btn-light"> <i class="fa fa-trash"></i>  Delete </a>
								</div>
								<div class="form-inline mt-2">

									
									<!-- Counter -->
									<div class="quantity buttons_added">
										<input type="button"  value="-" class="minus" onclick="qty_minus('{{$cart->id}}','{{$coupon->id}}','{{$vendor->id}}')"><input type="text" step="1" readonly min="1" max="{{$max_qty}}" name="qty" value="{{$qty}}" id="qty{{$cart->id}}" title="Qty" style="width:40px" class="input-text qty text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" size="4" pattern="" inputmode=""><input type="button" value="+" onclick="qty_plus('{{$cart->id}}','{{$coupon->id}}','{{$vendor->id}}')" class="plus">

										<!-- Counter -->

									</div>
								</div>
							</figcaption>
						</figure>

					<?php }}?>

					<?php if(!empty($carts) && count($carts) > 0){
						
						?>
					</section> <!-- section-products  .// -->

					<hr class="divider">
					<section class="padding-around">

						<p class="d-block mb-1 icontext"><i class="icon fa text-muted fa-money-bill"></i> <span> <b>Total: </b> ₹<span id="total">{{$total}}</span></span></p>

						<!-- <p class="d-block  icontext">
						<input type="checkbox" name="termscondition" value="1" checked>  I Accept your Terms & Condition
						</p>
 -->
						<a href="{{url($slug.'/order-success')}}" onclick="return confirm('Are You Want To Place This Order')" class="btn btn-primary btn-block"> <span class="text"> Order now </span> <i class="fa fa-chevron-right"></i></a>
					</section>
				<?php }else{?>
					<div class="d-md-flex align-items-md-center height-100vh--md">
						<div class="container text-center space-2 space-3--lg">
							<div class="w-md-80 w-lg-60 text-center mx-md-auto">
								<div class="mb-5">
									<span class="u-icon u-icon--secondary u-icon--lg rounded-circle mb-4">
										<!-- <span class="fa fa-shopping-bag u-icon__inner"></span> -->
										<img src="{{asset('public/assets/img/empty_cart.jpg')}}" width="165px" height="143px">
									</span>
									<h1 class="h2">Your cart is currently empty</h1>
									<p>Before proceed to checkout you must add some products to your shopping cart. You will find a lot of interesting products on our "Shop" page.</p>
								</div>
								<a class="btn btn-primary btn-wide" href="{{url('/'.$slug)}}">Start Shopping</a>
							</div>
						</div>
					</div>

				<?php }?>
			</main>

		</div> 
		@include('front.common.footer')







