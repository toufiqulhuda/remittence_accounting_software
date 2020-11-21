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
                                                        <select id="TnxType" class="form-control @error('TnxType') is-invalid @enderror" name="TnxType" required autofocus>

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
                                                        <input id="voucherDate" type="datetime-local" class="form-control input-sm @error('voucherDate') is-invalid @enderror" voucherDate="voucherDate" value="{{ old('voucherDate') }}" required autocomplete="voucherDate" autofocus>
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
                                                    <td ><INPUT class="form-control form-control-sm text-right" type="text" name="DrAmt[]" placeholder="0.00"/></td>
                                                    <td ><INPUT class="form-control form-control-sm text-right" type="text" name="CrAmt[]" placeholder="0.00"/></td>
                                                  </tr>
                                                </tbody>
                                                    <tr >
                                                        <!--<td class="w-5"></td>
                                                        <td class="w-5"></td>
                                                        <td class="w-35"> </td>-->
                                                        <td class="w-35 text-right"colspan="4">Total Sum : </td>
                                                        <td class="w-10 text-right"><div>0.00</div></td>
                                                        <td class="w-10 text-right"><div>0.00</div></td>
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
                        {{-- &nbsp;<hr>&nbsp;
                        <div class="table-responsive">
                            <table id="roleTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Role Name</th>
                                        <th>Created By</th>
                                        <th>Create Date</th>
                                        <th>Updated By</th>
                                        <th>Updated Date</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($roles))
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->CreatedBy }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->UpdatedBy }}</td>
                                    <td>{{ $role->updated_at }}</td>
                                    <td>
                                        <input type="checkbox"  name="isactive" id="isactive-{{$role->roleid}}" value="{{ $role->isactive }}"
                                        {{ ($role->isactive)? ' checked': '' }}
                                        onclick="changeStatus(event.target, {{ $role->roleid }});">
                                    </td>
                                    <td>
                                        <!--<form action="" method="POST">-->
                                            <a class="badge badge-primary" href="{{ route('roles.edit',$role->roleid) }}">Edit</a>

                                            @csrf
                                            <!-- @@method('DELETE') -->

                                            <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                                        <!--</form>-->
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /dataTable --> --}}
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
