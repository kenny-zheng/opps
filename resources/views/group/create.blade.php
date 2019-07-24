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
          <a class="dropdown-item" href="/project/create">create<span class="sr-only">(current)</span></a></li>

@endsection
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard/">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/project/{{$accountpage}}">{{$accountpage}} project</a>
        </li>
    </ol>
    @endsection

    @section('content')
    {{ Form::open(array('url' => url('/create/project'), 'class'=>'form-signin text-center')) }}
    @php
    date_default_timezone_set("Asia/Taipei");
        $nowtime=date("YmdHis");
        $results = DB::select("select * from users where type=1 and project_id is NULL");
        $instructor = DB::select("select * from users where type=2");
    @endphp

            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Project ID</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="{{$nowtime}}" readonly name="pid">
                  </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Project Name</span>
                    </div>
                    <input type="text" class="form-control" placeholder="please enter project name" aria-label="Username" aria-describedby="basic-addon1" name="pname" required>
                  </div>

                  <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Instructor</span>
                        </div>

                        <select class="js-example-basic-multiple form-control ins" multiple="multiple" name="instructor" id="ins" >
                                @foreach ($instructor as $item)
                                  <option value="{{$item->username}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
                              </div>

                  <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Member</span>
                        </div>

                                <select class=" js-example-basic-multiple form-control" name="member[]" multiple="multiple" required>

                                        @foreach ($results as $item)

                                        <option value="{{ $item->username }}">{{ $item->username }}-{{ $item->name }}</option>
                                        @endforeach
                                      </select>
                              </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            {{ Form::close() }}
    @endsection

