@extends('layouts.withHF')

@section('content')
{{-- <link href="http://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<script src="http://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> --}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
// $('.datepicker').datepicker({
//     format: 'mm/dd/yyyy',
//     startDate: '-3d'
// });
$( document ).ready(function() {
    $("#account").prop('disabled', true);
    // var reportName  = $('input[name="reportName"]:checked').val();
    // if(reportName=='accountTransactionSummaryRpt'){
    //     $("#account").prop('disabled', false);
    //     $("#TnxType").prop('disabled', true);
    // }else if(reportName=='voucherPrintRpt'){
    //     $("#account").prop('disabled', true);
    //     $("#TnxType").prop('disabled', true);
    // }else if(reportName=='profitLossStatementRpt'){
    //     $("#account").prop('disabled', true);
    //     $("#TnxType").prop('disabled', true);
    // }else{
    //     $("#account").prop('disabled', true);
    //     $("#TnxType").prop('disabled', false);
    // }
    //accountActiveInactive(r);
});
function accountActiveInactive(r){
    var reportName  = $('input[name="reportName"]:checked').val();
    if(reportName=='accountTransactionSummaryRpt'){
        $("#account").prop('disabled', false);
        $("#TnxType").prop('disabled', true);
    }else if(reportName=='voucherPrintRpt'){
        $("#account").prop('disabled', true);
        $("#TnxType").prop('disabled', true);
    }else if(reportName=='profitLossStatementRpt'){
        $("#account").prop('disabled', true);
        $("#TnxType").prop('disabled', true);
    }else{
        $("#account").prop('disabled', true);
        $("#TnxType").prop('disabled', false);
    }
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
                <div class="card-header"><i class="fas fa-file-alt"></i>&nbsp;{{ __('Todays Report') }}</div>

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
                                <form method="POST" action="{{ route('todaysRpt') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group row">
                                        <label for="frmDate" class="col-sm-2 col-form-label">Date &nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-sm-2">

                                            <input type="text" class="form-control datepicker input-sm @error('frmDate') is-invalid @enderror" name="frmDate" value="{{ isset($VoucherDate->TnxDate)?$VoucherDate->TnxDate:'' }}" data-date-format="mm/dd/yyyy" required>
                                            @error('frmDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="toDate" class="col-sm-1 col-form-label">To &nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-sm-2">

                                            <input type="text" class="form-control datepicker input-sm @error('toDate') is-invalid @enderror" name="toDate" value="{{ isset($VoucherDate->TnxDate)?$VoucherDate->TnxDate:'' }}" data-date-format="mm/dd/yyyy" required>
                                            @error('toDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="account" class="col-sm-2 col-form-label">Account &nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-sm-5">
                                            <select id="account" class="custom-select form-control" name="account" required autofocus>
                                                <option value="" >- Select a Account-</option>
                                                @foreach ($COA as $key => $value)
                                                    <option value="{{ $value->COACode }}" {{ old('account')== $value->COACode ? 'selected' : '' }}>{{ $value->COACode.' - '. $value->AccountName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="TnxType" class="col-md-2 col-form-label text-md-left">{{ __('Entry Type') }}&nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-md-3">
                                            <select id="TnxType" class="custom-select form-control @error('TnxType') is-invalid @enderror" name="TnxType" required autofocus>

                                                <option value="T">Transfer</option>
                                                <option value="C">Cash</option>

                                            </select>
                                            @error('TnxType')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                          <label class="col-form-label col-sm-2 pt-0">Select One &nbsp;<span class="mandatory">*</span></label>
                                          <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportName" id="gridRadios1" value="transactionJournalRpt" checked onclick="accountActiveInactive(this);">
                                                <label class="form-check-label" for="gridRadios1">
                                                    Transaction Journal
                                                </label>
                                            </div>
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportName" id="gridRadios2" value="transactionJournalTransferRpt" onclick="accountActiveInactive(this);">
                                                <label class="form-check-label" for="gridRadios2">
                                                    Transaction Journal Transfer
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportName" id="gridRadios3" value="transactionJournalCashRpt" onclick="accountActiveInactive(this);">
                                                <label class="form-check-label" for="gridRadios3">
                                                    Transaction Journal Cash
                                                </label>
                                              </div> --}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportName" id="gridRadios4" value="voucherPrintRpt" onclick="accountActiveInactive(this);">
                                                <label class="form-check-label" for="gridRadios4">
                                                    Voucher Print
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="reportName" id="gridRadios5" value="profitLossStatementRpt" onclick="accountActiveInactive(this);">
                                                <label class="form-check-label" for="gridRadios5">
                                                    Profit & Loss Statement
                                                </label>
                                            </div>
                                            <div class="form-check ">
                                              <input class="form-check-input" type="radio" name="reportName" id="gridRadios6" value="accountTransactionSummaryRpt" onclick="accountActiveInactive(this);" >
                                              <label class="form-check-label" for="gridRadios6">
                                                Account Transaction Summary
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
                                                {{ __('Export PDF') }}
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
                    <!-- dataTable -->

                    <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
