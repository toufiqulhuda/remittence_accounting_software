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
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Sub Group Account') }}</div>

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
                    <div class=" layout-sidebar-large d-inline-flex p-1 pull-right">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/subGroupAccount/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New </span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/subGroupAccount/edit') }}">
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

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                    <div class="col-md-10 p-1 float-left" >
                        <div class="card mb-3">
                    <div class="card-body">
                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('register') }}">
                        @csrf
                        @method('PUT')
                        <!-- <fieldset class="border p-2">
                        <legend class="w-auto">{{ __('Create User') }}</legend> -->
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
                            <label for="accountGType" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                            <div class="col-md-9">
                                <select id="accountGType" class="form-control @error('accountGType') is-invalid @enderror" name="accountGType" required autofocus>
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                                @error('accountGType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col-md-12">
                                <div class="row">
                                <label for="subAccountGCode" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Code') }}&nbsp;<span class="mandatory">*</span></label>
                                <div class="col-md-3">
                                    <input id="subAccountGCode" type="text" class="form-control input-sm @error('subAccountGCode') is-invalid @enderror" subAccountGCode="subAccountGCode" value="{{ old('subAccountGCode') }}" required autocomplete="subAccountGCode" autofocus>

                                    @error('subAccountGCode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label for="subAccountGNmae" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Name') }}&nbsp;<span class="mandatory">*</span></label>

                                <div class="col-md-3">
                                    <input id="subAccountGNmae" type="text" class="form-control input-sm @error('subAccountGNmae') is-invalid @enderror" subAccountGNmae="subAccountGNmae" value="{{ old('subAccountGNmae') }}" required autocomplete="subAccountGNmae" autofocus>

                                    @error('subAccountGNmae')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 col text-center">
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
