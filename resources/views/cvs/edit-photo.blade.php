@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Upload Photo&nbsp;&nbsp;
                    <a href="{{url('/cvlist/detail/'.$cv->id)}}" class="btn btn-link btn-sm">Back To CV</a>
                </div>
                <div class="card-block">
                    <form action="{{url('/cvlist/uploadphoto')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="cv_id" value="{{$cv->id}}">
                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="photo" class="control-label col-sm-3">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="photo" name="photo" onchange="loadFile(event)">
                                        <img src="{{asset('uploads/photo/'.$employee->profile_photo)}}" style="width: 72px;" alt="Photo" id="preview">
                                        <br>
                                        <br>
                                        <button type="submit" name="uploadPhoto" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
     function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
</script>
@endsection