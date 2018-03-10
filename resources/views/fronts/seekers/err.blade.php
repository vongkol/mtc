@extends('layouts.front')
@section('content')
        <div class="row">
            <div class="col-md-12">
                    <div class="page-title">Recovery Password</div>
                        <h5 class="text-center text-danger">
                                We are sorry, the mail service is not available!
                                <br>
                                Make sure you have published your website to hosting server correctly.
                        </h5>
                        <p class="text-center">
                            <a href="{{url('/')}}" class="btn btn-primary border-radius-none">Back Home</a>
                        </p>
                </div>
            </div>
        </div>
@endsection