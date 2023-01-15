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
								<h3 class="page-title">Users</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">user name</li>
								</ul>
							</div>
                            <div class="col-sm-6">
                                <a href="{{url('add-user')}}" class="btn btn-primary">Create New User</a>
                            </div>
						</div>
					</div>

                    <table class="table">
                        <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Member Since</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><a href="{{url('edit-user/'.$user->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
					<!-- /Page Header -->

				</div>
			</div>
    	<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->



@endsection
