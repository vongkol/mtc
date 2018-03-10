<?php $lang = Auth::user()->language=="kh"?'kh.php':'en.php'; ?>
<?php include(app_path()."/lang/". $lang); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="School Management System">
    <meta name="author" content="vdoo.biz">
    <meta name="keyword" content="School, Student, Student Management System, School Management System">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Job Website Admin</title>

    <!-- Icons -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <script>
        var burl = "{{url('/')}}";
        var asset = "{{asset('img')}}";
    </script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>
            <li class="nav-item px-3 text-primary">
                <img src="{{asset('img/flags/UK.png')}}" alt="" width="32">
            </li>
            {{--  <li class="nav-item px-3 text-gray-dark">Branch</li>  --}}

        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('profile/'.Auth::user()->photo)}}" class="img-avatar" alt="">
                    <span class="d-md-down-none text-info">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-center">
                        <strong>{{$lb_account}}</strong>
                    </div>

                    <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user text-primary"></i> {{$lb_profile}}</a>
                    <a class="dropdown-item" href="{{url('/user/reset-password')}}"><i class="fa fa-key text-success"></i> {{$lb_reset_password}}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out text-danger"></i> {{$lb_logout}}</a>
                </div>
            </li>
            <li class="nav-item d-md-down-none">
            </li>

        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>
    </header>
    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/home')}}"><i class="fa fa-tachometer text-primary"></i> {{$lb_dashboard}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/mail')}}"><i class="fa fa-envelope text-success"></i> Mail Marketing</a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-dollar text-danger"></i> Subscription</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{url('/subscription')}}" class="nav-link"><i class="fa fa-list text-yellow"></i> List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/subscription/expire')}}" class="nav-link"><i class="fa fa-calendar-times-o text-success"></i> Expire</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/employee')}}">
                            <i class="fa fa-user-secret"></i>Employee
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/provider')}}">
                            <i class="fa fa-user-secret text-warning"></i>Employer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/joblist')}}">
                            <i class="fa fa-list text-danger"></i> Job List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/cvlist')}}">
                            <i class="fa fa-file-text text-info"></i> CV List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/success-candidate')}}">
                            <i class="fa fa-trophy text-warning"></i> Success Candidate
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/com')}}">
                            <i class="fa fa-building text-success"></i>Cooperated Company
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/partner')}}">
                            <i class="fa fa-handshake-o"></i>Recruitment Agency
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/training-course')}}">
                            <i class="fa fa-graduation-cap"></i> Training Course
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/video-training')}}">
                            <i class="fa fa-youtube"></i> Video Training
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/page')}}">
                            <i class="fa fa-columns"></i> Page
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/package')}}">
                            <i class="fa fa-th text-info"></i> Package
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/employee-email')}}">
                        <i class="fa fa-envelope"></i> Employee Email
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/employer-email')}}">
                            <i class="fa fa-envelope-o"></i> Employer Email
                        </a>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-key text-danger"></i> {{$lb_security}}</a>
                            <ul class="nav-dropdown-items">
                                <li class="nav-item">
                                    <a href="{{url('/user')}}" class="nav-link"><i class="fa fa-user text-yellow"></i> {{$lb_user}}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('/role')}}" class="nav-link"><i class="fa fa-shield text-info"></i> {{$lb_role}}</a>
                                </li>
                            </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa fa-cog text-success"></i> {{$lb_setting}}</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/category')}}">
                                    <i class="fa fa-tags"></i>Category
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/job_type')}}">
                                    <i class="fa fa-users"></i>Job Type
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/package_type')}}">
                                    <i class="fa fa-th"></i>Package Type
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/location')}}">
                                    <i class="fa fa-map-marker"></i>Location
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{url('/social')}}">
                                    <i class="fa fa-facebook"></i>Social
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/header_top_contact')}}">
                                    <i class="fa fa-volume-control-phone"></i>Header Top Contact
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/slide')}}">
                                    <i class="fa fa-picture-o"></i>Slide
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/logo')}}">
                                    <i class="fa fa-first-order"></i>Logo
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Main content -->
        <main class="main">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>

            </div>
        </main>
    </div>

    <footer class="app-footer">
        Copy &copy; {{date('Y')}} by <a href="#">Master Jobs Cambodia</a>
        <span class="float-right">Powered by <a href="http://vdoo.biz" target="_blank">Vdoo Solutions Co., Ltd</a>
        </span>
    </footer>
    <!-- Scripts -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('bower_components/pace/pace.min.js')}}"></script>
<!-- Plugins and scripts required by all views -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/app1.js') }}"></script>
    @yield('js')
</body>
</html>
