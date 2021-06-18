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


                    <!-- / sidebar menu-->
                    <!-- content -->

                    <!-- <div id="inner-content" class="d-inline-flex p-3"> -->
                    <div class="col-md-10 p-1 float-left" >
                        <div class="card mb-3">
                    <div class="card-body">

                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{route('subGroupAccount.update',$accountSubGroup->AccSbGrID)}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                            <div class="col-md-9">
                                <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                    <option selected>Choose...</option>
                                    @foreach ($exHouse as  $value)
                                        <option value="{{ $value->ExHouseID }}" {{ ($accountSubGroup->ExHouseID== $value->ExHouseID) ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
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
                            <label for="accountGType" class="col-md-3 col-form-label text-md-left">{{ __('Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                            <div class="col-md-9">
                                <select id="accountGType" class="form-control @error('accountGType') is-invalid @enderror" name="accountGType" required autofocus>
                                    <option selected>Choose...</option>
                                    @foreach ($accGroupType as  $value)
                                        <option value="{{ $value->AccGrID }}" {{ ($accountSubGroup->AccGrID== $value->AccGrID) ? 'selected' : '' }}>{{ $value->AccGrName }}</option>
                                    @endforeach
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

                                <label for="AccSbGrName" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Name') }}&nbsp;<span class="mandatory">*</span></label>

                                <div class="col-md-3">
                                    <input id="AccSbGrName" type="text" class="form-control input-sm @error('AccSbGrName') is-invalid @enderror" name="AccSbGrName" value="{{ $accountSubGroup->AccSbGrName }}" required autocomplete="AccSbGrName" autofocus>

                                    @error('AccSbGrName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                        <hr>
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
