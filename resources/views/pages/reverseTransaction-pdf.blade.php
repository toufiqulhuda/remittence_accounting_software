@extends('layouts.withoutHF')

@section('content')

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
                            <div class="col-md-12 p-1 float-left" >
                                <div class="card mb-0">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id="accTrxRevTbl" class="table table-bordered table-sm">
                                                <thead>
                                                  <tr >
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
                                                    @foreach ($tnxs  as $tnx)
                                                    <tr >
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
                                              </table>

                                        </div>

                                    </div>
                                </div>
                            </div>


                        <!-- dataTable -->

                    <!-- /contect -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
