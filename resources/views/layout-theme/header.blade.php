 <!-- BEGIN: Header-->
 <header class="page-topbar" id="header">
     <div class="navbar navbar-fixed ">
         <nav
             class="navbar-main navbar-color nav-collapsible no-shadow nav-expanded sideNav-lock navbar-dark gradient-45deg-green-teal">
             <div class="nav-wrapper">
                 <div class="header-search-wrapper hide-on-med-and-down">
                     <img src="{{ asset('/public/admin_assets/images/logo/techi_logo_white.png') }}" alt=""
                         style="max-height: 35px">
                 </div>
                 <ul class="navbar-list right">
                     <li>
                         <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                             data-target="profile-dropdown">
                             <span class="avatar-status avatar-online profile_avatar">
                                 <img src="{{ asset('/resources/assets/images/profile_default.jpg') }}"
                                     alt="avatar"><i></i>
                             </span>
                         </a>
                     </li>
                 </ul>
                 <!-- profile-dropdown-->
                 <ul class="dropdown-content" id="profile-dropdown">
                     <?php if(Auth::user()->role != 1){ ?>
                     <li>
                         <a class="grey-text text-darken-1" href="{{ route('user_profile') }}">
                             <i class="material-icons">person_outline</i>
                             Profile
                         </a>
                     </li>
                     <?php } ?>
                     <li class="divider"></li>
                     <li>
                         <!-- Authentication -->
                         <a href="{{ route('logout') }}" class="grey-text text-darken-1" id="logoutbtn">
                             <i class="material-icons">keyboard_tab</i>
                             Logout
                         </a>

                     </li>
                 </ul>
             </div>
             <!-- <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form id="navbarForm">
                            <div class="input-field search-input-sm">
                                <input class="search-box-sm mb-0" type="search" required="" placeholder='Explore Materialize' id="search" data-search="template-list">
                                <label class="label-icon" for="search">
                                    <i class="material-icons search-sm-icon">search</i>
                                </label>
                                <i class="material-icons search-sm-close">close</i>
                                <ul class="search-list collection search-list-sm display-none"></ul>
                            </div>
                        </form>
                    </div>
                </nav> -->
         </nav>
     </div>
     <!-- search ul  -->
     <!-- <ul class="display-none" id="default-search-main">
            <li class="auto-suggestion-title">
                <a class="collection-item" href="#">
                    <h6 class="search-title">FILES</h6>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img src="{{ asset('/public/admin_assets/images/icon/pdf-image.png') }}" width="24" height="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">
                                    Two new item submitted</span>
                                <small class="grey-text">Marketing Manager</small>
                            </div>
                        </div>
                        <div class="status"><small class="grey-text">17kb</small></div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img src="{{ asset('/public/admin_assets/images/icon/doc-image.png') }}" width="24" height="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">52 Doc file Generator</span>
                                <small class="grey-text">FontEnd Developer</small>
                            </div>
                        </div>
                        <div class="status"><small class="grey-text">550kb</small></div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img src="images/icon/xls-image.png" width="24" height="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">25 Xls File Uploaded</span>
                                <small class="grey-text">Digital Marketing Manager</small>
                            </div>
                        </div>
                        <div class="status"><small class="grey-text">20kb</small></div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img src="{{ asset('/public/admin_assets/images/icon/jpg-image.png') }}" width="24" height="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">Anna Strong</span>
                                <small class="grey-text">Web Designer</small>
                            </div>
                        </div>
                        <div class="status"><small class="grey-text">37kb</small></div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion-title">
                <a class="collection-item" href="#">
                    <h6 class="search-title">MEMBERS</h6>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img class="circle" src="{{ asset('/public/admin_assets/images/avatar/avatar-7.png') }}" width="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">John Doe</span>
                                <small class="grey-text">UI designer</small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img class="circle" src="{{ asset('/public/admin_assets/images/avatar/avatar-8.png') }}" width="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">Michal Clark</span>
                                <small class="grey-text">FontEnd Developer</small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img class="circle" src="{{ asset('/public/admin_assets/images/avatar/avatar-10.png') }}" width="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">Milena Gibson</span>
                                <small class="grey-text">Digital Marketing</small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="auto-suggestion">
                <a class="collection-item" href="#">
                    <div class="display-flex">
                        <div class="display-flex align-item-center flex-grow-1">
                            <div class="avatar">
                                <img class="circle" src="{{ asset('/public/admin_assets/images/avatar/avatar-12.png') }}" width="30" alt="sample image">
                            </div>
                            <div class="member-info display-flex flex-column">
                                <span class="black-text">Anna Strong</span>
                                <small class="grey-text">Web Designer</small>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul> -->
     <!-- <ul class="display-none" id="page-search-title">
            <li class="auto-suggestion-title">
                <a class="collection-item" href="#">
                    <h6 class="search-title">PAGES</h6>
                </a>
            </li>
        </ul> -->
     <!-- <ul class="display-none" id="search-not-found">
            <li class="auto-suggestion">
                <a class="collection-item display-flex align-items-center" href="#">
                    <span class="material-icons">error_outline</span>
                    <span class="member-info">No results found.</span>
                </a>
            </li>
        </ul> -->
 </header>
 <!-- END: Header-->
 <script>
     $("#logoutbtn").click(function() {
         ("frmlogout").submit();
     });
 </script>
