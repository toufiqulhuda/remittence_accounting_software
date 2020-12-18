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
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Exhouse') }}</div>

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
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('exhouses.update',$exhouse->ExHouseID) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">

                                            <label for="exHouseName" class="col-md-2 col-form-label text-md-left">{{ __('Exhouse Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-4">
                                                <input id="exHouseName" type="text" class="form-control input-sm @error('exHouseName') is-invalid @enderror" name="exHouseName" value="{{ $exhouse->ExHouseName }}" required autocomplete="exHouseName" autofocus>

                                                @error('exHouseName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="country" class="col-md-2 col-form-label text-md-left">{{ __('Country') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-4">

                                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required autofocus>
                                                    <option value="">...</option>
                                                    @foreach ($country as $key => $value)
                                                        <option value="{{ $value->CountryID }}" {{ $exhouse->CountryID == $value->CountryID ? 'selected' : '' }}>{{ $value->CountryName }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">

                                            <label for="exParentCode" class="col-md-2 col-form-label text-md-left">{{ __('ExHouse Parent') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <select id="exParentCode" class="form-control @error('exParentCode') is-invalid @enderror" name="exParentCode" required autofocus>
                                                    <option value="">...</option>
                                                    <option value="self">Self</option>
                                                    @foreach ($exParent as $key => $valueParent)
                                                        <option value="{{ $valueParent->ExHouseID }}" {{ ($exhouse->ExHouseID == $valueParent->ExHouseID) ? 'selected' : '' }}>{{ $valueParent->ExHouseName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('exParentCode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="address" class="col-md-2 col-form-label text-md-left">{{ __('Address') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-4">

                                            <textarea class="form-control" id="address" name="address" rows="3">{{$exhouse->Address}}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="form-group row mb-0">
                                            <div class="col-md-10 offset-md-2">
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
                                    <a class="nav-item-hold" href="{{ route('exhouses.index') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Add Exhouse</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="">
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
