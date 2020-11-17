@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Add Chart Of Account') }}</div>

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

                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ route('chartOfAccount.index') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="#">
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
                                    <form method="POST" action="{{ route('chartOfAccount.store') }}">
                                        @csrf
                                        @method('POST')

                                        <div class="form-group row">
                                            <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-9">
                                                <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($exHouse as  $value)
                                                        <option value="{{ $value->ExHouseID }}" {{ old('exhouseName')== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('exhouseName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="subAccGroupType" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <select id="subAccGroupType" class="form-control @error('subAccGroupType') is-invalid @enderror" name="subAccGroupType" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($accSubGroupType as  $value)
                                                        <option value="{{ $value->AccSbGrID }}" {{ old('subAccGroupType')== $value->AccSbGrID ? 'selected' : '' }}>{{ $value->AccSbGrName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subAccGroupType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="AccountName" class="col-md-3 col-form-label text-md-left">{{ __('New COA Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <input id="AccountName" type="text" class="form-control input-sm @error('AccountName') is-invalid @enderror" Name="AccountName" value="{{ old('AccountName') }}" required autocomplete="AccountName" autofocus>

                                                @error('AccountName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <div class=" col-md-12">
                                                <div class="row">
                                                <label for="COACode" class="col-md-3 col-form-label text-md-left">{{ __('New COA Code') }}&nbsp;<span class="mandatory">*</span></label>
                                                <div class="col-md-3">
                                                    <input id="COACode" type="text" class="form-control input-sm @error('COACode') is-invalid @enderror" name="COACode" value="{{ old('COACode') }}" required autocomplete="COACode" autofocus>

                                                    @error('COACode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <label for="COAName" class="col-md-3 col-form-label text-md-left">{{ __('New COA Name') }}&nbsp;<span class="mandatory">*</span></label>

                                                <div class="col-md-3">
                                                    <input id="COAName" type="text" class="form-control input-sm @error('COAName') is-invalid @enderror" COAName="COAName" value="{{ old('COAName') }}" required autocomplete="COAName" autofocus>

                                                    @error('COAName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <hr>
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
