@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Create Group Account') }}</div>

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
                                    <a class="nav-item-hold" href="{{ url('/groupAccount/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/groupAccount/edit') }}">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- / sidebar menu-->
                    <!-- content -->
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <div class="col-md-10 p-1 float-left" >
                            <div class="card mb-3">
                        <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            @method('POST')

                                <div class="form-group row">
                                    <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                                    <div class="col-md-9">
                                        <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('exhouseName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class=" col-md-12">
                                        <div class="row">
                                        <label for="accountGCode" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Code') }}&nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-md-3">
                                            <input id="accountGCode" type="text" class="form-control input-sm @error('accountGCode') is-invalid @enderror" accountGCode="accountGCode" value="{{ old('accountGCode') }}" required autocomplete="accountGCode" autofocus>

                                            @error('accountGCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="accountGName" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-3">
                                            <input id="accountGName" type="text" class="form-control input-sm @error('accountGName') is-invalid @enderror" accountGName="accountGName" value="{{ old('accountGName') }}" required autocomplete="accountGName" autofocus>

                                            @error('accountGName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="accountHeadType" class="col-md-3 col-form-label text-md-left">{{ __('Account Head Type') }}&nbsp;<span class="mandatory">*</span></label>

                                    <div class="col-md-9">
                                        <select id="accountHeadType" class="form-control @error('accountHeadType') is-invalid @enderror" name="accountHeadType" required autofocus>
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                        @error('accountHeadType')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-3">
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
