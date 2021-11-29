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
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/chartist.min.css')}}"> -->
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
     <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/datatables/dataTables.bootstrap4.min.css')}}">
    <!-- END: Custom CSS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendors/css/select2.min.css')}}">
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>

 <link rel="stylesheet" href="{{asset('public/assets/css/plugins/form-validation.css')}}">
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body class="vertical-layout vertical-menu 2-columns  navbar-sticky" data-menu="vertical-menu" data-col="2-columns">

    <nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed">
      <div class="container-fluid navbar-wrapper">
        <div class="navbar-header d-flex">
          <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center" data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
          <ul class="navbar-nav">
            <li class="nav-item mr-2 d-none d-lg-block"><a class="nav-link apptogglefullscreen" id="navbar-fullscreen" href="javascript:;"><i class="ft-maximize font-medium-3"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="javascript:"><i class="ft-search font-medium-3"></i></a>
              <div class="search-input">
                <div class="search-input-icon"><i class="ft-search font-medium-3"></i></div>
                <input class="input" type="text" placeholder="Search..." tabindex="0" data-search="template-search">
                <div class="search-input-close"><i class="ft-x font-medium-3"></i></div>
                <ul class="search-list"></ul>
              </div>
            </li>
          </ul>
        </div>
        <div class="navbar-container">
          <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="dropdown nav-item mr-1"><a class="nav-link dropdown-toggle user-dropdown d-flex align-items-end" id="dropdownBasic2" href="javascript:;" data-toggle="dropdown">
                  <div class="user d-md-flex d-none mr-2"><span class="text-right">{{Auth::guard('admin')->user()->name}}</span><span class="text-right text-muted font-small-3">{{Auth::guard('admin')->user()->email}}</span></div><img class="avatar" src="{{Auth::guard('admin')->user()->image}}" alt="avatar" height="35" width="35"></a>
                <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0" aria-labelledby="dropdownBasic2"><a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center"><i class="ft-message-square mr-2"></i><span>Chat</span></div></a><a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Edit Profile</span></div></a><a class="dropdown-item" href="#">
                    <!-- <div class="d-flex align-items-center"><i class="ft-mail mr-2"></i><span>My Inbox</span></div></a> -->
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="{{url('/admin/logout')}}">
                    <div class="d-flex align-items-center"><i class="ft-power mr-2"></i><span>Logout</span></div></a>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
    </nav>