@extends('layouts.withHF')

@section('content')
<!-- datatable js -->
<script src="{{ asset('assets/DataTable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/jszip.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/DataTable/js/buttons.print.min.js')}}"></script>
<!-- datatable css -->
<link href="{{ asset('assets/DataTable/css/jquery.dataTables.min.css')}}" rel=stylesheet>
<link href="{{ asset('assets/DataTable/css/buttons.dataTables.min.css')}}" rel=stylesheet>
<SCRIPT language="javascript">
    $(document).ready(function() {
        $('#accTrxRevTbl').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );

    } );
    function fromSubmit(form){
        var countChk = document.querySelectorAll('input[type="checkbox"]:checked').length;
        if (countChk == 0){
            alert("Please select transaction(s) for delete.");
            return false;
        }

        if(!confirm("Do you really want to do this?")) {
            return false;
        }

        this.form.submit();
    }
    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var colCount = table.rows[0].cells.length;

        for(var i=0; i<colCount; i++) {

            var newcell	= row.insertCell(i);

            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch(newcell.childNodes[0].type) {
                case "text":
                        newcell.childNodes[0].value = "";
                        break;
                case "checkbox":
                        newcell.childNodes[0].checked = false;
                        break;
                case "select-one":
                        newcell.childNodes[0].selectedIndex = 0;
                        break;
            }
        }
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 2) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        }catch(e) {
            alert(e);
        }
    }

    window.onload=function(){
        var x = document.getElementById("DrAmt");
        //x.addEventListener("focusin", myFocusFunction);
        //alert(x);
        if(x){
            x.addEventListener("blur", rankPlayers);
        }
    }
    function rankPlayers(){
            var table=document.getElementById("accTrxTblBody");
            //alert(table.rows.length);
            for(var i=0; i<table.rows.length;i++){

                console.log(table.rows[i].cells[4].children[0].value);
            }
    }
    // function myFocusFunction() {
    // document.getElementById("myInput").style.backgroundColor = "yellow";
    // }

    // function myBlurFunction() {
    // document.getElementById("myInput").style.backgroundColor = "";
    // }
    function drsum(){
        try{
            const  DrAmt= parseInt(document.getElementById('DrAmt').value);
            const  totalDR = parseInt(document.getElementById('totalDR').value);
            const sum = totalDR+DrAmt;
            document.getElementById('totalDR').value=sum;
            alert(totalDR+DrAmt);

        }
        catch(e){
            alert(e)
        }

    }
    function crsum(crid){
        try{

        }
        catch(e){
            alert(e)
        }
    }

</SCRIPT>
<style rel="stylesheet">

    #accTrxRevTbl_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Reverse Transaction') }}</div>

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
                    {{-- <div class=" layout-sidebar-large d-inline-flex p-1 ">
                        <div class="sidebar-left open " >
                            <ul class="navigation-left">

                                <li class="nav-item active">
                                    <a class="nav-item-hold" href="{{ url('/chartOfAccount/create') }}">
                                        <i class="far fa-plus-square"></i>
                                        <span class="nav-text">Create New</span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-item-hold" href="{{ url('/chartOfAccount/edit') }}">
                                        <i class="far fa-edit"></i>
                                        <span class="nav-text">Edit </span>
                                    </a>
                                    <div class="triangle"></div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}

                    <!-- / sidebar menu-->
                    <!-- content -->
                    {{-- <div id="inner-content" class="d-inline-flex p-3"> --}}
                        <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('transaction-delete') }}">
                            @csrf
                            @method('POST')
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id="accTrxRevTbl" class="table table-bordered table-sm">
                                                <thead>
                                                  <tr >
                                                    <th class="w-5"></th>
                                                    <th class="w-5">VrNo</th>
                                                    <th class="w-10">Tnx Date</th>
                                                    <th class="w-10">COA Code</th>
                                                    <th class="w-20">Account Name</th>
                                                    <th class="w-25">Particulars</th>
                                                    <th class="w-5">Tnx Type</th>
                                                    <th class="w-10">Debit</th>
                                                    <th class="w-10">Credit</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($tnxs))
                                                    @foreach ($tnxs as $tnx)
                                                    <tr >
                                                        <td ><input type="checkbox"  name="chk[]" value="{{ $tnx->VoucherNo }}"></td>
                                                        <td >{{ $tnx->VoucherNo }}</td>
                                                        <td >{{ $tnx->VoucherDate }}</td>
                                                        <td >{{ $tnx->COACode }}</td>
                                                        <td >{{ $tnx->AccountName }}</td>
                                                        <td >{{ $tnx->Particulars }}</td>
                                                        <td >{{ $tnx->TnxType }}</td>
                                                        <td class="text-right">{{ $tnx->DrAmt }}</td>
                                                        <td class="text-right">{{ $tnx->CrAmt }}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                {{-- <tfoot>
                                                    <tr >
                                                        <th class="w-35 text-right"colspan="7">Total Sum : </th>
                                                        <th class="w-10 text-right">0.00</th>
                                                        <th class="w-10 text-right">0.00</th>
                                                    </tr>
                                                </tfoot> --}}
                                              </table>

                                        </div>
                                        <div class="d-flex justify-content-center">{!! $tnxs->links() !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i>&nbsp;{{ __('Delete') }}</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-broom"></i>&nbsp;{{ __('Clear') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- dataTable -->

                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
