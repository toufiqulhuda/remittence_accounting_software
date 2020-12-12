@extends('layouts.withHF')

@section('content')
<link href="http://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">
<script src="http://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});

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
                                            {{-- <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> --}}
                                            <input type="text" class="form-control datepicker input-sm @error('frmDate') is-invalid @enderror" name="frmDate" value="{{ isset($VoucherDate->TnxDate)?$VoucherDate->TnxDate:'' }}" data-date-format="mm/dd/yyyy">
                                            @error('frmDate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="toDate" class="col-sm-1 col-form-label">To &nbsp;<span class="mandatory">*</span></label>
                                        <div class="col-sm-2">
                                            {{-- <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> --}}
                                            <input type="text" class="form-control datepicker input-sm @error('toDate') is-invalid @enderror" name="toDate" value="{{ isset($VoucherDate->TnxDate)?$VoucherDate->TnxDate:'' }}" data-date-format="mm/dd/yyyy">
                                            @error('toDate')
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
                                              <input class="form-check-input" type="radio" name="reportName" id="gridRadios1" value="transactionJournalRpt" checked>
                                              <label class="form-check-label" for="gridRadios1">
                                                Transaction Journal
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="reportName" id="gridRadios2" value="profitLossStatementRpt">
                                              <label class="form-check-label" for="gridRadios2">
                                                Profit & Loss Statement
                                              </label>
                                            </div>
                                            <div class="form-check ">
                                              <input class="form-check-input" type="radio" name="reportName" id="gridRadios3" value="accountTransactionSummeryRpt" >
                                              <label class="form-check-label" for="gridRadios3">
                                                Account Transaction Summery
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
