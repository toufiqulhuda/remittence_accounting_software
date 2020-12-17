<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
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

    .text-center{text-align: center;}
    .text-left{text-align: left;}
    .text-right{text-align: right;}


</style>
</head>
<body>
    <h3 style="text-align: center;font-size: 12pt">{{$exHouseDtls->ExHouseName}}</h3>
    <h4 style="text-align: center;font-size: 10pt">{{$exHouseDtls->Address}}</h4>
    <p style="text-align: center;font-size: 9pt">Account Name and Code:{{$accountNameCode->COACode.'-'.$accountNameCode->AccountName}}</p>
    <p style="text-align: center;font-size: 9pt">Statement from:  <b>{{date('d-m-Y', strtotime($frmDate)) }}   to  {{date('d-m-Y', strtotime($toDate))}} </b> Print Date: <b>{{date('d/m/Y')}}</b></p>

 @if(isset($tnxs))
 @php $BfBal = 0; $totalDrAmt=0; $totalCrAmt=0; $Balance=0;
 @endphp

        <table >
            <thead>
                <tr>
                    <th class="border-bottom border-left border-top text-center">Vr Date</th>
                    <th class="border-bottom border-top text-center">VrNo</th>
                    <th class="border-bottom border-top text-center">Particulars</th>
                    <th class="border-bottom border-top text-right">Debit</th>
                    <th class="border-bottom border-top text-right">Credit</th>
                    <th class="border-bottom border-right border-top text-right ">Balance</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">--B/F--</td>
                    <td class="text-right">{{$BfBal}}</td>
                </tr>

                @foreach ($tnxs as $tnx)
                @php
                    $totalDrAmt += $tnx->DrAmt;
                    $totalCrAmt += $tnx->CrAmt;
                    $Balance += $BfBal+$tnx->DrAmt-$tnx->CrAmt
                @endphp
                <tr>
                    <td class="text-center">{{$tnx->VoucherDate}}</td>
                    <td class="text-center">{{$tnx->VoucherNo}}</td>
                    <td class="text-left">{{$tnx->Particulars}}</td>
                    <td class="text-right">{{$tnx->DrAmt}}</td>
                    <td class="text-right">{{$tnx->CrAmt}}</td>
                    <td class="text-right">{{$Balance}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="border-bottom"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                </tr>
                <tr>
                    <td class="text-right">Total Debit: </td>
                    <td class="text-left">{{$totalDrAmt}}</td>
                    <td class="text-right">Total Credit:</td>
                    <td class="text-left">{{$totalCrAmt}}</td>
                    <td class="text-right">Balance:</td>
                    <td class="text-left">{{$Balance}}</td>
                </tr>
                <tr>
                    <td style="height: 50px;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" class="border-top text-center"><b>Authorized Officer</b></td>
                    <td colspan="2" ></td>
                    <td colspan="2" class="border-top text-center"><b>Authorized Officer</b></td>
                </tr>
            </tfoot>


        </table>


@endif

</body>
</html>

