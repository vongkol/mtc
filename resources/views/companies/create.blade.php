@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Cooperated Company&nbsp;&nbsp;
                    <a href="{{url('/com')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif

                    <form action="{{url('/com/save')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="employer_id" class="control-label col-lg-2 col-sm-3">
                                Employer ID <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" required autofocus name="employer_id" id="employer_id" class="form-control" value="{{old('employer_id')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-2 col-sm-2">
                                Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_person" class="control-label col-lg-2 col-sm-2">Contact Person</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{old('contact_person')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-lg-2 col-sm-2">Email</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-lg-2 col-sm-2">Phone</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="control-label col-lg-2 col-sm-2">Address</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="website" class="control-label col-lg-2 col-sm-2">Website</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="text" name="website" id="website" class="form-control" value="{{old('website')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="control-label col-lg-2 col-sm-2">Logo</label>
                            <div class="col-lg-4 col-sm-8">
                                <input type="file" name="logo" id="logo" class="form-control" onchange="loadFile(event)">
                                <img src="" alt="" id="img" width="150">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset" onclick="clearLogo()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('img');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        function clearLogo() {
            var output = document.getElementById('img');
            output.src = "";
        }
    </script>
@endsection