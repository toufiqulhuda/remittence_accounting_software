@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('User Information') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <!-- sidebar menu  -->
                    <div class=" layout-sidebar-large d-inline-flex p-1 ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/users/create') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="nav-text">Create User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/users/edit') }}">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="nav-text">Edit User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>

                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/users/show') }}">
                                        <i class="fas fa-address-card"></i>
                                        <span class="nav-text">User Info</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->
                    <!-- <div id="inner-content" class="d-inline-flex p-2"> -->
                    <div class="col-md-8 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                Kenneth Valdez
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                fip@jukmuh.al
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                (239) 816-9029
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                (320) 380-4539
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                Bay Area, San Francisco, CA
                                </div>
                            </div>
                            </div>
                        </div>
                    <!-- </div> -->



                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
