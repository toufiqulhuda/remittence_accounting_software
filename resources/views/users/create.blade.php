@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

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

                                <li class="nav-item active">
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
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <div class="col-md-8 p-1 float-left" >
                            <div class="card mb-3">
                        <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- <fieldset class="border p-2">
                            <legend class="w-auto">{{ __('Create User') }}</legend> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Full Name') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control input-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exHouse" class="col-md-12 col-form-label text-md-left">{{ __('exHouse') }}</label>

                                    <div class="col-md-12">
                                        <!-- <input id="exHouse" type="exHouse" class="form-control @error('exHouse') is-invalid @enderror" name="exHouse" value="{{ old('exHouse') }}" required autocomplete="exHouse"> -->
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
                                <div class="form-group col-md-6">
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
                                </div>
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



                                <div class="form-group ">
                                    <label for="username" class="col-md-12 col-form-label text-md-left">{{ __('Username') }}</label>

                                    <div class="col-md-12">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                            {{ __('Save') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-redo"></i>
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
