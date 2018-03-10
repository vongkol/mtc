@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Recruitment Agency List&nbsp;&nbsp;
                    <a href="{{url('/partner/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>logo</th>
                                <th>URL</th>
                                <th>Order &numero;</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($partners as $par)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$par->name}}</td>
                                    <td>{{$par->type}}</td>
                                    <td>{{$par->address}}</td>
                                    <td>{{$par->contact}}</td>
                                    <td><img src="{{URL::asset('partners/').'/'.$par->logo}}" width="65"/></td>
                                    <td>{{$par->url}}</td>
                                    <td>{{$par->sequence}}</td>
                                    <td>
                                        <a href="{{url('/partner/edit/'.$par->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('/partner/delete/'.$par->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection