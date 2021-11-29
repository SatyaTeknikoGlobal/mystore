    
<!DOCTYPE html>

<html class="loading" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/img/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('public/assets/img/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/chartist.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/themes/layout-dark.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/css/plugins/switchery.min.css')}}">
    <!-- END APEX CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/pages/dashboard1.min.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
</head>

<!-- BEGIN : Body-->
<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
      <div class="main-panel">
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-overlay"></div>
          <div class="content-wrapper"><!--Login Page Starts-->
            <section id="login" class="auth-height">
              <div class="row full-height-vh m-0">
                <div class="col-12 d-flex align-items-center justify-content-center">
                  <div class="card overflow-hidden">
                    <div class="card-content">
                      <div class="card-body auth-img">
                        <div class="row m-0">
                          <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                            <img src="{{asset('public/assets/img/gallery/login.png')}}" alt="" class="img-fluid" width="300" height="230">
                        </div>
                        <div class="col-lg-6 col-12 px-4 py-3">
                            <h4 class="mb-2 card-title">Login</h4>
                            <p>Welcome back, please login to your account.</p>
                            <form action="{{url('admin/login')}}" method="post">
                                {!! csrf_field() !!}
                                <input type="text" class="form-control mb-3" name="username" placeholder="Username">
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                                <input type="password" class="form-control mb-2" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                   
                                </div>
                                <div class="d-flex justify-content-between flex-sm-row flex-column">
                                  
                                  <button type="submit" class="btn btn-primary">Login</button>
                              </div>
                          </form>
                          
                      </div>

                      
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</section>
<!--Login Page Ends-->
</div>
</div>
<!-- END : End Main Content-->
</div>
</div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->