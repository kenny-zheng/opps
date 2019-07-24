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
    $checkStatus = DB::select("select * from project where project_id='$pid'");
    foreach ($checkStatus as  $value) {
        $status=$value->status;
    }
    $pjInfo = DB::select("select * from project where project_id='$pid'");
foreach ($pjInfo as $key => $value) {
    $pjName=$value->name;
    $ins=$value->instructor;
}
@endphp
<div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="/myproject/view">Status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/myproject/history">Upload History</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
        @if ($status==0)
        <h5 class="card-title">Not Uplaod !</h5>
        <p class="card-text">Pleasw go to upload page</p>
        <a href="/myproject/upload" class="btn btn-primary">Upload</a>

        @else
        <h5 class="card-title text-success">Success</h5>
        <p class="card-text">Pleasw wait teacher comment</p>
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
            <div class="card mb-3">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">jpg</h5>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>

                    <img src="/{{$pid}}/{{$pid}}.jpg" class="card-img-top" alt="...">
                  </div>
        @endif

    </div>
  </div>
@endsection
