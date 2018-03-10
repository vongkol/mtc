@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Employer&nbsp;&nbsp;
                    <a href="{{url('/provider')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    <form action="{{url('/provider/save')}}" 
                        class="form-horizontal" 
                        method="post" 
                        id="form_provider"
                        onsubmit="check(event)"
                    >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="first_name" class="control-label col-lg-2 col-sm-2">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    required 
                                    autofocus 
                                    name="first_name" 
                                    id="first_name" 
                                    class="form-control"
                                    value="{{ old('first_name') }}" 
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="control-label col-lg-2 col-sm-2">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    required 
                                    name="last_name" 
                                    id="last_name" 
                                    class="form-control"
                                    value="{{ old('last_name') }}" 
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-lg-2 col-sm-2">Gender<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <select class="form-control" name="gender" id="gender"  id="exampleSelect1">
                                    <option value="Male">Male</option> 
                                    <option value="Female">Female</option>                
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="control-label col-lg-2 col-sm-2">
                                Date of Birth
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    name="dob" 
                                    id="dob" 
                                    class="form-control"
                                    value="{{ old('dob') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-lg-2 col-sm-2">
                                Phone<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    name="phone" 
                                    id="phone" 
                                    required 
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-lg-2 col-sm-2">
                                Email<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    required 
                                    class="form-control"
                                    value="{{ old('email') }}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="control-label col-lg-2 col-sm-2">
                                Username<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="text" 
                                    name="username" 
                                    id="username" 
                                    required 
                                    class="form-control"
                                    value="{{old('username')}}" 
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-lg-2 col-sm-2">
                                Password<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    required 
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="control-label col-lg-2 col-sm-2">
                                Confirm Password<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input 
                                    type="password" 
                                    name="confirm_password" 
                                    id="confirm_password" 
                                    required 
                                    class="form-control"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script charset="utf-8" type="text/javascript">
    function check(event)
    {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if( password != confirm_password) {
            document.getElementById("confirm_password").style.border="1px solid red";
            event.preventDefault();
        } 

        if( password === confirm_password){
            document.getElementById("form_provider").submit();
        }
    }
</script>
@endsection