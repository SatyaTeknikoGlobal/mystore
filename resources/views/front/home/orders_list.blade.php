
@include('front.common.header')
<?php
$slug = isset($vendor->slug) ? $vendor->slug :'';

?>
<style type="text/css">
	.top-left {
		position: absolute;
		top: 0px;
		left: 0px;
	}
</style>
<div class="screen-wrap">


	<header class="app-header bg-primary">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<div class="header-right"> <a href="{{url('/user-logout?referer='.$slug)}}" class="btn-header">Log out</a></div>
	</header>


	<main class="app-content">

		<div class="bg-primary padding-x padding-bottom">
			<h3 class="title-page text-white">All Orders</h3>
		</div>

		<section>
			<div class="row no-gutters">
				<?php if(!empty($orders) && count($orders) > 0){
					foreach($orders as $order){

						$coupon = DB::table('coupan')->where('id',$order->coupon_id)->first();
						if(!empty($coupon)){
							$coup_name = isset($coupon->name) ? $coupon->name :''; 
							$coup_price = isset($coupon->c_price) ? $coupon->c_price :0;
						}
						$coup_image = DB::table('vender_product_images')->where('coupan_id',$order->coupon_id)->first();
						$imgUrl = asset('public/assets/front/images/noimage.png');
						if(!empty($coup_image)){
							$imgUrl = $coup_image->product_image;
						}

						if($order->order_status == 'pending'){
							$btn = 'btn btn-warning';
							$status = 'Pending';
						}
			//if($order->order_status == 'accept'){
						$btn = 'btn btn-warning';
						$status = 'Pending';
			//}
				//echo $order->id;
						?>

						<div class="col-12 col-sm-6 col-md-6">
							<article class="product-lg">
								<a href="{{url($slug.'/order-details/'.$order->coupon_id)}}">

									<div class="img-wrap"><img src="{{$imgUrl}}"></div>
									<!-- <button class="{{$btn}} top-left">{{$status}}</button> -->

								</a>
								<div class="info-wrap">
									<div class="price-wrap">
										<small class="text-muted float-right">{{$coupon->created_at}}</small>
										<span class="price">Rs. {{$coup_price}}</span> 
									</div> 
									<p class="title">{{$coup_name}}</p>
									<?php if($order->order_status == 'cancel'){?>
										<small style="color: red;">Cancelled</small>

									<?php }else{?>

										<?php if($order->vendor_status == 'pending'){?>
											<!-- <img src="{{asset('public/assets/img/loading.gif')}}" style="height: 30px"> -->
											<small>Waiting For Approval</small>

										<?php }elseif($order->vendor_status == 'accept'){?>
											<?php if ($order->order_status == 'pending') { ?>
												<!-- <img src="{{asset('public/assets/img/loading.gif')}}" style="height: 30px"> -->
												<small style="color: green;">Order Accepted By Vendor</small>
											<?php }elseif ($order->order_status == 'completed') {?>
												<!-- <img src="{{asset('public/assets/img/order_delivered.gif')}}" style="height: 30px"> -->

												<small>Delivered</small>
											<?php }elseif ($order->order_status == 'expired') { ?>
												<small style="color: red;"><strong>Expired</strong></small>
											<?php } ?>
										<?php }elseif($order->vendor_status == 'reject'){?>
											<small style="color: red;"><strong>Order Rejected By Vendor</strong></small>

										<?php }?>
									<?php } ?>

								</div> 
								<div>
									<a href="tel:+91{{$vendor->phone ?? ''	}}" class="btn btn-sm btn-light"> <i class="fa fa-phone"></i>  Call </a>
									<?php if($order->order_status != 'cancel' && $order->vendor_status != 'reject'){?>
										<?php if($order->order_status != 'completed'){?>
											<a href="#" class="btn btn-sm btn-light" onclick="cancel_order('{{$order->id}}')"> <i class="fa fa-envelope"></i> Cancel </a>
										<?php }?>

									<?php }?>
								</div>
							</article>
						</div> <!-- col.// -->

			

					<?php }}?>

				</div> <!-- row end -->

			</section> <!-- section body .// -->



		</main>
	</div>
	@include('front.common.footer')