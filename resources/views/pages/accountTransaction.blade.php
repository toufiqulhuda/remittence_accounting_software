@extends('layouts.withHF')

@section('content')
<SCRIPT language="javascript">
    /*$(document).ready(function(){
        $(".add-row").click(function(){

            //var name = $("#name").val();
            //var email = $("#email").val();
            var table = document.getElementById('accTrxTbl');
            var rowCount = table.rows.length;
            var accountCode = '<SELECT name="accountCode" class="form-control form-control-sm">'+


                                '</SELECT>';
            var Particulars ='<INPUT class="form-control form-control-sm" type="text" name="Particulars"/>';
            var Debit='<INPUT class="form-control form-control-sm text-right" type="text" name="DrAmt" placeholder="0.000"/>';
            var Credit='<INPUT class="form-control form-control-sm text-right" type="text" name="CrAmt" placeholder="0.000"/>';
            var markup = "<tr>"+
                                "<td><input type='checkbox' name='record'></td>"+
                                "<td>"+rowCount++ +"</td>"+
                                '<td>' +accountCode+ '</td>'+
                                '<td>' +Particulars+ '</td>'+
                                '<td>' +Debit+'</td>'+
                                '<td>' +Credit+ '</td>'+
                         "</tr>";

            $("table tbody").append(markup);

        });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });*/
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

    #roleTable_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Account Transaction') }}</div>

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
                        <form method="POST" action="{{ route('transaction-account-store') }}">
                            @csrf
                            @method('POST')
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="form-group row">

                                                    <label for="TnxType" class="col-md-2 col-form-label text-md-left">{{ __('Entry Type') }}&nbsp;<span class="mandatory">*</span></label>
                                                    <div class="col-md-4">
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
                                                    <label for="voucherDate" class="col-md-2 col-form-label text-md-left">{{ __('Voucher Date') }}&nbsp;<span class="mandatory">*</span></label>
                                                    <div class="col-md-4">
                                                        <input id="voucherDate" type="text" class="form-control input-sm @error('voucherDate') is-invalid @enderror" name="voucherDate" value="{{ $vrDate->TnxDate }}" disabled autocomplete="voucherDate" autofocus>
                                                        @error('voucherDate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">

                                        <button type="button" class="add-row mb-3 btn-sm" value="Add Row" data-toggle="tooltip" data-placement="top" title="Add Row" onclick="addRow('accTrxTblBody');"><i class="fas fa-plus-circle"></i></button>
                                        <button type="button" class="delete-row mb-3 btn-sm" value="Delete Row" data-toggle="tooltip" data-placement="top" title="Delete Row" onclick="deleteRow('accTrxTblBody');"><i class="fas fa-trash-alt"></i></button>
                                        <div class="table-responsive">
                                            <table id="accTrxTbl" class="table table-bordered table-sm">
                                                <thead>
                                                  <tr >
                                                    <th class="w-5"></th>
                                                    <th class="w-5">VrNo</th>
                                                    <th class="w-35">Account Code</th>
                                                    <th class="w-35">Particulars</th>
                                                    <th class="w-10">Debit</th>
                                                    <th class="w-10">Credit</th>
                                                  </tr>
                                                </thead>
                                                <tbody id="accTrxTblBody">
                                                    <tr >
                                                        <td ><input type="checkbox"  name="chk"></td>
                                                        <td >1</td>
                                                        <td >
                                                            <SELECT name="accountCode[]" class="form-control form-control-sm" required>
                                                                @foreach ($COA as $key => $value)
                                                                    <option value="{{ $value->COACode }}" >{{ $value->COACode.' - '. $value->AccountName }}</option>
                                                                @endforeach
                                                            </SELECT>
                                                        </td>
                                                        <td ><INPUT type="text" class="form-control form-control-sm" name="Particulars[]" required/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="DrAmt" name="DrAmt[]" value="0.00"  placeholder="0.00"/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="CrAmt" name="CrAmt[]" value="0.00" placeholder="0.00"/></td>
                                                    </tr>
                                                    <tr >
                                                        <td ><input type="checkbox"  name="chk"></td>
                                                        <td >1</td>
                                                        <td >
                                                            <SELECT name="accountCode[]" class="form-control form-control-sm" required>
                                                                @foreach ($COA as $key => $value)
                                                                    <option value="{{ $value->COACode }}" >{{ $value->COACode.' - '. $value->AccountName }}</option>
                                                                @endforeach
                                                            </SELECT>
                                                        </td>
                                                        <td ><INPUT type="text" class="form-control form-control-sm" name="Particulars[]" required/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="DrAmt" name="DrAmt[]" value="0.00"  placeholder="0.00"/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="CrAmt" name="CrAmt[]" value="0.00" placeholder="0.00"/></td>
                                                    </tr>
                                                </tbody>
                                                    <tr >
                                                        <th class="w-35 text-right"colspan="4">Total Sum : </th>
                                                        <th class="w-10 text-right"><input class="form-control form-control-sm text-right" type="text" id="totalDR" value="0.00" readonly placeholder="0.00"/></th>
                                                        <th class="w-10 text-right"><input class="form-control form-control-sm text-right" type="text" id="totalCR" value="0.00" readonly placeholder="0.00"/></th>
                                                    </tr>
                                                <tfoot>
                                                </tfoot>
                                              </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="col-md-10 offset-md-2">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>{{ __('Save') }}</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-broom"></i>{{ __('Clear') }}</button>
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
