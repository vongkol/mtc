@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Subscription List&nbsp;&nbsp;
                    <a href="{{url('/subscription/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <form action="{{url('/subscription/expire')}}" method="get">
                        From: <input type="text" name="from" id="from" value="{{$from}}"> To: <input type="text" name="to" id="to" value="{{$to}}"> <input type="submit" value="Search">
                    </form>
                    <br><br>
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <th>Days</th>
                            <th>Jobs</th>
                            <th>Expired Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $sub)
                            <tr {{$sub->expired_date<=date('Y-m-d')?"class=red":''}}>
                                <td>{{$sub->id}}</td>
                                <td>{{$sub->first_name . ' ' . $sub->last_name}}</td>
                                <td>{{$sub->email}}</td>
                                <td>{{$sub->phone}}</td>
                                <td>{{$sub->name}}</td>
                                <td>$ {{$sub->price}}</td>
                                <td>{{$sub->day_number}}</td>
                                <td>{{$sub->job_number}}</td>
                                <td>{{$sub->expired_date}}</td>
                                <td><a href="{{url('/subscription/detail/'.$sub->id)}}">{!!$sub->status==0?'<span class=\'text-danger\'>Pending</span>':'Approved'!!}</a></td>
                                <td>
                                    <a href="{{url('/subscription/edit/'.$sub->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/subscription/delete/'.$sub->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('js')
    <script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#from").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $("#to").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
@endsection