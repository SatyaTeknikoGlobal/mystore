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

<div class="screen-wrap">

	<header class="app-header bg-primary">

	</header>

	<main class="app-content">

		<section class="mb-2 scroll-horizontal" >

		</section>



		<h5 class="title-section" style="text-align: center;">My Orders</h5>

		<hr class="divider mb-3">

		<section class="scroll-horizontal padding-x item-div">
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

					$total = $order->price * $order->qty;
						///echo $total;
				//echo $order->id;
					?>

					<div class="item">
						<a href="{{url($slug.'/products/'.$order->id)}}" class="product-sm">
							<div class="img-wrap"> <img src="{{$imgUrl}}"> <span class="tag--">Multi</span></div>
							<div class="text-wrap">
								<p class="title text-truncate mb-2">{{$order->name}}</p>
								<div class="price">
									<!-- <small>MRP:</small> <del>₹{{$order->c_mrp}}</del> -->
									<span>₹{{$order->price}} ×  {{$order->qty}} = {{$total}}</span>
								</div> 
								<div class="d-flex">
					<!-- <span class="inclu mr-2">inclusion</span>
						<span class="inclu">detail</span> -->
					</div>
				</div>


				<?php if($order->order_status != 'cancel' && $order->vendor_status != 'reject'){?>
					<?php if($order->order_status != 'completed'){?>
						<div style="position: relative;">
							<a class="btn add_btn" onclick="cancel_order('{{$order->id}}')" style=" color: #03a9f4 !important;position: relative;">Cancel</a>
						</div>

					<?php }}?>

					<?php if($order->order_status == 'cancel'){?>
						<small style="color: red;">Cancelled</small>

					<?php }else{?>

						<?php if($order->vendor_status == 'pending'){?>
							<img src="{{asset('public/assets/img/loading.gif')}}" style="height: 30px"><small>Waiting For Approval</small>

						<?php }elseif($order->vendor_status == 'accept'){?>
							<?php if ($order->order_status == 'pending') { ?>
								<img src="{{asset('public/assets/img/loading.gif')}}" style="height: 30px"><small style="color: green;">Order Accepted By Vendor</small>
							<?php }elseif ($order->order_status == 'completed') {?>
								<img src="{{asset('public/assets/img/order_delivered.gif')}}" style="height: 30px"><small>Delivered</small>
							<?php }elseif ($order->order_status == 'expired') { ?>
								<small style="color: red;"><strong>Expired</strong></small>
							<?php } ?>
						<?php }elseif($order->vendor_status == 'reject'){?>
							<small style="color: red;"><strong>Order Rejected By Vendor</strong></small>

						<?php }?>
					<?php } ?>



					
				</a>
			</div>





		<?php }}else{?>
			<p>No Orders Found</p>
		<?php  }?>

	</section>







</main>
@include('front.common.footer')