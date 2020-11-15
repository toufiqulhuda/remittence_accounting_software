@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Country') }}</div>

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

                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                    <div class="col-md-8 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('countries.update',$country->CountryID) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">

                                        <label for="countryName" class="col-md-3 col-form-label text-md-left">{{ __('Country Name') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <input id="countryName" type="text" class="form-control text-capitalize input-sm @error('countryName') is-invalid @enderror" Name="countryName" value="{{ $country->CountryName }}" required autocomplete="countryName" autofocus>

                                            @error('countryName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="countryCode" class="col-md-3 col-form-label text-md-left">{{ __('Country Code') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-2">
                                            <input id="countryCode" type="text" class="form-control input-sm @error('countryCode') is-invalid @enderror" name="countryCode" value="{{ $country->CountryCode }}" required autocomplete="countryCode" autofocus>

                                            @error('countryCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="countryID" class="col-md-3 col-form-label text-md-left">{{ __('Currency') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-4">
                                            <select id="currencyID" class="form-control @error('currencyID') is-invalid @enderror" name="currencyID" required autofocus>
                                                <option value="">...</option>
                                                @foreach ($currency as $key => $value)
                                                    <option value="{{ $value->CurrencyID }}" {{ $country->CurrencyID == $value->CurrencyID ? 'selected' : ''}}>{{ $value->CurrencyName }}</option>
                                                @endforeach
                                            </select>
                                            @error('currencyID')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="isoCode" class="col-md-3 col-form-label text-md-left">{{ __('ISO Code') }}&nbsp;<span class="mandatory">*</span></label>

                                        <div class="col-md-2">
                                            <input id="isoCode" type="text" class="form-control text-uppercase input-sm @error('isoCode') is-invalid @enderror" name="isoCode" value="{{ $country->iso_code }}" required autocomplete="isoCode" autofocus>

                                            @error('isoCode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-3">
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
                    <!-- sidebar menu  -->
                    <div class=" layout-sidebar-large d-inline-flex p-1 pull-right">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ route('countries.index') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Add Country</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="#">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit Country</span>
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
