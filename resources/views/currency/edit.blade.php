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
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Currency') }}</div>

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
                    <div class="col-md-10 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('currencies.update',$currency->CurrencyID) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">

                                            <label for="currencyName" class="col-md-3 col-form-label text-md-left">{{ __('Currency Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-9">
                                                <input id="currencyName" type="text" class="form-control input-sm @error('currencyName') is-invalid @enderror" Name="currencyName" value="{{ $currency->CurrencyName }}" required autocomplete="currencyName" autofocus>

                                                @error('currencyName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label for="isoCode" class="col-md-3 col-form-label text-md-left">{{ __('ISO Code') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <input id="isoCode" type="text" class="form-control input-sm @error('isoCode') is-invalid @enderror" Name="isoCode" value="{{ $currency->ISO_CODE }}" required autocomplete="isoCode" autofocus>

                                                @error('isoCode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="shortName" class="col-md-2 col-form-label text-md-left">{{ __('Short Name') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <input id="shortName" type="text" class="form-control input-sm @error('shortName') is-invalid @enderror" Name="shortName" value="{{ $currency->ShortName }}" required autocomplete="shortName" autofocus>

                                                @error('shortName')
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
                                    <a class="nav-item-hold" href="{{ Route('currencies.index') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Add Currency</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="#">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit Currency</span>
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
