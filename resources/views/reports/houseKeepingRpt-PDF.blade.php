<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
@foreach ($exHouseDtls as $item)
    <h3 style="text-align: center;">{{$item->ExHouseName}}</h3>
    <p style="text-align: center;">{{$item->Address}}</p>
@endforeach
@if(isset($accMains))
    @foreach ($accMains as $accMain)
        <div style="font-weight: bold;text-align: center;">{{$accMain->acctHdName}}</div>
        @foreach ($accGrps as $accGrp)
            @if($accGrp->AccHdID==$accMain->AccHdID)
                <table>
                    <th>
                        <td>Group Detail:</td>
                        <td>{{$accGrp->AccGrCode}}</td>
                        <td>{{$accGrp->AccGrName}}</td>
                    </th>
                </table>
            @endif
        @endforeach
    @endforeach
@endif

</body>
</html>
{{--
@extends('layouts.withHF')

@section('content')



<style rel="stylesheet">

    #coaAccTable_wrapper .dt-button{
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
                <div class="card-header"><i class="far fa-plus-square"></i>&nbsp;{{ __('Add Chart Of Account') }}</div>

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

                        <div class="col-md-12 p-1 float-left" >
                            <div class="card mb-3">
                                <div class="card-body">

                        <div class="table-responsive">
                            <table id="coaAccTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>COA Code</th>
                                        <th>Account Name</th>
                                        <th>SubGroup Name</th>
                                        <th>Group Name</th>
                                        <th>Account Head</th>
                                        <th>Exchange Name</th>
                                        <th>Created By</th>
                                        <th>Create Date</th>
                                        <th>Updated By</th>
                                        <th>Updated Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <!-- /dataTable -->
                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection --}}
