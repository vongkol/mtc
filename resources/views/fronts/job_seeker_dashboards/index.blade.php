@extends('layouts.front')
@section('slider')
    <section>
        <!-- Carousel -->
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel-inner -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{asset('front/images/slider_img.png')}}" alt="Construction">
                    <div class="overlay">
                        <div class="carousel-caption">
                            <h2>The Easiest Way to Get Your New Job</h2>
                            <h4>We Offer 2033 job Vocation Right Now</h4><br><br>
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="input-group">
                                    <input
                                            type="text"
                                            class="form-control search_job border-radius-none"
                                            name="x"
                                            placeholder="Keyword, Postion, Company Name..."
                                    >
                                    <div class="input-group-btn search-panel">
                                        <button
                                                type="button"
                                                class="btn btn-default dropdown-toggle border-radius-none"
                                                data-toggle="dropdown"
                                        >
                                            <span id="search_concept">Job Location</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu border-radius-none" role="menu">
                                            <li><a href="#">Phnom Phen</a></li>
                                            <li><a href="#">Siem Reap</a></li>
                                            <li><a href="#">Kampot</a></li>
                                            <li><a href="#">Battambong</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#all">All Location</a></li>
                                        </ul>
                                    </div>
                                    <span class="input-group-btn">
                                            <button class="btn btn-warning border-radius-none" type="button">Search</button>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Carousel-inner end -->
        </div><!-- Carousel end-->
    </section>
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('front/css/job-seeker-dashboard.css')}}">
 <section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3 col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="orange bold">Manage Account</span>
                        </div>
                        <div class="panel-body">
                            <p><a href="">My Resume</a></p>
                            <p><a href="">Bookmarked Jobs</a></p>
                            <p><a href="">Notifications</a></p>
                            <hr>
                            <p><a href="">Manage Job</a></p>
                            <p><a href=""><span class="orange">Manage Applications</span></a></p>
                            <p><a href="">Job Alerts</a></p>
                            <hr>
                            <p><a href="">Change Password</a></p>
                            <p><a href="">Sing Out</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="orange bold"><span class="orange">Manage Account - Manage Applications</span></span>
                        </div>
                        <div class="panel-body">
                            <div class="applications-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thums">
                                            <img src="{{asset('front/images/vdoo.png')}}">
                                        </div>
                                        <h6><span class="orange">Web Designer</span></h6>
                                        <small>Quick Studio</small>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <span class="label label-success">Full Time</span>
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <small>Nov 14th, 2017</small>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><span class="text-danger bold">Rejected</span></p>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thums">
                                            <img src="{{asset('front/images/vdoo.png')}}">
                                        </div>
                                        <h6><span class="orange">Web Designer</span></h6>
                                        <small>Quick Studio</small>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <span class="label label-success">Full Time</span>
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        <small>Nov 14th, 2017</small>
                                    </div>
                                    <div class="col-sm-2">
                                        <p><span class="text-danger bold">Rejected</span></p>
                                    </div>
                                </div><hr>
                                <div class="applications-content">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="thums">
                                                <img src="{{asset('front/images/vdoo.png')}}">
                                            </div>
                                            <h6><span class="orange">Web Designer</span></h6>
                                            <small>Quick Studio</small>
                                        </div>
                                        <div class="col-md-3">
                                            <p>
                                                <span class="label label-success">Full Time</span>
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <small>Nov 14th, 2017</small>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><span class="orange bold">Process</span></p>
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="applications-content">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="thums">
                                                <img src="{{asset('front/images/vdoo.png')}}">
                                            </div>
                                            <h6><span class="orange">Web Designer</span></h6>
                                            <small>Quick Studio</small>
                                        </div>
                                        <div class="col-md-3">
                                            <p>
                                                <span class="label label-success">Full Time</span>
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <small>Nov 14th, 2017</small>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><span class="orange bold">Process</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customer')
    <div class="container">
        <div class="row">
            <div class="well-custom text-center bold orange our-partner">
                OUR PARTNERS
            </div>
            <div class="slide-partner-img">
                <div id="carousel0"  class="owl-carousel owl-theme">
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                    <div class="item text-center">
                        <img src="{{asset('front/images/vdoo.png')}}" alt="Disney" class="img-responsive" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container well-custom">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>
                <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>
                <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>
                 <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>
                 <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>
                <div class="col-md-2 col-sm-2 padding-top-and-button">
                     <img src="{{asset('front/images/adversitment.png')}}">
                </div>  
            </div>

        </div>
    </section>
@endsection