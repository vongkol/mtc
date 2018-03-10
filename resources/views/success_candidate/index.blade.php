@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Success Candidate List&nbsp;&nbsp;
                    <a href="{{url('/success-candidate/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($success_candidates as $emp)
                            <tr>
                                <td>{{$emp->cadidate_id}}</td>
                                <td>{{$emp->first_name}}</td>
                                <td>{{$emp->last_name}}</td>
                                <td>{{$emp->phone}}</td>
                                <td>{{$emp->email}}</td>
                                <td>
                                    <a href="{{url('/success-candidate/edit/'.$emp->cadidate_id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/success-candidate/delete/'.$emp->cadidate_id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{ $success_candidates->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection