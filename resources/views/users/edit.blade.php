@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('User Management') }}</div>

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
                    <div class=" layout-sidebar-large d-inline-flex p-2 ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">
                                
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/users/create') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="nav-text">Create User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/users/edit') }}">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="nav-text">Edit User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>

                                <li class="nav-item ">
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
                    
                    <div id="inner-content" class="d-inline-flex p-2">{{ __('User edit page') }}</div>
                    
                    <!-- /contect -->
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
