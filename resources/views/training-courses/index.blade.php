@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Training Course List&nbsp;&nbsp;
                    <a href="{{url('/training-course/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($training_courses as $cou)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{asset('ads'.'/'.$cou->photo)}}" width="65"></td>
                                    <td>{{$cou->url}}</td>
                                    <td>{{$cou->order_number}}</td>
                                    <td>
                                        <a href="{{url('/training-course/edit/'.$cou->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('/training-course/delete/'.$cou->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
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