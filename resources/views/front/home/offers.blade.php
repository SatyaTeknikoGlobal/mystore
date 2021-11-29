@include('front.common.header')
<?php 
$slug = isset($vendor->slug) ? $vendor->slug :'';


?>

<div class="screen-wrap">


	<header class="app-header bg-primary">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<h5 class="title-header">Offers</h5>
		<div class="header-right">  </div>
	</header> <!-- section-header.// -->


	<main class="app-content">
		

		<div class="d-md-flex align-items-md-center height-100vh--md">
			<div class="container text-center space-2 space-3--lg">
				<div class="w-md-80 w-lg-60 text-center mx-md-auto">
					<div class="mb-5">
						<span class="u-icon u-icon--secondary u-icon--lg rounded-circle mb-4">
							<!-- <span class="fa fa-shopping-bag u-icon__inner"></span> -->
							<img src="{{asset('public/assets/img/commingsoon.png')}}" width="300px" height="330px">
						</span>
						
					</div>
					<a class="btn btn-primary btn-wide" href="{{url('/'.$slug)}}">Start Shopping</a>
				</div>
			</div>
		</div>


	</main>

</div> 
@include('front.common.footer')







