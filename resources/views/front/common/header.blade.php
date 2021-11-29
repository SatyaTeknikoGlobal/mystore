<?php 
$page = '';
$slug = isset($vendor->slug) ? $vendor->slug :'';
$segments_arr = request()->segments();
$seg1 = isset($segments_arr[0]) ? $segments_arr[0] :'';
$seg2 = isset($segments_arr[1]) ? $segments_arr[1] :'';
$name = isset(Auth::guard('appusers')->user()->name) ? Auth::guard('appusers')->user()->name :'User';
	
//print_r($segments_arr);
if($seg1 == $slug){
	$page = 'home';
}if($seg2 == 'cart'){
	$page = 'cart';
}

$url = url('/').'/'.$slug;
$imgUrl = asset('public/assets/front/images/avatars/1.jpg');
if(!empty(Auth::guard('appusers')->user()->image)){
$imgUrl = Auth::guard('appusers')->user()->image;
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">


<title>Front Web</title>
	<link rel="icon" href="imgs/icon512.png" type="image/png" sizes="16x16">

<link href="{{asset('public/assets/front/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
<script src="{{asset('public/assets/front/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{asset('public/assets/front/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<link href="{{asset('public/assets/front/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{asset('public/assets/front/fonts/fontawesome/css/all.min.css')}}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{asset('public/assets/front/css/mobile.css')}}" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="{{asset('public/assets/front/css/bootstrap-side-modals.css')}}">


	<link rel="manifest" href="/manifest.php?seg=<?php echo $seg1;?>">


<!-- custom javascript -->
<script src="{{asset('public/assets/front/js/script.js')}}" type="text/javascript"></script>
<!-- plugin: fancybox  -->
<script src="{{asset('public/assets/front/plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>
<link href="{{asset('public/assets/front/plugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>
<style type="text/css">
	body{
		max-width: 500px;
  		margin: auto;
	}
	.descrip{
		  font-size: 13px;
	}
	.add-to-btn{
		display: block;
  width: 100%;
  border: none;
  background-color: #04AA6D;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
	}
</style>
<div class="d-none">
<button type="button" class="btn btn-light border rounded-pill shadow-sm mb-1" data-toggle="modal" data-target="#bottom_modal" id="homemodal">Bottom Modal <i class="fa fa-angle-down pl-2"></i></button>
</div>

<div class="modal modal-bottom fade" id="bottom_modal" tabindex="-1" role="dialog" aria-labelledby="bottom_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      		<h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Add to Home Screen</b></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<div class="d-flex">
      		<img src="https://royalitsolution.in/public/storage/settings/150221060218-oie_MGGl65pBRn5g-removebg-preview.png" height="40px" width="40px">
      		&nbsp;&nbsp;&nbsp;
        <p class="descrip">You Can easily add this store to your home screen to have an instant access and browse faster with an app like experience!!</p>
				</div><br>

			<div class="add-to">
				<button class="add-to-btn">Add to home screen</button>
			</div>
      	
      </div>
    </div>
  </div>
</div>
</head>

<body>
<i class="screen-overlay"></i>
<aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary">
		<button class="btn-close close text-white">&times;</button>
		<img src="{{$imgUrl}}" class="img-sm rounded-circle" alt="">
		<h6 class="text-white mt-3 mb-0">Welcome {{$name}}!</h6>
	</div>
	<nav class="nav-sidebar">
		<a href="{{$url}}"> <i class="fa fa-home"></i> Home</a>
		<a href="{{url($slug.'/all-category')}}"> <i class="fa fa-th"></i>	Categories</a>
		<!-- <a href="#">  <i class="fa fa-info-circle"></i> About us</a> -->
		<!-- <a href="index.html">  <i class="fa fa-building"></i> Company</a> -->
		<a href="{{$url.'/profile'}}">  <i class="fa fa-cog"></i> Settings</a>
		<!-- <a href="index.html"> <i class="fa fa-home"></i> All screens</a> -->
	</nav>
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> +91{{$vendor->phone ?? ''}}</a>
		<a href="#"> <i class="fa fa-envelope"></i> {{$vendor->email ?? ''}}</a>
		<a href="#"> <i class="fa fa-map-marker"></i>{{$vendor->address ?? ''}}</a>
	</nav>
</aside>
 <script type="text/javascript">
	if ('serviceWorker' in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register('https://1313xyz.xyz/service-worker.js').then(function(registration) {
        console.log('Service worker registration succeeded:', registration);
      }, /*catch*/ function(error) {
        console.log('Service worker registration failed:', error);
      });
    } else {
      console.log('Service workers are not supported.');
    }

	let deferredPrompt;
	var div = document.querySelector('.add-to');
	var button = document.querySelector('.add-to-btn');
	div.style.display = 'none';

	window.addEventListener('beforeinstallprompt', (e) => {
	  // Prevent Chrome 67 and earlier from automatically showing the prompt
	  e.preventDefault();
	  // Stash the event so it can be triggered later.
	  deferredPrompt = e;
	  div.style.display = 'block';

	  button.addEventListener('click', (e) => {
	  // hide our user interface that shows our A2HS button
	  div.style.display = 'none';
	  // Show the prompt
	  deferredPrompt.prompt();
	  // Wait for the user to respond to the prompt
	  deferredPrompt.userChoice
	    .then((choiceResult) => {
	      if (choiceResult.outcome === 'accepted') {
	        console.log('User accepted the A2HS prompt');
	      } else {
	        console.log('User dismissed the A2HS prompt');
	      }
	      deferredPrompt = null;
	    });
	});
	});

</script>