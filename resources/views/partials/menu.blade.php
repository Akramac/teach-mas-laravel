<link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">

<!-- ======================== Navigation ======================== -->

<nav>

    <div class="clearfix">

        <a href="{{url('login')}}" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="Yahia-mas" width="30"/></a>

        <!-- Toast Container -->
        <div id="toast-container" aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
            <!-- Toasts will be injected here -->
        </div>

        <!-- ==========  Pre navigation ========== -->

        <div class="navigation navigation-pre clearfix">
            <!-- <div class="row">
                <div class="col-md-3">
                    <a href="#"><i class="icon icon-heart-pulse"></i> </a>
                </div>
                <div class="col-md-3">
                    <a href="#"><i class="icon icon-phone"></i> Contact us</a>
                </div>
                <div class="col-md-3">
                    <a href="#"></a>
                </div>
                <div class="col-md-3">
                    <a href="#"></a>
                </div>
            </div>
            -->

            <!-- Navigation Wrapper -->
            <header class="navbar-wrapper">
                <nav class="navbar">

                <!-- Center: Pill Menu -->
                <div class="nav-pill">
                    <a href="#" class="nav-link">Home</a>
                    <a href="#" class="nav-link">Exams</a>
                    <a href="#" class="nav-link">Corrections</a>
                </div>

                <!-- Right: Auth Actions Pill -->
                <div class="auth-pill">
                    <a href="#" class="auth-link login">Login</a>
                    <a href="#" class="auth-link signup">Sign up</a>
                    <a href="#" class="btn-primary">Logout</a>
                </div>
                </nav>

                <!-- Mega Dropdown Menu (Resources) -->
                <div class="mega-menu" id="resources-menu">
                <div class="mega-menu-inner">
                    
                    <!-- Column 1: Featured -->
                    <div class="menu-col col-featured">
                    <span class="col-label">Featured</span>
                    <a href="#" class="featured-card">
                        <div class="featured-img-box">
                        <div class="featured-overlay">
                            <p>Voiceflow named in Gartner’s Innovation Guide for AI Agents</p>
                        </div>
                        </div>
                        <h3 class="featured-title">Voiceflow named in Gartner’s Innovation Guide for AI Agents as a key AI Agent vendor for customer service</h3>
                        <span class="read-more">Read now <span class="arrow">&rsaquo;</span></span>
                    </a>
                    </div>

                    <!-- Column 2: Read -->
                    <div class="menu-col col-read">
                    <span class="col-label">Read</span>
                    
                    <a href="#" class="read-item">
                        <div class="read-thumb thumb-docs"></div>
                        <div class="read-content">
                        <h4>Docs</h4>
                        <p>Powerful documentation for designers and developers to learn Voiceflow.</p>
                        <span class="read-more">Read now <span class="arrow">&rsaquo;</span></span>
                        </div>
                    </a>

                    <div class="divider"></div>

                    <a href="#" class="read-item">
                        <div class="read-thumb thumb-stories"></div>
                        <div class="read-content">
                        <h4>Customer stories</h4>
                        <p>Build, launch, and scale AI agents for every customer channel — all in one...</p>
                        <span class="read-more">Read now <span class="arrow">&rsaquo;</span></span>
                        </div>
                    </a>
                    </div>

                    <!-- Column 3: Links -->
                    <div class="menu-col col-links">
                    <span class="col-label">Links</span>
                    <div class="links-grid">
                        <a href="#" class="icon-link">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
                        <span>Podcast</span>
                        <span class="ext-arrow">&#8599;</span>
                        </a>
                        <a href="#" class="icon-link">
                        <span>Community</span>
                        </a>
                        <a href="#" class="icon-link">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
                        <span>Webinars</span>
                        </a>
                        <a href="#" class="icon-link">
                        <span>Youtube</span>
                        <span class="ext-arrow">&#8599;</span>
                        </a>
                        <a href="#" class="icon-link">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <span>Stories</span>
                        </a>
                        <a href="#" class="icon-link">
                        <span>Changelog</span>
                        <span class="ext-arrow">&#8599;</span>
                        </a>
                    </div>
                    </div>

                </div>
                </div>
        </header>
        </div>



        <!-- ==========  Top navigation ========== -->

        <div class="navigation navigation-top clearfix">
            <ul>
                <!--add active class for current page-->
                <li class="left-side"><a href="index.html" class="logo-icon"><!--<img src="<?php /*echo base_url(); */?>assets/images/icon.png" alt="Alternate Text" /></a>--></li>
                <li class="left-side"><a href="{{url('register')}}?user=teacher"><img alt="teacher" src="{{asset('assets/images/teacher.png')}}" width="30" /></a></li>
                <!--

                    // Use active class for current state

                    <li class="left-side active"><a href="#">Man</a></li>

                -->
                <li class="left-side"><a href="{{url('register')}}?user=student"><img alt="student" src="{{asset('assets/images/57_Student.jpg')}}" width="30" /></a></li>
            <!--				<li class="left-side"><a href="<?php /*echo base_url(); */?>index.php/register?user=admin"><img alt="admin" src="<?php /*echo base_url(); */?>assets/images/58_Admin.jpg" width="30" /></a></li>
-->				<li><a href="javascript:void(0);" class="open-login"><i class="icon icon-user"></i></a></li>
                <li><a href="javascript:void(0);" class="open-search"><i class="icon-zoom-in"></i></a></li>
                <!--<li><a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span>4</span></a></li>-->
            </ul>
        </div>

        <!-- ==========  Main navigation ========== -->

        <div class="navigation navigation-main">
            <a href="#" class="open-login"><i class="icon icon-user"></i></a>
            <a href="#" class="open-search"><i class="icon icon-magnifier"></i></a>
            <!--			<a href="#" class="open-cart"><i class="icon icon-cart"></i> <span>4</span></a>
            -->			<a href="#" class="open-menu"><i class="icon icon-menu"></i></a>
            <div class="floating-menu">
                <!--mobile toggle menu trigger-->
                <div class="close-menu-wrapper">
                    <span class="close-menu"><i class="icon icon-cross"></i></span>
                </div>
                <ul>
                    <li>
                        <a href="#">Home <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul>
                                            <li class="" ><a href="index.php/index">Home</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#">Pages <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul>
                                            <li class="label">Exams</li>
                                            @if (Auth::check() && Auth::user()->hasRole('ROLE_ADMIN'))
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/teacher-exam') }}">Edit Home page</a></li>
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/teacher-exam') }}">Edit Footer</a></li>
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/teacher-exam') }}">Edit Whatsapp</a></li>
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/teacher-exam') }}">Edit Categories</a></li>
                                            @endif
                                            @if (Auth::check() && Auth::user()->hasRole('ROLE_TEACHER'))
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/teacherExam') }}">Add Exam</a></li>
                                                <li><a style="cursor: pointer;" href="{{ url('teacher/list/exam-by-teacher/' . Auth::user()->id) }}">List Exams</a></li>
                                            @endif
                                            @if (Auth::check() && Auth::user()->hasRole('ROLE_STUDENT'))
                                                <li><a style="cursor: pointer;" href="{{ url('student/list-exam') }}">List Exams</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!--<li>
                        <a href="#">Questions <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul>
                                            <li class="label">Questions</li>
                                            <li><a href="#">Q1</a></li>
                                            <li><a href="#">Q2</a></li>
                                            <li><a href="#">Q3</a></li>
                                            <li><a href="#">Q4</a></li>
                                            <li><a href="#">Q5</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>-->
                    <!--<li>
                        <a href="#">Reviews <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul>
                                            <li class="label">Blog pages</li>
                                            <li><a href="#">Blog grid</a></li>
                                            <li><a href="#">Blog list</a></li>
                                            <li><a href="#">Blog fullpage</a></li>
                                            <li><a href="#">Blog ideas</a></li>
                                            <li><a href="#">Article</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>-->

                    <!--<li class="nav-settings">
                        <a href="javascript:void(0);"><span class="nav-settings-value">USD</span> <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul class="nav-settings-list">
                                            <li><a href="javascript:void(0);">USD</a></li>
                                            <li><a href="javascript:void(0);">EUR</a></li>
                                            <li><a href="javascript:void(0);">GBP</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>-->
                    <li class="nav-settings">
                        <a href="javascript:void(0);"><span class="nav-settings-value">ENG</span> <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                        <div class="navbar-dropdown navbar-dropdown-single">
                            <div class="navbar-box">
                                <div class="box-full">
                                    <div class="box clearfix">
                                        <ul class="nav-settings-list">
                                            <li><a href="javascript:void(0);">ENG</a></li>
                                            <li><a href="javascript:void(0);">لعربية</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- ==========  Search wrapper ========== -->

        <div class="search-wrapper">
            <input class="form-control" placeholder="Search..." />
            <button class="btn btn-main">Go!</button>
        </div>

        <!-- ==========  Login wrapper ========== -->

        <div class="login-wrapper">
            <div class="h4">Sign in</div>
            <form method="post" action="index.php/login/validation">
                <div class="form-group">
                    <input type="email" name="user_email" class="form-control" value="" id="exampleInputEmail1" placeholder="Email">
                    <span class="text-danger" style="color:red;"></span>
                </div>
                <div class="form-group">
                    <input type="password" name="user_password"  class="form-control" id="exampleInputPassword1" value="" placeholder="Password">
                    <span class="text-danger" style="color:red;"></span>
                </div>
                <div class="form-group">
                    <a href="#forgotpassword" class="open-popup">Forgot password?</a>
                    <a href="#createaccount" class="open-popup">Don't have an account?</a>
                </div>
                <button type="submit" class="btn btn-block btn-main">Submit</button>
            </form>
        </div>
        <div class="login-wrapper card-profile ">
            <div class="background"></div>

            <div class="outer-div">
                <div class="inner-div">
                    <div class="front">
                        <div class="front__bkg-photo"></div>
                        <div class="front__face-photo"  ><img src="{{ asset('storage/uploads/' . Auth::user()?->image) }}" style="width:100%"/></div>
                        <div class="front__text">
                            <h3 class="front__text-header">{{Auth::user()->name ?? 'Guest'}}</h3>
                            <p class="front__text-para"><i class="fas fa-map-marker-alt front-icons"></i></p>

                            <span class="front__text-hover">{{Auth::user()->levelName ?? 'Role Guest'}}</span>
                        </div>
                    </div>
                    <div class="back">
                        <div class="social-media-wrapper">
                            <a href="{{url('changePassword')}}" class="social-icon" style="color:black;"><i class="fa fa-key" aria-hidden="true"></i>Change password</a>
                            <a href="{{url('editProfile')}}" class="social-icon" style="color:black;"><i class="fa fa-cog" aria-hidden="true"></i>Edit profile</a>
                            <a href="{{url('logout')}}" class="social-icon" style="color:black;"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    <!-- ==========  Cart wrapper ========== -->

        <div class="cart-wrapper">
            <div class="checkout">
                <div class="clearfix">

                    <!--cart item-->

                    <div class="row">

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="{{asset('assets/images/product-1.png')}}" alt="" /></a>
                            </div>
                            <div class="title">
                                <div><a href="product.html">Product item</a></div>
                                <small>Product category</small>
                            </div>
                            <div class="quantity">
                                <input type="number" value="2" class="form-control form-quantity" />
                            </div>
                            <div class="price">
                                <span class="final">$ 1.998</span>
                                <span class="discount">$ 2.666</span>
                            </div>
                            <!--delete-this-item-->
                            <span class="icon icon-cross icon-delete"></span>
                        </div>

                        <!--cart item-->

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="{{asset('assets/images/product-2.png')}}" alt="" /></a>
                            </div>
                            <div class="title">
                                <div><a href="product.html">Product item</a></div>
                                <small>Product category</small>
                            </div>
                            <div class="quantity">
                                <input type="number" value="2" class="form-control form-quantity" />
                            </div>
                            <div class="price">
                                <span class="final">$ 1.998</span>
                                <span class="discount">$ 2.666</span>
                            </div>
                            <!--delete-this-item-->
                            <span class="icon icon-cross icon-delete"></span>
                        </div>

                        <!--cart item-->

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="{{asset('assets/images/product-3.png')}}" alt="" /></a>
                            </div>
                            <div class="title">
                                <div><a href="product.html">Product item</a></div>
                                <small>Product category</small>
                            </div>
                            <div class="quantity">
                                <input type="number" value="2" class="form-control form-quantity" />
                            </div>
                            <div class="price">
                                <span class="final">$ 1.998</span>
                                <span class="discount">$ 2.666</span>
                            </div>
                            <!--delete-this-item-->
                            <span class="icon icon-cross icon-delete"></span>
                        </div>

                        <!--cart item-->

                        <div class="cart-block cart-block-item clearfix">
                            <div class="image">
                                <a href="product.html"><img src="{{asset('assets/images/product-4.png')}}" alt="" /></a>
                            </div>
                            <div class="title">
                                <div><a href="product.html">Product item</a></div>
                                <small>Product category</small>
                            </div>
                            <div class="quantity">
                                <input type="number" value="2" class="form-control form-quantity" />
                            </div>
                            <div class="price">
                                <span class="final">$ 1.998</span>
                                <span class="discount">$ 2.666</span>
                            </div>
                            <!--delete-this-item-->
                            <span class="icon icon-cross icon-delete"></span>
                        </div>
                    </div>

                    <hr />

                    <!--cart prices -->

                    <div class="clearfix">
                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Discount 15%</strong>
                            </div>
                            <div>
                                <span>$ 159,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Shipping</strong>
                            </div>
                            <div>
                                <span>$ 30,00</span>
                            </div>
                        </div>

                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>VAT</strong>
                            </div>
                            <div>
                                <span>$ 59,00</span>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <!--cart final price -->

                    <div class="clearfix">
                        <div class="cart-block cart-block-footer clearfix">
                            <div>
                                <strong>Total</strong>
                            </div>
                            <div>
                                <div class="h4 title">$ 1259,00</div>
                            </div>
                        </div>
                    </div>


                    <!--cart navigation -->

                    <div class="cart-block-buttons clearfix">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="products-grid.html" class="btn btn-clean-dark">Continue shopping</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="checkout-1.html" class="btn btn-main"><span class="icon icon-cart"></span> Checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

