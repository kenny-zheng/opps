@extends('layouts.app2')

@php
if ($accountpage=="admin") {
    $accountType=3;
}
if ($accountpage=="teacher") {
    $accountType=2;
}
if ($accountpage=="student") {
    $accountType=1;
}
$update_info = Session::get('update_info');
Session::put('accountType',$accountType);
$results = DB::select("select * from users where type=$accountType");
@endphp

@section('nav')
<li class="nav-item ">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item dropdown active">
    <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
        <span>Account</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <h6 class="dropdown-header">Account Type :</h6>
        <a class="dropdown-item" href="/account/student">Students<span class="sr-only">(current)</span></a>
        <a class="dropdown-item" href="/account/teacher">Teachers<span class="sr-only">(current)</span></a>
        <a class="dropdown-item" href="/account/admin">Admin<span class="sr-only">(current)</span></a>
    </div>
</li>
@endsection

@section('breadcrumbs')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="/account/{{$accountpage}}">{{$accountpage}} account</a>
    </li>
</ol>

@if (Session::has('update_info'))

<div class="alert alert-success" role="alert">
    {{ $update_info }}
</div>

@endif
@endsection

@section('content')
<table id="example" class="table table-striped table-bordered myTable" style="width:100%">
    <thead>
        <tr>
            <th scope="col">username</th>
            <th scope="col">password</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">Project ID</th>
            <th scope="col">menu</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($results as $item)
    <tr>
                <td>{{$item->username}}</td>
                <td>{{$item->password}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                @if ($accountType==1&($item->project_id!==NULL))
                <td>{{$item->project_id}}</td>
                @else
               <td>no project</td>
                @endif

                <td>
                    @if ( ($item->project_id==NULL)&$accountType==1 )

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#stAcc{{$item->username}}" disabled>

                        Change

                    </button>
                    @else
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stAcc{{$item->username}}">
                        Change
                    </button>
                    @endif
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
@foreach ($results as $item)
<!-- Modal -->
{{ Form::open(array('url' => url('/update/account'), 'class'=>'form-signin text-center')) }}
<div class="modal fade" id="stAcc{{$item->username}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">type</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="acctype">
                        <option selected value={{$item->type}}>{{$accountpage}}</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">username</span>
                    </div>
                    <input type="text" class="form-control" placeholder="enter username" aria-label="Username" aria-describedby="basic-addon1" value="{{$item->username}}" name="username" readonly>

                </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">password</span>
                        </div>
                        <input type="text" class="form-control" placeholder="enter passwrd" aria-label="Username" aria-describedby="basic-addon1" value="{{$item->password}}" name="password">
                    </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">name</span>
                            </div>
                            <input type="text" class="form-control" placeholder="enter name" aria-label="Username" aria-describedby="basic-addon1" value="{{$item->name}}" name="name">
                        </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">email</span>
                                </div>
                                <input type="email" class="form-control" placeholder="enter email" aria-label="Username" aria-describedby="basic-addon1" value="{{$item->email}}" name="email">
                            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
{{ Form::close() }}
@endforeach
@endsection


