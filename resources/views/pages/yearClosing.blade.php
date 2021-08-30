@extends('layouts.withHF')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#closingYear').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });
    });
    function fromSubmit(form){
        // if(!confirm("Do you really want to do this?")) {
        //     return false;
        // }
        this.form.submit();
    }
</script>
<style rel="stylesheet">

    #grpAccTable_wrapper .dt-button{
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
                <div class="card-header"><i class="fas fa-calendar-alt"></i>&nbsp;{{ __('Year Closing') }}</div>

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
                    <!-- / sidebar menu-->
                    <!-- content -->
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <div class="col-md-12 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('yearClosing') }}">
                                        @csrf
                                        @method('POST')

                                            <div class="form-group row">

                                                <label for="closingYear" class="col-sm-3 col-form-label">Year Closing Date: </label>
                                                <div class="col-md-3">
                                                        <input type="text" class="form-control datepicker input-sm @error('closingYear') is-invalid @enderror" id="closingYear" name="closingYear" value="{{date('d-m-Y',strtotime($lastYearClosingDate->Closing_Year))}}"  required>
                                                        @error('closingYear')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                </div>

                                            </div>

                                            <hr>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 col text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-calendar-alt"></i>
                                                        {{ __('Year Closing') }}
                                                    </button>
                                                    <button type="reset" class="btn btn-primary">
                                                        <i class="fas fa-broom"></i>
                                                        {{ __('Cancel') }}
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
