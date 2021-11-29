@include('front.common.header')
<?php
$slug = isset($vendor->slug) ? $vendor->slug :'';

$imageUrl = '';
if(!empty(Auth::guard('appusers')->user()->image)){
	$imageUrl = Auth::guard('appusers')->user()->image;
}

$name = Auth::guard('appusers')->user()->name;
$email = Auth::guard('appusers')->user()->email;
$mobile = Auth::guard('appusers')->user()->mobile;
$imgUrl = asset('public/assets/front/images/avatars/1.jpg');

if(!empty(Auth::guard('appusers')->user()->image)){
$imgUrl = Auth::guard('appusers')->user()->image;
}
?>
<div class="screen-wrap">


	<header class="app-header bg-primary">
		<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
		<h5 class="title-header">Change Password</h5>
		<div class="header-right"></div>

	</header> <!-- section-header.// -->

	<main class="app-content">
		<section class="padding-around">
			@include('snippets.flash')
			<form action="{{url($slug.'/change-password')}}" method="post" class="block-register">
				@csrf
				<div class="form-group">
					<label>Old Password</label>
					<input type="text"  class="form-control" name="old_password" value="">
					@include('snippets.errors_first', ['param' => 'old_password'])
				</div>

				<div class="form-group">
					<label>New Password</label>
					<input type="text" class="form-control" name="password" value="">
					@include('snippets.errors_first', ['param' => 'password'])
				</div>

				<div class="form-group">
					<label>Confirm Password</label>
					<input type="text" name="confirm_password" class="form-control" value="">
					@include('snippets.errors_first', ['param' => 'confirm_password'])
				</div>

				<button type="submit" class="btn btn-block btn-primary">Change Password</button>
			</form>




		</section>
	</main>
</div> 
@include('front.common.footer')

<script type="text/javascript">
	$("#file_pasport").change(function(){
		$('#upload_image').submit();
	});
</script>