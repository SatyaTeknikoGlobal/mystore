@include('admin.common.sidebar')
<?php
$name = isset($user->name) ? $user->name : old('user');
$email = isset($user->email) ? $user->email : old('email');
$address = isset($user->address) ? $user->address : old('address');
$phone = isset($user->phone) ? $user->phone : old('phone');
$username = isset($user->username) ? $user->username : old('username');

?>

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Basic Inputs</h4>
		</div>
		@include('snippets.flash')
		<form action="" method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="basicInput">Name</label>
							<input type="text" class="form-control" name="name" id="basicInput"
							placeholder="Enter Name" value="{{$name}}">
						</div>
						@include('snippets.errors_first', ['param' => 'name'])

						<div class="form-group">
							<label for="helpInputTop">Address</label>
							<input type="text" value="{{$address}}" class="form-control" name="address" placeholder="Address" id="helpInputTop">
						</div>
						@include('snippets.errors_first', ['param' => 'address'])
						<div class="form-group">
							<label for="helperText">Email</label>
							<input type="text" id="helperText" name="email" class="form-control" placeholder="Email" value="{{$email}}">
						</div>
						@include('snippets.errors_first', ['param' => 'email'])
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="disabledInput">UserName</label>
							<input type="text" class="form-control" id="disabledInput"
							placeholder="Enter User Name" value="{{$username}}" name="username">
						</div>
						@include('snippets.errors_first', ['param' => 'username'])
						<div class="form-group">
							<label for="disabledInput">Phone</label>
							<input type="text" class="form-control" id="readonlyInput"
							value="{{$phone}}" placeholder="Enter Phone" name="phone">
						</div>
						@include('snippets.errors_first', ['param' => 'phone'])

						<div class="form-group">
							<label for="disabledInput">Profile Image</label>
							<input type="file" class="form-control" id="readonlyInput"
							value="" name="file">
						</div>
						@include('snippets.errors_first', ['param' => 'file'])
					</div>
				</div>
				<div>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Change Password</h4>
		</div>
		
		<form action="{{route('admin.change_password')}}" method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="disabledInput">Old Password</label>
							<input type="text" class="form-control" id="readonlyInput"
							value="" placeholder="Enter Old Password" name="old_password">
						</div>
						@include('snippets.errors_first', ['param' => 'old_password'])
						<div class="form-group">
							<label for="disabledInput">Password</label>
							<input type="text" class="form-control" id="disabledInput"
							placeholder="Enter Password" value="" name="new_password">
						</div>
						@include('snippets.errors_first', ['param' => 'new_password'])
						<div class="form-group">
							<label for="disabledInput">Confirm Password</label>
							<input type="text" class="form-control" id="readonlyInput"
							value="" placeholder="Enter Confirm Password" name="confirm_password">
						</div>
						@include('snippets.errors_first', ['param' => 'confirm_password'])
					</div>
				</div>
				<div>
					<button type="submit" class="btn btn-success">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
@include('admin.common.footer')