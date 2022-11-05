 <!-- BEGIN: SideNav-->
 <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-active-rounded sidenav-light ">
     <div class="brand-sidebar">
         <div class="row noMargin">
             <a class="brand-logo darken-1" href="<?php if (Auth::user()->role == 1) {
                 route('admin_dashboard');
             } elseif (Auth::user()->role == 2) {
                 route('driver_dashboard');
             } else {
                 route('user_dashboard');
             }
             ?>">
                 <img class="hide-on-med-and-down"
                     src="{{ asset('/public/admin_assets/images/logo/techi_blue_icon.png') }}" alt="materialize logo" />
                 <img class="show-on-medium-and-down hide-on-med-and-up"
                     src="{{ asset('/public/admin_assets/images/logo/techi_white_icon.png') }}" alt="materialize logo" />

                 <span class="logo-text hide-on-med-and-down">
                     {{-- {{Auth::user()->role}} --}}
                     <?php
                     // if(Auth::user()->role == 1){
                     //     echo('Admin');
                     // } else if(Auth::user()->role == 2){
                     //     echo('Driver');
                     // }else{
                     //     echo('User');
                     // }
                     echo Auth::user()->name;
                     ?>
                 </span>
             </a>
         </div>
     </div>
     <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
         data-menu="menu-navigation" data-collapsible="menu-accordion">
         <?php if(Auth::user()->role == 1){ ?>
         <li class="bold ">
             <a class="waves-effect waves-cyan " href="{{ route('admin_dashboard') }}">
                 <i class="material-icons">dashboard</i>
                 <span class="menu-title" data-i18n="User Profile">Dashboard</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('users_list') }}" class="<?php if (request()->routeIs('users_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">group</i>
                 <span class="menu-title" data-i18n="User Profile">Users list</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('drivers_list') }}" class="<?php if (request()->routeIs('drivers_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">group</i>
                 <span class="menu-title" data-i18n="User Profile">Pickup agents</span>
             </a>
         </li>
         <li class="bold ">
             <a class="collapsible-header waves-effect waves-cyan " href="javascript:void(0) ">
                 <i class="material-icons">category</i>
                 <span class="menu-title" data-i18n="eCommerce">Category</span>
             </a>
             <div class="collapsible-body">
                 <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                     <li class="">
                         <a href="{{ route('category_list') }}" class="<?php if (request()->routeIs('category_list')) {
                             echo 'active gradient-shadow gradient-45deg-green-teal';
                         } ?>">
                             <i class="material-icons">radio_button_unchecked</i>
                             <span data-i18n="Products Page">Category list</span>
                         </a>
                     </li>

                     <li class="">
                         <a href="{{ route('create_category', 0) }}" class="<?php if (request()->routeIs('create_category')) {
                             echo 'active gradient-shadow gradient-45deg-green-teal';
                         } ?>">
                             <i class="material-icons">radio_button_unchecked</i>
                             <span data-i18n="Pricing">Add Category</span>
                         </a>
                     </li>
                 </ul>
             </div>
         </li>
         <li class="bold ">
             <a class="collapsible-header waves-effect waves-cyan " href="javascript:void(0) ">
                 <i class="material-icons">category</i>
                 <span class="menu-title" data-i18n="eCommerce">Products</span>
             </a>
             <div class="collapsible-body">
                 <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                     <li class="">
                         <a href="{{ route('product_list') }}" class="<?php if (request()->routeIs('product_list')) {
                             echo 'active gradient-shadow gradient-45deg-green-teal';
                         } ?>">
                             <i class="material-icons">radio_button_unchecked</i>
                             <span data-i18n="Products Page">Product list</span>
                         </a>
                     </li>

                     <li class="">
                         <a href="{{ route('create_product', 0) }}" class="<?php if (request()->routeIs('create_product')) {
                             echo 'active gradient-shadow gradient-45deg-green-teal';
                         } ?>">
                             <i class="material-icons">radio_button_unchecked</i>
                             <span data-i18n="Pricing">Add Product</span>
                         </a>
                     </li>
                 </ul>
             </div>
         </li>
         <li class="bold ">
             <a href="{{ route('user_product_list', 0) }}" class="<?php if (request()->routeIs('user_product_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">shopping_cart</i>
                 <span class="menu-title" data-i18n="User Profile">Products User View</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('order_list') }}" class="<?php if (request()->routeIs('order_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">shopping_cart</i>
                 <span class="menu-title" data-i18n="User Profile">Orders list</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('leaderboard') }}" class="<?php if (request()->routeIs('leaderboard')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">leaderboard</i>
                 <span class="menu-title" data-i18n="User Profile">Leaderboard</span>
             </a>
         </li>
         <?php }else if(Auth::user()->role == 2){?>
         <li class="bold ">
             <a href="{{ route('driver_dashboard') }}" class="<?php if (request()->routeIs('driver_dashboard')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">dashboard</i>
                 <span class="menu-title" data-i18n="User Profile">Dashboard</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('agent_order_list') }}" class="<?php if (request()->routeIs('agent_order_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">shopping_cart</i>
                 <span class="menu-title" data-i18n="User Profile">Orders list</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('driver_analytics') }}" class="<?php if (request()->routeIs('driver_analytics')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">bar_chart</i>
                 <span class="menu-title" data-i18n="User Profile">Analytics</span>
             </a>
         </li>
         <?php }else {?>
         <li class="bold ">
             <a href="{{ route('user_dashboard') }}" class="<?php if (request()->routeIs('user_dashboard')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">dashboard</i>
                 <span class="menu-title" data-i18n="User Profile">Dashboard</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('user_product_list', 0) }}" class="<?php if (request()->routeIs('user_product_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">shopping_cart</i>
                 <span class="menu-title" data-i18n="User Profile">Products</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('user_category_list') }}" class="<?php if (request()->routeIs('user_category_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">category</i>
                 <span class="menu-title" data-i18n="User Profile">Categories</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('user_order_list') }}" class="<?php if (request()->routeIs('user_order_list')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">shopping_bag</i>
                 <span class="menu-title" data-i18n="User Profile">Orders</span>
             </a>
         </li>
         <li class="bold ">
             <a href="{{ route('user_analytics') }}" class="<?php if (request()->routeIs('user_analytics')) {
                 echo 'active gradient-shadow gradient-45deg-green-teal';
             } ?>">
                 <i class="material-icons">bar_chart</i>
                 <span class="menu-title" data-i18n="User Profile">Analytics</span>
             </a>
         </li>
         <?php }?>
     </ul>
     <div class="navigation-background"></div>
     <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
         href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
 </aside> <!-- END: SideNav-->
