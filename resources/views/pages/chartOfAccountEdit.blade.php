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
                <div class="card-header"><i class="far fa-edit"></i>&nbsp;{{ __('Edit Chart Of Account') }}</div>

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
                    <div class="col-md-12 p-1 float-left" >
                        <div class="card mb-3">
                    <div class="card-body">
                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('chartOfAccount.update',$chartOfAccount->COACode) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="exhouseName" class="col-md-3 col-form-label text-md-left">{{ __('Exchange House Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <select id="exhouseName" class="form-control @error('exhouseName') is-invalid @enderror" name="exhouseName" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($exHouse as  $value)
                                                        <option value="{{ $value->ExHouseID }}" {{ $chartOfAccount->ExHouseID== $value->ExHouseID ? 'selected' : '' }}>{{ $value->ExHouseName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('exhouseName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="subAccGroupType" class="col-md-3 col-form-label text-md-left">{{ __('Sub Account Group Type') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-3">
                                                <select id="subAccGroupType" class="form-control @error('subAccGroupType') is-invalid @enderror" name="subAccGroupType" required autofocus>
                                                    <option value="">Choose...</option>
                                                    @foreach ($accSubGroupType as  $value)
                                                        <option value="{{ $value->AccSbGrID }}" {{ $chartOfAccount->AccSbGrID== $value->AccSbGrID ? 'selected' : '' }}>{{ $value->AccSbGrName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subAccGroupType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="AccountName" class="col-md-3 col-form-label text-md-left">{{ __('New COA Name') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-5">
                                                <input id="AccountName" type="text" class="form-control input-sm @error('AccountName') is-invalid @enderror" Name="AccountName" value="{{ $chartOfAccount->AccountName }}" required autocomplete="AccountName" autofocus>

                                                @error('AccountName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label for="initBalance" class="col-md-2 col-form-label text-md-left">{{ __('Initial Balance') }}&nbsp;<span class="mandatory">*</span></label>

                                            <div class="col-md-2">
                                                <input id="initBalance" type="text" style="text-align: right" class="form-control input-sm @error('initBalance') is-invalid @enderror" Name="initBalance" value="{{$chartOfAccount->Balance }}" placeholder="0.00" required autocomplete="initBalance" autofocus>

                                                @error('initBalance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                            </div>
                            {{-- <div class="form-group row">
                                <div class=" col-md-12">
                                    <div class="row">
                                        <label for="changeAccountName" class="col-md-4 col-form-label text-md-left">{{ __('Changed Account Name') }}&nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-md-4">
                                            <input id="changeAccountName" type="text" class="form-control input-sm @error('changeAccountName') is-invalid @enderror" changeAccountName="changeAccountName" value="{{ old('changeAccountName') }}" required autocomplete="changeAccountName" autofocus>

                                            @error('changeAccountName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-check col-md-4">
                                            <label class="form-check-label col-form-label col-md-12">
                                              <input type="checkbox" name="sameAsBefor" id="sameAsBefor" class="form-check-input" value="">&nbsp;Same As Before
                                            </label>
                                        </div>


                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label for="reportingType" class="col-md-4 col-form-label text-md-left">{{ __('Reporting Type') }}&nbsp;<span class="mandatory">*</span></label>

                                <div class="col-md-4">
                                    <select id="reportingType" class="form-control @error('reportingType') is-invalid @enderror" name="reportingType" required autofocus>
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                    @error('reportingType')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

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
