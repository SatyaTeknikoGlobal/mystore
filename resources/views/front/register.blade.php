@include('front.common.header')
<?php
$url = explode("/", $referer);
$url1 = $url[0];
?>
<div class="screen-wrap">


<header class="app-header bg-primary">
	<a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
    <div class="header-right">  </div>
</header> <!-- section-header.// -->

<main class="app-content">

<div class="bg-primary padding-x padding-bottom">
    <h3 class="title-page text-white">Register</h3>
</div>

<section class="padding-around">
<form action="{{route('user.register')}}" method="post" class="p-4">
    @csrf
    <input type="hidden" name="referer" value="{{$referer}}">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Enter Name">
        @include('snippets.errors_first', ['param' => 'name'])
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Enter Email">
        @include('snippets.errors_first', ['param' => 'email'])
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}" placeholder="Enter Phone">
        @include('snippets.errors_first', ['param' => 'mobile'])
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
        @include('snippets.errors_first', ['param' => 'password'])
    </div>
    <button class="btn btn-block btn-primary">Register</button>
</form>

<p class="text-center">
    Already have account <br> <a href="{{url('/account/login?referer='.$referer)}}" class="btn-link">Login</a>
</p>


<p class="text-center">
    <a href="{{url($url1)}}" class="btn-link">Home</a>
</p>

</section>

</main>
</div>




