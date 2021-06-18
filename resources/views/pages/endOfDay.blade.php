@extends('layouts.withHF')

@section('content')
<!-- datatable js -->
{{-- <script src="{{ asset('assets/DataTable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/jszip.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.print.min.js')}}"></script> --}}
<!-- datatable css -->
{{-- <link href="{{ asset('assets/DataTable/css/jquery.dataTables.min.css')}}" rel=stylesheet> --}}
{{-- <link href="{{ asset('assets/DataTable/css/buttons.dataTables.min.css')}}" rel=stylesheet> --}}

<script>
    /*$(document).ready(function() {
        $('#grpAccTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

    } );*/
    function fromSubmit(form){
        if(!confirm("Do you really want to do this?")) {
            return false;
        }
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
                <div class="card-header"><i class="fas fa-file-invoice-dollar"></i>&nbsp;{{ __('End Of Day') }}</div>

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
                                    <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('endOfDay') }}">
                                        @csrf
                                        @method('POST')

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 col text-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="endOfDayConf" id="endOfDayConf">
                                                        <label class="form-check-label" for="endOfDayConf">
                                                            Confirm all the reports have Printed and Checked
                                                        </label>
                                                        @error('endOfDayConf')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-12 col text-center">
                                                    <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                        {{ __('End Of Day') }}
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
