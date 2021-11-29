@include('front.common.header')
<?php
$slug = isset($vendor->slug) ? $vendor->slug :'';
$imgUrl = asset('public/assets/front/images/avatars/1.jpg');
if(!empty(Auth::guard('appusers')->user()->image)){
$imgUrl = Auth::guard('appusers')->user()->image;
}
?>
<div class="screen-wrap">


<header class="app-header bg-primary">
	<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
    <div class="header-right"> <a href="{{url('/user-logout?referer='.$slug)}}" class="btn-header">Log out</a></div>
</header> <!-- section-header.// -->


<main class="app-content">

<section class="padding-x pb-3 bg-primary text-white">
	<figure class="icontext align-items-center mr-4" style="max-width: 300px;">
		<img class="icon icon-md rounded-circle" src="{{$imgUrl}}">
		<figcaption class="text">
			<p class="h5 title">{{Auth::guard('appusers')->user()->name}}</p>
			<p class="text-white-50">{{Auth::guard('appusers')->user()->mobile}}</p>
		</figcaption>
	</figure>
</section>

<section class="padding-around" style="display: none;">
	<ul class="row">
		
		<li class="col-12">
			<a href="#" class="btn-card-icontop btn">
				<span class="icon"> <i class="fa fa-shopping-basket"></i> </span>
				<small class="text text-center"> Purchases</small>
			</a>
		</li>
		
	</ul>
</section>  
<?php /*
<hr class="divider">

<section class="padding-top">
<h5 class="title-section padding-x">Orders</h5>
<nav class="nav-list">
	<a class="btn-list" href="{{url($slug.'/orders/all')}}">
		<span class="float-right badge badge-warning">{{$all_order}}</span>
		<span class="text">All Orders</span>
	</a>
	<a class="btn-list" href="{{url($slug.'/orders/pending')}}">
		<span class="float-right badge badge-warning">{{$pending_orders}}</span>
		<span class="text">Pending</span>
	</a>
	<a class="btn-list" href="{{url($slug.'/orders/completed')}}">
		<span class="float-right badge badge-success">{{$complte_orders}}</span>
		<span class="text">Completed</span>
	</a>
	<a class="btn-list" href="{{url($slug.'/orders/cancel')}}"> 
		<span class="float-right badge badge-secondary">{{$cancel_orders}}</span>
		<small class="title"></small>
		<span class="text">Cancelled</span>
	</a>
	<a class="btn-list" href="{{url($slug.'/orders/reject')}}"> 
		<span class="float-right badge badge-secondary">{{$rejected_orders}}</span>
		<small class="title"></small>
		<span class="text">Rejected</span>
	</a>
</nav>
</section>
*/?>


<hr class="divider"> 




<section class="padding-top">
	<h5 class="title-section padding-x">Account</h5>
	<nav class="nav-list">
		
		<a class="btn-list" href="{{url($slug.'/change-password')}}">
			<i class="icon-control fa fa-chevron-right"></i>
			<span class="text">Change Password</span>
		</a>
	</nav>
</section> 

<hr class="divider"> 
<section class="padding-top">
<h5 class="title-section padding-x">Personal</h5>
<nav class="nav-list">
	<a class="btn-list" href="{{url($slug.'/edit-profile')}}">
		<i class="icon-action fa fa-pen"></i>
		<small class="title">Mobile</small>
		<span class="text">{{Auth::guard('appusers')->user()->mobile}}</span>
	</a>

	<a class="btn-list" href="{{url($slug.'/edit-profile')}}"> 
		<i class="icon-action fa fa-pen"></i>
		<small class="title">Email</small>
		<span class="text">{{Auth::guard('appusers')->user()->email}}</span>
	</a>
</nav>
</section>
</main>

</nav> <!-- nav-bottom -->

</div> 
@include('front.common.footer')
