@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-user-edit"></i>&nbsp;{{ __('Edit User') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('status') }}
                    </div>

                    @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('failed') }}
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
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/users/edit') }}">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="nav-text">Edit User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>

                                {{-- <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/users/show') }}">
                                        <i class="fas fa-address-card"></i>
                                        <span class="nav-text">User Info</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                    <div class="col-md-8 p-1 float-left" >
                        <div class="card mb-3">
                    <div class="card-body">
                    <form method="POST" action="{{ route('users.update',$user->user_id) }}">
                            @csrf
                            @method('PUT')
                            <!-- <fieldset class="border p-2">
                            <legend class="w-auto">{{ __('Create User') }}</legend> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Full Name') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control input-sm @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="exHouse" class="col-md-12 col-form-label text-md-left">{{ __('ExHouse') }}</label>

                                    <div class="col-md-12">

                                        <select id="exHouse" class="form-control @error('exHouse') is-invalid @enderror" name="exHouse" required autofocus>
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('exHouse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="country" class="col-md-12 col-form-label text-md-left">{{ __('Country') }}</label>

                                    <div class="col-md-12">
                                        <!-- <input id="country" type="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country"> -->
                                        <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required autofocus>
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}
                            </div>
                            <div class="form-group ">
                                <label for="role" class="col-md-12 col-form-label text-md-left">{{ __('User Role') }}</label>
                                <div class="col-md-12">
                                    <!-- <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role" autofocus> -->
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autofocus>
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="form-group mb-0">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i>
                                        {{ __('Save') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-broom"></i>
                                        {{ __('Clear') }}
                                    </button>
                                </div>
                            </div>

                            <!-- </fieldset> -->
                        </form>
                    </div>
                    </div>
                    </div>

                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
