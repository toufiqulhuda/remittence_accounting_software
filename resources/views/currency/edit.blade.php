@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Currency') }}</div>

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
                    <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- <fieldset class="border p-2">
                            <legend class="w-auto">{{ __('Create User') }}</legend> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="currencyName" class="col-md-12 col-form-label text-md-left">{{ __('Currency Name') }}</label>

                                    <div class="col-md-12">
                                        <input id="currencyName" type="text" class="form-control input-sm @error('currencyName') is-invalid @enderror" currencyName="currencyName" value="" required autocomplete="currencyName" autofocus>

                                        @error('currencyName')
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
                                    <a class="nav-item-hold" href="{{ url('/currency/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Add Currency</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/currency/edit') }}">
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
