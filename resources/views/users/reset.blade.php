@extends('layouts.withHF')

@section('content')
<script>
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
        this.form.submit();
    }
</script>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-user-edit"></i>&nbsp;{{ __('Reset User') }}</div>

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
                                    <a class="nav-item-hold" href="{{ route('users.index') }}">
                                        <i class="fas fa-user-plus"></i>
                                        <span class="nav-text">Create User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="#">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="nav-text">Edit User</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                        <div class="col-md-10 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{route('users-search')}}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group row">
                                            <label for="username" class="col-md-2 col-form-label text-md-left">{{ __('User Name') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <input id="username" type="text" class="form-control input-sm @error('username') is-invalid @enderror" name="username" value="" required autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            {{-- <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-Mail Address') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> --}}
                                        </div>

                                        {{-- <div class="form-group row">

                                            <label for="exHouse" class="col-md-2 col-form-label text-md-left">{{ __('ExHouse') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <select id="exHouse" class="form-control @error('exHouse') is-invalid @enderror" name="exHouse" required autofocus>
                                                    <option value="">Choose...</option>
                                                    {{-- @foreach ($exHouse as  $value)
                                                        <option value="{{ $value->ExHouseID }}" {{ $user->ExHouseID== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('exHouse')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="role" class="col-md-2 col-form-label text-md-left">{{ __('User Role') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required autofocus>
                                                    <option value="">Choose...</option>
                                                    {{-- @foreach ($roles as $key => $value)
                                                        <option value="{{ $value->roleid }}" {{ $user->roleid== $value->roleid ? 'selected' : '' }}>{{ $value->role_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div> --}}
                                        <hr>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-10 offset-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i>
                                                    {{ __('Save') }}
                                                </button>
                                                <button type="reset" class="btn btn-primary">
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
