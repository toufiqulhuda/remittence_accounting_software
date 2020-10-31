@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Add Chart Of Account') }}</div>

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
                                    <a class="nav-item-hold" href="{{ url('/chartOfAccount/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/chartOfAccount/edit') }}">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit </span>
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
                            @method('PUT')

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
                                <label for="subAccountGType" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                                <div class="col-md-9">
                                    <select id="subAccountGType" class="form-control @error('subAccountGType') is-invalid @enderror" name="subAccountGType" required autofocus>
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                    @error('subAccountGType')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class=" col-md-12">
                                    <div class="row">
                                    <label for="SOACode" class="col-md-3 col-form-label text-md-left">{{ __('New SOA Code') }}&nbsp;<span class="mandatory">*</span></label>
                                    <div class="col-md-3">
                                        <input id="SOACode" type="text" class="form-control input-sm @error('SOACode') is-invalid @enderror" SOACode="SOACode" value="{{ old('SOACode') }}" required autocomplete="SOACode" autofocus>

                                        @error('SOACode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="SOAName" class="col-md-3 col-form-label text-md-left">{{ __('New SOA Name') }}&nbsp;<span class="mandatory">*</span></label>

                                    <div class="col-md-3">
                                        <input id="SOAName" type="text" class="form-control input-sm @error('SOAName') is-invalid @enderror" SOAName="SOAName" value="{{ old('SOAName') }}" required autocomplete="SOAName" autofocus>

                                        @error('SOAName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </div>
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
