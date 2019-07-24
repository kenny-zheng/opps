@extends('layouts.app1')
@yield('nav')
<link rel="stylesheet" href="login.css">
@php

@endphp
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" >
{{ Form::open(array('url' => url('/auth'), 'class'=>'form-signin text-center')) }}
@if (Session::has('loginFail'))
@php
 $errormessage = Session::get('loginFail');
@endphp

 <div class="alert alert-danger" role="alert">
        @php
            echo $errormessage;
        @endphp
        </div>
@endif

      <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="forusername" class="sr-only">username</label>
      <input type="text" id="forusername"  class="form-control" placeholder="Username" required autofocus name="username">
      <label for="inputPassword" class="sr-only">password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
      <div class="form-group">
            <label for="exampleFormControlSelect1" class="sr-only">type</label>
            <select class="form-control" id="exampleFormControlSelect1" name="type">
              <option value="1">Student</option>
              <option value="2">Teacher</option>
              <option value="3">Admin</option>
            </select>
          </div>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    {{ Form::close() }}
@endsection

