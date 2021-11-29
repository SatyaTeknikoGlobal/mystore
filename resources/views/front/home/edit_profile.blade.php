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
		<h5 class="title-header"> Profile edit </h5>
		<div class="header-right"></div>

	</header> <!-- section-header.// -->

	<main class="app-content">
		<section class="padding-around">

			<form method="post" action="{{url($slug.'/upload-image')}}" enctype="multipart/form-data" id="upload_image">
				@csrf
			<div class="icontext">
				<div class="icon">
					<img src="{{$imgUrl}}" class="rounded-circle shadow-sm img-md" >
				</div>
				<div class="text">
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="image" id="file_pasport" accept="" lang="en">
						<label class="custom-file-label" for="file_pasport">Profile image</label>
					@include('snippets.errors_first', ['param' => 'image'])

					</div>
				</div>
			</div>
			</form>
			<hr>

			@include('snippets.flash')
			<form action="{{url($slug.'/edit-profile')}}" name="profile_form" id="profile_form" method="post" class="block-register">
				@csrf
				<div class="form-group">
					<label>Name</label>
					<input type="text"  class="form-control" name="name" value="{{$name}}">
					@include('snippets.errors_first', ['param' => 'name'])
				</div>

				<div class="form-group">
					<label>Phone</label>
					<input type="tel" class="form-control" name="mobile" value="{{$mobile}}" readonly>
					@include('snippets.errors_first', ['param' => 'mobile'])
				</div>

				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" class="form-control" value="{{$email}}">
					@include('snippets.errors_first', ['param' => 'email'])
				</div>

				<button type="submit" class="btn btn-block btn-primary"form="profile_form"> Save  </button>
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