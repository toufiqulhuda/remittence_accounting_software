@extends('layouts.withHF')

@section('content')
<SCRIPT language="javascript">
    function fromSubmit(form){
        var table=document.getElementById("accTrxTblBody");
        var VrDate=document.getElementById("voucherDate").value;
        var TnxType=document.getElementById("TnxType").value;
        var DrAmt = parseFloat(0); var CrAmt = parseFloat(0);
        for(var i=0; i<table.rows.length;i++){
            var Dr=parseFloat(table.rows[i].cells[4].children[0].value) || 0;
            var Cr=parseFloat(table.rows[i].cells[5].children[0].value) || 0;
            var COACode = table.rows[i].cells[2].children[0].value;
            //alert(COACode);

            if(TnxType=='C' && COACode=='10101001'){
                //alert(table.rows[i].cells[4].children[0].value);
                //table.rows[i].cells[3].children[0].removeAttribute("required");
                table.rows[i].cells[3].children[0].value=table.rows[0].cells[3].children[0].value;
                table.rows[i].cells[4].children[0].value=CrAmt;
                table.rows[i].cells[5].children[0].value=DrAmt;

            }
            if((Dr>0 && Cr>0) || (Dr==0 && Cr==0)){
                //Cr=0;
                alert('Each entry should have one contra.');
                table.rows[i].cells[4].children[0].style.borderColor='red';
                table.rows[i].cells[5].children[0].style.borderColor='red';
                return false;
            }else{
                table.rows[i].cells[4].children[0].style.borderColor='#ced4da';
                table.rows[i].cells[5].children[0].style.borderColor='#ced4da';
            }


            DrAmt += Dr; CrAmt += Cr;

        }
        document.getElementById('totalDR').value=DrAmt.toFixed(2);
        document.getElementById('totalCR').value=CrAmt.toFixed(2);
        if(VrDate== ""){
            alert("Voucher Date should not be blank!");
            return false;
        }
        // if((TnxType == 'C')){

        // }
        if(DrAmt+CrAmt == 0){
            alert("Debit and Credit amount should not be blank!");
            return false;
        }
        if((TnxType == 'T' && DrAmt != CrAmt)){
            alert("Debit and Credit amount should be equal!");
            document.getElementById('totalDR').style.borderColor='red';
            document.getElementById('totalCR').style.borderColor='red';
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
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        //alert(row);
        var colCount = table.rows[0].cells.length;

        for(var i=0; i<colCount; i++) {

            var newcell	= row.insertCell(i);

            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            //newcell.childNodes[0].value;
            switch(newcell.childNodes[0].type) {
                case "text":
                        (newcell.childNodes[0].name=='vrNo') ? newcell.childNodes[0].value++ : newcell.childNodes[0].value = "";
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
    function coAccount(c){
        //alert(c.value);
        var table=document.getElementById("accTrxTblBody");
        var TnxType=document.getElementById("TnxType").value;
        for(var i=0; i<table.rows.length;i++){
            var COACode = table.rows[i].cells[2].children[0].value;
            if(TnxType=='C' && COACode=='10101001'){
                table.rows[i].cells[3].children[0].removeAttribute("required");
            }else{
                table.rows[i].cells[3].children[0].setAttribute("required", "true");
            }
        }

    }
    function mendatoryFieldBesedOnTnxType(TnxType){
        var table=document.getElementById("accTrxTblBody");
        //var TnxType=document.getElementById("TnxType").value;
        //alert(TnxType.value);

            for(var i=0; i<table.rows.length;i++){
                var COACode = table.rows[i].cells[2].children[0].value;
                if(TnxType.value=='C' && COACode=='10101001'){
                    table.rows[i].cells[3].children[0].removeAttribute("required");
                }else{
                    table.rows[i].cells[3].children[0].setAttribute("required", "true");
                }

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

                        <form onsubmit="return fromSubmit(this);" method="POST" action="{{ route('transaction-account-store') }}" >
                            @csrf
                            @method('POST')
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="form-group row">

                                            <label for="TnxType" class="col-md-2 col-form-label text-md-left">{{ __('Entry Type') }}&nbsp;<span class="mandatory">*</span></label>
                                            <div class="col-md-4">
                                                <select id="TnxType" class="custom-select form-control @error('TnxType') is-invalid @enderror" name="TnxType" required autofocus onchange="return mendatoryFieldBesedOnTnxType(this);">

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
                                                <input id="voucherDate" type="text" class="form-control input-sm @error('voucherDate') is-invalid @enderror" name="voucherDate" value="{{ isset($vrDate->TnxDate)?$vrDate->TnxDate:'' }}" disabled autocomplete="voucherDate" autofocus>
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
                                                    <th class="w-30">Account Code</th>
                                                    <th class="w-40">Particulars</th>
                                                    <th class="w-10">Debit</th>
                                                    <th class="w-10">Credit</th>
                                                  </tr>
                                                </thead>
                                                <tbody id="accTrxTblBody">
                                                    <tr>
                                                        <td ><input type="checkbox"  name="chk"></td>
                                                        <td ><input type="text" class="form-control form-control-sm" id="vrNo" name="vrNo" value="{{ $vrNo->VoucherNo}}" disabled /></td>
                                                        <td >
                                                            <select id="accountCode" class="custom-select form-control form-control-sm" name="accountCode[]" required autofocus onchange="return coAccount(this);">
                                                                @foreach ($COA as $key => $value)
                                                                    <option value="{{ $value->COACode }}" >{{ $value->COACode.' - '. $value->AccountName }}</option>
                                                                @endforeach
                                                            </SELECT>
                                                        </td>
                                                        <td ><INPUT type="text" class="form-control form-control-sm" name="Particulars[]" required/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="DrAmt" name="DrAmt[]" value=""  placeholder="0.00"/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="CrAmt" name="CrAmt[]" value="" placeholder="0.00"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td ><input type="checkbox"  name="chk"></td>
                                                        <td ><input type="text" class="form-control form-control-sm" id="vrNo" value="{{ $vrNo->VoucherNo}}" disabled /></td>
                                                        <td >
                                                            <select id="accountCode" class="custom-select form-control" name="accountCode[]" required autofocus onchange="return coAccount(this);">
                                                                @foreach ($COA as $key => $value)
                                                                    <option value="{{ $value->COACode }}" >{{ $value->COACode.' - '. $value->AccountName }}</option>
                                                                @endforeach
                                                            </SELECT>
                                                        </td>
                                                        <td ><INPUT type="text" class="form-control form-control-sm" name="Particulars[]" required/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="DrAmt" name="DrAmt[]" value=""  placeholder="0.00"/></td>
                                                        <td ><INPUT class="form-control form-control-sm text-right" type="text" id="CrAmt" name="CrAmt[]" value="" placeholder="0.00"/></td>
                                                    </tr>
                                                </tbody>
                                                    <tr >
                                                        <th class="w-35 text-right"colspan="4">Total Sum : </th>
                                                        <th class="w-10 text-right"><input class="form-control form-control-sm text-right font-weight-bold" type="text" id="totalDR" value="0.00" readonly placeholder="0.00"/></th>
                                                        <th class="w-10 text-right"><input class="form-control form-control-sm text-right font-weight-bold" type="text" id="totalCR" value="0.00" readonly placeholder="0.00"/></th>
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
                                            <button type="reset" class="btn btn-primary"><i class="fas fa-broom"></i>{{ __('Clear') }}</button>
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
