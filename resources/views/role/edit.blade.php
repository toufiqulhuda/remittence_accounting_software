@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-edit"></i>&nbsp;{{ __('Edit Role') }}</div>

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

                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                    <div class="col-md-8 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('roles.update',$role->roleid) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="roleName" class="col-md-12 col-form-label text-md-left">{{ __('Role Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-12">
                                                <input id="roleName" type="text" class="form-control input-sm @error('roleName') is-invalid @enderror" name="roleName" value="{{ $role->role_name }}" required autocomplete="roleName" autofocus>

                                                @error('roleName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                        <div class="form-group mb-0">
                                            <div class="col-md-12 ">
                                                <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i>
                                                    {{ __('Save') }}
                                                </button>
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fas fa-broom"></i>
                                                    {{ __('Clear') }}
                                                </button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- /contect -->
                    <!-- sidebar menu  -->
                    <div class=" layout-sidebar-large d-inline-flex p-1 pull-right">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ route('roles.create') }}">
                                        <i class="fas fa-plus-square"></i>
                                        <span class="nav-text">Create Role</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="#">
                                        <i class="fas fa-edit"></i>
                                        <span class="nav-text">Edit Role</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
