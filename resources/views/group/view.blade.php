@extends('layouts.app2')
@section('nav')
<li class="nav-item ">
        <a class="nav-link" href="/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown active">
            <a class="nav-link" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i>
              <span>Project</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <h6 class="dropdown-header">Action :</h6>
              <a class="dropdown-item" href="/project/view">view<span class="sr-only">(current)</span></a>
          <a class="dropdown-item" href="/project/create">create<span class="sr-only">(current)</span></a>
        </li>

@endsection
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/project/{{$accountpage}}">{{$accountpage}} project</a>
        </li>
    </ol>
    @endsection
@section('content')
@php
$results = DB::select("select * from project");
@endphp
<table id="example" class="table table-striped table-bordered myTable" style="width:100%">
    <thead>
        <tr>
            <th scope="col">project ID</th>
            <th scope="col">name</th>
            <th scope="col">final grade</th>
            <th scope="col">member</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($results as $item)
        <tr>
            <td>{{$item->project_id}}</td>
            <td>{{$item->name}}</td>
            @if (($item->final_grade==NULL))
            <td>no grade</td>
            @else
            <td>{{$item->final_grade}}</td>
            @endif
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#M{{$item->project_id}}">
                   show
                  </button>
            </td>

        </tr>

        @endforeach
        @foreach ($results as $item)
        @php
            $member = DB::select("select * from users where project_id=$item->project_id");
        @endphp
        <div class="modal fade" id="M{{$item->project_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Member</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary">{{$item->instructor}}</li>
                        @foreach ($member as $item)
                             <li class="list-group-item list-group-item-secondary">{{$item->username}}</li>
                        @endforeach

                      </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    </tbody>
</table>
@endsection
