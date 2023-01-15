@extends('layouts.app')

@section('content')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{url('/')}}" class="logo">
                    <img src="{{asset('img\logo.svg')}}" alt="Logo">
                </a>
                <a href="{{url('/')}}" class="logo logo-small">
                    <img src="{{asset('images\logo.png')}}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <!-- /Logo -->

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Right Menu -->
            <ul class="nav user-menu">

                <!-- App Lists -->
                <li class="nav-item dropdown app-dropdown">
                    <a class="nav-link dropdown-toggle" aria-expanded="false" role="button" data-toggle="dropdown" href="#"><i class="fe fe-app-menu"></i></a>
                    <ul class="dropdown-menu app-dropdown-menu">
                        <li>
                            <div class="app-list">
                                <div class="row">
                                    <div class="col"><a class="app-item" href="{{url('admin/inbox')}}"><i class="fa fa-envelope"></i><span>Email</span></a></div>
                                    <div class="col"><a class="app-item" href="{{url('admin/calendar')}}"><i class="fa fa-calendar"></i><span>Calendar</span></a></div>
                                    <div class="col"><a class="app-item" href="{{url('admin/chat')}}"><i class="fa fa-comments"></i><span>Chat</span></a></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- /App Lists -->


                <!-- User Menu -->
                <li class="nav-item dropdown">
                    <a href="{{url('admin/profile')}}" class="dropdown-toggle nav-link">
                        {{Auth::user('admin')->name}}
                        <span class="user-img"><img class="rounded-circle" src="{{asset('manager\assets\img\profiles\avatar.png')}}" width="31" alt="Ryan Taylor"></span>
                    </a>
                </li>
                <!-- /User Menu -->

            </ul>
            <!-- /Header Right Menu -->

        </div>			<!-- /Header -->

        <x-sidebar />

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="page-title">Edit New User</h3>
                        </div>
                    </div>
                </div>

                @if(Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif

                <form method="post" action="{{url('user/'.$user->id)}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First Name" value="{{$user->first_name}}">

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Last Name" value="{{$user->last_name}}">

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@example.com" value="{{$user->email}}">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="role">Role</label>
                        <select id="role" name="role" class="form-control">
                            <option selected>Choose...</option>
                            @foreach($roles as $role)
                                @if($role->name === $user_role)
                                    <option value="{{$role->name}}" selected>{{$role->name}}</option>
                                @else
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">

                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Changes</button>
                </form>


            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->



@endsection
