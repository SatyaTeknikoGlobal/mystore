@include('admin.common.header')
<?php
$name = isset($user->name) ? $user->name : old('user');
$email = isset($user->email) ? $user->email : old('email');
$address = isset($user->address) ? $user->address : old('address');
$phone = isset($user->phone) ? $user->phone : old('phone');
$username = isset($user->username) ? $user->username : old('username');
$image = isset($user->image) ? $user->image : old('image');
$storage = Storage::disk('public');
//pr($storage);
$path = 'user/';
$imgUrl =  url('public/storage/'.$path.'thumb/'.$image);

$type = old('type');
$type = isset($type) ? $type :'general';

?>

<div class="main-panel">
	<!-- BEGIN : Main Content-->
	<div class="main-content">
		<div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="row">
				<div class="col-12">
					<div class="content-header">Account Settings</div>
					<p class="content-sub-header mb-1">Configure account settings to your needs.</p>
				</div>
			</div>
			@include('snippets.flash')
			<!-- Account Settings starts -->
			<div class="row">
				<div class="col-md-3 mt-3">
					<!-- Nav tabs -->
					<ul class="nav flex-column nav-pills" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?php if($type == 'general' ) echo 'active'?>" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general"
							aria-selected="true">
							<i class="ft-settings mr-1 align-middle"></i>
							<span class="align-middle">General</span>
						</a>
					</li>
					<li class="nav-item <?php if($type == 'password' ) echo 'active'?>">
						<a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab"
						aria-controls="change-password" aria-selected="false">
						<i class="ft-lock mr-1 align-middle"></i>
						<span class="align-middle">Change Password</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="col-md-9">
			<!-- Tab panes -->
			<div class="card">
				<div class="card-content">
					<div class="card-body">
						<div class="tab-content">
							<!-- General Tab -->
							
								<div class="tab-pane <?php if($type == 'general' ) echo 'active'?>" id="general" role="tabpanel" aria-labelledby="general-tab">

									<form action="" method="post" enctype="multipart/form-data">
								{!! csrf_field() !!}

								<input type="hidden" name="type" value="general">

									<div class="media">
										<img src="{{$imgUrl}}" alt="profile-img" class="rounded mr-3"
										height="64" width="64">
										<div class="media-body">
											<div class="col-12 d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
												<label class="btn btn-sm bg-light-primary mb-sm-0" for="select-files">Upload Photo</label>
												<input type="file" id="select-files" name="file" hidden>
												@include('snippets.errors_first', ['param' => 'file'])
											</div>
											<p class="text-muted mb-0 mt-1 mt-sm-0">
												<small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
											</p>
										</div>
									</div>
									<hr class="mt-1 mt-sm-2">

									<div class="row">
									
										<div class="col-12 form-group">
											<label for="name">Name</label>
											<div class="controls">
												<input type="text" id="name" class="form-control" placeholder="Name" value="{{$name}}" name="name" 
												>

											</div>
											@include('snippets.errors_first', ['param' => 'name'])
										</div>
										<div class="col-12 form-group">
											<label for="name">Address</label>
											<div class="controls">
												<input type="text" id="address" class="form-control" placeholder="Address" value="{{$address}}" name="address" 
												>

											</div>
											@include('snippets.errors_first', ['param' => 'address'])
										</div>
										
										<div class="col-12 form-group">
											<label for="name">Email</label>
											<div class="controls">
												<input type="text" id="email" class="form-control" placeholder="Email" value="{{$email}}" name="email" 
												>

											</div>
											@include('snippets.errors_first', ['param' => 'email'])
										</div>
										<div class="col-12 form-group">
											<label for="name">UserName</label>
											<div class="controls">
												<input type="text" id="username" class="form-control" placeholder="UserName" value="{{$username}}" name="username" 
												>

											</div>
											@include('snippets.errors_first', ['param' => 'username'])
										</div>
										<div class="col-12 form-group">
											<label for="name">Phone</label>
											<div class="controls">
												<input type="text" id="phone" class="form-control" placeholder="Phone" value="{{$phone}}" name="phone" 
												>

											</div>
											@include('snippets.errors_first', ['param' => 'username'])
										</div>
										


										<div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
											<button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
											<button type="reset" class="btn btn-secondary mb-1">Cancel</button>
										</div>
									</div>
											</form>
								</div>
					
							<!-- Change Password Tab -->
							<div class="tab-pane <?php if($type == 'password') echo 'active'?>" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
								<form action="{{route('admin.change_password')}}" method="post" enctype="multipart/form-data">
							{!! csrf_field() !!}

								<input type="hidden" name="type" value="password">

									<div class="form-group">
										<label for="old-password">Old Password</label>
										<div class="controls">
											<input type="password" id="old-password" class="form-control" placeholder="Old Password" name="old_password" >
											@include('snippets.errors_first', ['param' => 'old_password'])
										</div>
									</div>
									<div class="form-group">
										<label for="new-password">New Password</label>
										<div class="controls">
											<input type="password" id="new-password" class="form-control" placeholder="New Password" name="new_password" >
											@include('snippets.errors_first', ['param' => 'new_password'])
										</div>
									</div>
									<div class="form-group">
										<label for="retype-new-password">Retype New Password</label>
										<div class="controls">
											<input type="password" id="retype-new-password" class="form-control" placeholder="New Password" name="confirm_password" 
											>
											@include('snippets.errors_first', ['param' => 'confirm_password'])
										</div>
									</div>
									<div class="d-flex flex-sm-row flex-column justify-content-end">
										<button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
										<button type="reset" class="btn btn-secondary mb-1">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Account Settings ends -->
</div>
</div>
</div>

@include('admin.common.footer')