@extends('layouts.app2')

@section('nav')
<li class="nav-item ">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
<li class="nav-item dropdown active">
        <a class="nav-link " href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Project</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Action :</h6>
            <a class="dropdown-item" href="/myproject/view">My Project<span class="sr-only">(current)</span></a>
            <a class="dropdown-item" href="/myproject/upload">Upload<span class="sr-only">(current)</span></a>
        </div>
    </li>
@endsection

@section('breadcrumbs')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/myproject/{{$action}}">{{$action}} project</a>
    </li>
</ol>
@endsection

@section('content')
@php
$userInfo = Session::get('user');
$pjInfo = DB::select("select * from project where project_id='$pid'");
foreach ($pjInfo as $key => $value) {
    $pjName=$value->name;
    $ins=$value->instructor;
}
@endphp
{{ Form::open(array('url' => url('/upload'), 'class'=>'form-signin text-center','files' => true)) }}
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Project ID</span>
    </div>
    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{$pid}}" readonly name="pid">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Project Name</span>
    </div>
    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{$pjName}}" readonly name="pjName">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Instructor</span>
    </div>
    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{$ins}}" readonly name="pjName">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload PDF</span>
    </div>

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="pdfFile">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFileAddon01">Upload JPG</span>
    </div>

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="jpgFile">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
</div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <script type="text/javascript">
        $('.custom-file input').change(function (e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
                }
                $(this).next('.custom-file-label').html(files.join(', '));
                });
        </script>
      {{ Form::close() }}
      @endsection
