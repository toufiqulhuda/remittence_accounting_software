@extends('layouts.withHF')

@section('content')

<script src="{{ asset('assets/js/gijgo.min.js') }}" type="text/javascript"></script>
{{-- <link href="{{ asset('assets/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
$( document ).ready(function() {
    $('#asOnDate').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd-mm-yyyy'
    });
});
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
        this.form.submit();
    }

</script>
<style rel="stylesheet">

#exhouseTable_wrapper .dt-button{
    color: #fff;
    background-color: #17a2b8;
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header"><i class="fas fa-file-alt"></i>&nbsp;{{ __('Reports As On Date') }}</div>

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
                    <?php //var_dump($exParent);?>
                    <!-- content -->
                    <div class="col-md-12 p-1 float-left" >
                        <div class="card mb-3">
                            <div class="card-body">
                                <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('rptAsOnDate') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">As On Date &nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control datepicker input-sm @error('asOnDate') is-invalid @enderror" id="asOnDate" name="asOnDate" data-date-format="mm/dd/yyyy" value="{{ isset($VoucherDate->TnxDate) ? date('d-m-Y', strtotime($VoucherDate->TnxDate)) :'' }}"  required>
                                                @error('asOnDate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-form-label col-sm-2 pt-0">Export Format &nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="DloadType" id="exportFormetPDF" value="PDF" checked>
                                                    <label class="form-check-label" for="exportFormetPDF">
                                                        PDF
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="DloadType" id="exportFormetExl" value="Excel" >
                                                    <label class="form-check-label" for="exportFormetExl">
                                                        Excel
                                                    </label>
                                                </div>
                                                {{--<!--<select id="DloadType" class="custom-select form-control @error('DloadType') is-invalid @enderror" name="DloadType" required autofocus>

                                                    <option value="PDF" selected>PDF</option>
                                                    <option value="Excel">Excel</option>

                                                </select>
                                                @error('DloadType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror--}}

                                            </div>
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <label class="col-form-label col-sm-2 pt-0">Select One &nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reportName" id="gridRadios1" value="trailBalanceRpt" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Trail Balance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reportName" id="gridRadios2" value="dailyCashBookRpt">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Daily Cash Book
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reportName" id="gridRadios3" value="statementOfAffairsRpt">
                                                    <label class="form-check-label" for="gridRadios3">
                                                        Statement Of Affairs
                                                    </label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="reportName" id="gridRadios4" value="statAffairsDetailRpt" >
                                                    <label class="form-check-label" for="gridRadios4">
                                                        Statement Of Affairs (Detail)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                      </fieldset>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-download"></i>
                                                {{ __('Export') }}
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
                    <!-- dataTable -->

                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
