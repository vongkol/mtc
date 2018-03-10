<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Master Jobs Cambodia</title>
        <script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
        <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('front/css/4-col-portfolio.css')}}" rel="stylesheet">
        <style>
            ul#menu_top li.nav-item{
                font-size: 17px;
            }
            div.search-job
            {
                padding: 3px 2px;
            }
        </style>
    </head>
    <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
        <?php $logo = DB::table('logos')->first(); ?>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('img/'.$logo->photo)}}" alt="logo" width="54" title="{{$logo->name}}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav" id="menu_top">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/')}}">{{trans("labels.home")}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('page/2')}}">{{trans("labels.about_us")}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('page/3')}}">{{trans("labels.training")}}</a>
                </li>
                {{--  <li class="nav-item">
                    <a class="nav-link" href="{{url('page/4')}}">{{trans("labels.recruitment")}}</a>
                </li>  --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{url('seeker/login')}}">{{trans("labels.job_seeker")}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('employer/login')}}">{{trans("labels.employer")}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="chLang(event,'km')"><img src="{{asset('front/img/kh.png')}}" width="20"> Khmer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="chLang(event,'en')"><img src="{{asset('front/img/en.png')}}" width="20"> English</a>

                </li>
                @if(Session::has('seeker'))
                    <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" href="{{url('seeker/profile')}}" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, {{session('seeker')->first_name}}</a>
                        <div class="dropdown-menu " style="font-size: 13px;" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="{{url('seeker')}}">My Profile</a>
                            <a class="dropdown-item" href="{{url('seeker/cv')}}">My Resume</a>
                            <a class="dropdown-item" href="{{url('seeker/document')}}">My Document</a>
                            <a class="dropdown-item" href="{{url('seeker/reset-password')}}">Change Password</a>
                            <a class="dropdown-item text-danger" href="{{url('/seeker/logout')}}">Logout</a>
                        </div>
                    </li>
                @endif
            </ul>
           
            </div>
        </div>
    </nav>
    <?php 
        $slides = DB::table('slides')->orderBy('order', 'asc')->where('active',1)->get();
        $i = 1;
    ?>
    <div class="container-fluit">   
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach ($slides as $sli)
                @if($i == 1)
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="{{asset('img/'.$sli->photo)}}" alt="slide" width="100%">
                    </div>
                @else 
                    <div class="carousel-item">
                        <img class="d-block img-fluid" src="{{asset('img/'.$sli->photo)}}" alt="slide" width="100%">
                    </div>
                @endif
                <?php $i++;?>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container">
    <div class="search-job"> 
        <form action="{{url('/job/search')}}" method="get" class="form-hozintal">
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Keyword, Position, Location..." aria-label="Keyword, Position, Location..." aria-describedby="basic-addon2" name="q" id="q">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">{{trans('labels.search')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div><br>

    <div class="container">
        <p></p>
        @yield('content')     
    </div>
    
    <div class="container">
        <h5>Cooperated Companies</h5> 
        <?php  
        $partners = DB::table('partners')
            ->orderBy('sequence', "asc")
            ->where('active',1)
            ->get();
        $companies = DB::table('companies')
            ->join('employers', 'companies.employer_id', '=', 'employers.id')
            ->where('companies.active', 1)
            ->select('companies.*', 'employers.first_name', 'employers.last_name')
            ->get();
        ?>    
        <div class="col-md-12 b">
            <div class="row">
                @foreach($companies as $com)
                    <div class="col-md-2 col-sm-2" align="center">
                        <div  class="border-com">
                            <a href="{{$com->website}}" target="_blank">
                                <img src="{{asset('company/'.$com->logo)}}" class="img-height">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><br>
        <h5>Recruitment Agencies</h5>     
        <center>
        <div class="col-md-12 b">
            <div class="row">
                @foreach($partners as $par)
                    <div class="col-md-1 col-sm-2 col-12 col-md-1-custom" align="center">
                        <div  class="border-com">
                            <a href="{{$par->url}}" target="_blank">
                                <img src="{{asset('partners/'.$par->logo)}}" class="img-height">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div><br>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="bg-default">
    <div class="container">
       <div class="col-md-12">
           <div class="row">
               <div class="col-md-4">
                   <h5>Contact Us</h5>
                   <?php  
                        $contact_us = DB::table('pages')
                            ->where('id', 1)
                            ->where('active', 1)
                            ->first();
                    ?>
                   <aside>{!!$contact_us->description!!} </aside> 
               </div>
               <div class="col-md-4">
                   <h5> Our Services</h5>
                   <aside>- Consultant and Announcement</aside> 
                   <aside>- Assisting Company Recruitment </aside> 
                  <aside>- Provide AML and Skill Traing </aside> 
               </div>
               <div class="col-md-4">
                   <h5> Socail Network</h5>
                   <aside>- Master Jobs Cambodia </aside> 
                   <aside>- Master Training Cambodia </aside> 
                   <aside>-  HR Traing Cambodia</aside> 
               </div>
           </div>
       </div>
    </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('front/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    <script>
        function chLang(evt, ln)
        {
            evt.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{url('/')}}" + "/language/" + ln,
                success: function(sms){
                    if(sms>0)
                    {
                        location.reload();
                    }
                }
            });
        }
    </script>
  </body>
</html>
