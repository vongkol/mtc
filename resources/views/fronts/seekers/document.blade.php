@extends('layouts.seeker')
@section('content')
<div class="page-title">{{trans("labels.my_attached_document")}}&nbsp;&nbsp;
    <a href="{{url('/seeker/document/create')}}" class="btn btn-primary btn-xs">{{trans('labels.upload_new_document')}}</a>
</div>
<div class="border">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>&numero;</th>
                <th>{{trans('labels.file_name')}}</th>
                <th>{{trans('labels.description')}}</th>
                <th>{{trans('labels.action')}}</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1;?>
            @foreach($documents as $doc)
                <tr id="{{$doc->id}}">
                    <td>{{$i++}}</td>
                    <td><a href="{{asset('uploads/docs/'.$doc->name)}}" target="_blank">{{$doc->name}}</a></td>
                    <td>{{$doc->description}}</td>
                    <td><a class="btn btn-sm btn-danger" href="{{url('/seeker/document/delete/'.$doc->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
