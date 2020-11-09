@extends('layouts.withHF')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Exhouse') }}</div>

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
                                    <label for="ExhouseName" class="col-md-12 col-form-label text-md-left">{{ __('Exhouse Name') }}</label>

                                    <div class="col-md-12">
                                        <input id="ExhouseName" type="text" class="form-control input-sm @error('ExhouseName') is-invalid @enderror" ExhouseName="ExhouseName" value="" required autocomplete="ExhouseName" autofocus>

                                        @error('ExhouseName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <hr>
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
                                    <a class="nav-item-hold" href="{{ url('/exhouse/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Add Exhouse</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/exhouse/edit') }}">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit Exhouse</span>
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
