 <?php
$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

 ?>

 <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


     
      <div class="app-sidebar menu-fixed" data-background-color="man-of-steel" data-image="{{asset('public/assets/img/sidebar-bg/01.jpg')}}" data-scroll-to-active="true">
     
        <div class="sidebar-header">
          <div class="logo clearfix"><a class="logo-text float-left" href="{{url('/admin')}}">
              <div class="logo-img"><img src="{{asset('public/assets/img/logo.png')}}" alt="Apex Logo"/></div><span class="text">MY STORE</span></a><a class="nav-toggle d-none d-lg-none d-xl-block" id="sidebarToggle" href="javascript:;"><i class="toggle-icon ft-toggle-right" data-toggle="expanded"></i></a><a class="nav-close d-block d-lg-block d-xl-none" id="sidebarClose" href="javascript:;"><i class="ft-x"></i></a></div>
        </div>
        <div class="sidebar-content main-menu-content">
          <div class="nav-container">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
         
              <li class=" nav-item"><a href="{{url('/admin')}}"><i class="ft-home"></i><span class="menu-item" data-i18n="Dashboard 1">Dashboard </span></a>
                 @if(CustomHelper::isAllowedModule('vendors'))
                 <li class=" nav-item"><a href="{{ route('admin.vendors.index') }}"><i class="ft-mail"></i><span class="menu-title" data-i18n="Email">Vendor</span></a>
                </li>
                @endif
                 @if(CustomHelper::isAllowedModule('users'))
                 <li class=" nav-item"><a href="{{ route('admin.users.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Email">Users</span></a>
                </li>
                   @endif

            
                 <li class="has-sub nav-item"><a href="javascript:;"><i class="ft-aperture"></i><span class="menu-title" data-i18n="UI Kit">Category</span></a>
                <ul class="menu-content">
                   @if(CustomHelper::isAllowedModule('businesscategory'))
                  <li><a href="{{ route('admin.businesscategory.index') }}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Grid">Business Category</span></a>
                  </li>
                   @endif
                     @if(CustomHelper::isAllowedModule('category'))
                  <li><a href="{{ route('admin.category.index') }}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Typography">Coupon Category</span></a>
                  </li>
                  @endif
                
                </ul>
              </li>
                

               @if(CustomHelper::isAllowedModule('collections'))
                 <li class=" nav-item"><a href="{{ route('admin.collections.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Email">Collections</span></a>
                </li>
                   @endif

                  @if(CustomHelper::isAllowedModule('coupons'))
                 <li class=" nav-item"><a href="{{ route('admin.coupon.index') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="Email">Coupons</span></a>
                </li>
                   @endif

              <li class="has-sub nav-item" style="display: none;"><a href="javascript:;"><i class="ft-aperture"></i><span class="menu-title" data-i18n="UI Kit">Products</span></a>
                <ul class="menu-content">
                  <li><a href="grids.html"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Grid">Vendor Product</span></a>
                  </li>
                     @if(CustomHelper::isAllowedModule('readymadeproducts'))
                  <li><a href="{{ route('admin.readymadeproducts.index') }}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item" data-i18n="Typography">Readymade Product</span></a>
                  </li>
                  @endif
                
                </ul>
              </li>
               @if(CustomHelper::isAllowedModule('orders'))
               <li class=" nav-item"><a href="{{ route('admin.orders.index',['type'=>'all','id'=>'0']) }}"><i class="ft-mail"></i><span class="menu-title" data-i18n="Email">Orders</span></a>
                </li>
                @endif
                
              <li class=" nav-item"><a href="{{url('/admin/logout')}}" target="_blank"><i class="ft-life-buoy"></i><span class="menu-title" data-i18n="Support">Logout</span></a>
              </li>
            </ul>
          </div>
        </div>
      
        <div class="sidebar-background"></div>
       
      </div>




<!-- ////////////////////////////////////////Sidebar End -->
