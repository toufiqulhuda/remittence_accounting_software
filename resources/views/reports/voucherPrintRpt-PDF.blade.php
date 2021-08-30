<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
    @page { margin: 15px 50px 15px 50px; }
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    .exhouse-title{}
    .exhouse-address{}
    table{
        width: 100%;
        font-size: 9pt;
        border-collapse: collapse;
        border-spacing: 0px;
        /* border: 1px solid red; */

    }
    table th,table td {
        /* border: 1px solid red; */
        margin: 0px;
        padding: 5px;
    }
    .sub-grp-dtls{
        font-size: 8.5pt;
    }
    .border-bottom{ border-bottom: 1px solid #000; }
    .border-left{ border-left: 1px solid #000; }
    .border-right{ border-right: 1px solid #000; }
    .border-top{ border-top: 1px solid #000; }

</style>
</head>
<body>

@if(isset($tnxs))
    @foreach ($tnxs as $tnx)
        @if ($tnx->DrAmt != 0)
        @if(isset($exHouseDtls))
            <h3 style="text-align: center;font-size: 12pt">{{$exHouseDtls->ExHouseName}}</h3>
            <p style="text-align: center;font-size: 8.5pt">{{$exHouseDtls->Address}}</p>
        @endif
            <p style="text-align: center;font-size: 8.5pt">Debit Voucher ({{($tnx->TnxType=='T') ? 'Transfer' : 'Cash'}})</p>
            <table >
                <tr>
                    <th style="width: 10%; text-align: left;" class="border-bottom">Head {{$tnx->COACode}}</th>
                    {{-- <th style="width: 5%; text-align: left;"class="border-bottom"></th> --}}
                    <th style="width: 55%; text-align: left; " class="border-bottom">{{$tnx->AccountName}}</th>
                    <th style="width: 15%; text-align: center;" class="border-bottom">Voucher No: {{$tnx->VoucherNo}}</th>
                    <th style="width: 25%; text-align: center; "class="border-bottom">Date: {{$tnx->VoucherDate}}</th>
                </tr>
                 <tr>
                    <th colspan="2" style="width: 60%; text-align: center; " class="border-bottom border-left border-right">Particulars</th>
                    <th style="width: 15%; text-align: center; " class="border-bottom border-left border-right">Foreign Currency</th>
                    <th style="width: 25%; text-align: center;" class="border-bottom border-left border-right">Local Currency</th>
                </tr>
                <tr>
                    <td colspan="2" style="width: 60%;  height: 100px; vertical-align: top; text-align: left;" class="border-bottom border-left border-right">{{$tnx->Particulars}}</td>
                    <td style="width: 15%; text-align: right; vertical-align: top;" class="border-bottom border-left border-right"></td>
                    <td style="width: 25%; text-align: right; vertical-align: top;" class="border-bottom border-left border-right">{{$tnx->DrAmt}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 60%; text-align: left;"></td>
                    <td style="width: 15%; text-align: right;">Total</td>
                    <td style="width: 25%; text-align: right;">{{$tnx->DrAmt}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 100%; text-align: left; text-transform: uppercase" class="border-bottom">TOTAL (IN WORDS) : {{NumConvert::word($tnx->DrAmt)}} DOLLAR</td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 80%; text-align: right;"></td>
                    <td style="width: 25%; text-align: left;" class="border-left"><b>Contra</b></td>
                </tr>
                <tr>
                    <td style="width: 10%; height: 70px; text-align: right;"></td>
                    <td colspan="2" style="width: 70%; height: 30px; text-align: right;"></td>
                    <td style="width: 25%; height: 30px; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width:10%;text-align: center;" class="border-top"><b>Authorized Officer</b></td>
                    <td colspan="2" style="width:70%;  text-align: center; border-top:0px;" ></td>
                    <td style="width:25%; text-align: center;" class="border-top"><b>Authorized Officer</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="width:100%; height: 30px;text-align: center;"></td>
                </tr>
            </table>
        @elseif($tnx->CrAmt != 0)
        @if(isset($exHouseDtls))
            <h3 style="text-align: center;font-size: 12pt">{{$exHouseDtls->ExHouseName}}</h3>
            <p style="text-align: center;font-size: 8.5pt">{{$exHouseDtls->Address}}</p>
        @endif
            <p style="text-align: center;font-size: 8.5pt">Credit Voucher ({{($tnx->TnxType=='T') ? 'Transfer' : 'Cash'}})</p>
            <table >
                <tr>
                    <th style="width: 10%; text-align: left;" class="border-bottom">Head {{$tnx->COACode}}</th>
                    {{-- <th style="width: 5%; text-align: left;"class="border-bottom"></th> --}}
                    <th style="width: 55%; text-align: left; " class="border-bottom">{{$tnx->AccountName}}</th>
                    <th style="width: 15%; text-align: center;" class="border-bottom">Voucher No: {{$tnx->VoucherNo}}</th>
                    <th style="width: 25%; text-align: center; "class="border-bottom">Date: {{$tnx->VoucherDate}}</th>
                </tr>
                 <tr>
                    <th colspan="2" style="width: 60%; text-align: center; " class="border-bottom border-left border-right">Particulars</th>
                    <th style="width: 15%; text-align: center; " class="border-bottom border-left border-right">Foreign Currency</th>
                    <th style="width: 25%; text-align: center;" class="border-bottom border-left border-right">Local Currency</th>
                </tr>
                <tr>
                    <td colspan="2" style="width: 60%;  height: 100px; vertical-align: top; text-align: left;" class="border-bottom border-left border-right">{{$tnx->Particulars}}</td>
                    <td style="width: 15%; text-align: right; vertical-align: top;" class="border-bottom border-left border-right"></td>
                    <td style="width: 25%; text-align: right; vertical-align: top;" class="border-bottom border-left border-right">{{$tnx->CrAmt}}</td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 60%; text-align: left;"></td>
                    <td style="width: 15%; text-align: right;">Total</td>
                    <td style="width: 25%; text-align: right;">{{$tnx->CrAmt}}</td>
                </tr>
                <tr>
                    <td colspan="4" style="width: 100%; text-align: left; text-transform: uppercase" class="border-bottom">TOTAL (IN WORDS) : {{NumConvert::word($tnx->CrAmt)}} DOLLAR</td>
                </tr>
                <tr>
                    <td colspan="3" style="width: 80%; text-align: right;"></td>
                    <td style="width: 25%; text-align: left;" class="border-left"><b>Contra</b></td>
                </tr>
                <tr>
                    <td style="width: 10%; height: 70px; text-align: right;"></td>
                    <td colspan="2" style="width: 70%; height: 30px; text-align: right;"></td>
                    <td style="width: 25%; height: 30px; text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width:10%;text-align: center;" class="border-top"><b>Authorized Officer</b></td>
                    <td colspan="2" style="width:70%;  text-align: center; border-top:0px;" ></td>
                    <td style="width:25%; text-align: center;" class="border-top"><b>Authorized Officer</b></td>
                </tr>
                <tr>
                    <td colspan="4" style="width:100%; height: 30px;text-align: center;"></td>
                </tr>
            </table>
        @endif
    @endforeach
@endif

</body>
</html>

