<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
    @page { margin: 15px; }

    body{
        font-family: Arial, Helvetica, sans-serif;
        margin: 0px;
    }
    .exhouse-title{}
    .exhouse-address{}
    table{
        width: 100%;
        font-size: 8.5pt;
        border-collapse: collapse;
        border-spacing: 0px;
        /* border: 1px dashed black; */

    }
    table th,table td {
        /* border: 1px dashed black; */

        margin: 0px;
        padding: 2px;
    }
    .sub-grp-dtls{
        font-size: 8.5pt;
    }
    .border-bottom{ border-bottom: 1px dashed #000; }
    .border-left{ border-left: 1px dashed #000; }
    .border-right{ border-right: 1px dashed #000; }
    .border-top{ border-top: 1px dashed #000; }

    .text-center{text-align: center;}
    .text-left{text-align: left;}
    .text-right{text-align: right;}


</style>
</head>
<body>
    <h3 style="text-align: center;font-size: 12pt">{{$exHouseDtls->ExHouseName}}</h3>
    <h4 style="text-align: center;font-size: 10pt">{{$exHouseDtls->Address}}</h4>
    <p style="text-align: center;font-size: 9pt">Trial Balance Date As On:  <b>{{date('d-m-Y', strtotime($frmDate)) }}</b> </p>
    <p style="text-align: center;font-size: 9pt">Print Date: <b>{{date('d/m/Y')}}</b></p>

 @if(isset($tnxs))
 @php $BfBal = 0; $totalDrAmt=0; $totalCrAmt=0; //$Balance=0;
 @endphp

        <table >
            <thead>
                <tr>
                    <th class="border-bottom border-top border-left  text-left">Group Account Name</th>
                    <th class="border-bottom border-top  text-left">Account Name</th>
                    <th class="border-bottom border-top  text-right">Debit</th>
                    <th class="border-bottom border-top border-right text-right">Credit</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tnxs as $tnx)
                @php
                    $totalDrAmt += $tnx->DrAmt;
                    $totalCrAmt += $tnx->CrAmt;
                    //$Balance += $BfBal+$tnx->DrAmt-$tnx->CrAmt
                @endphp
                <tr>

                    <td class=" text-left" style="width:25%">{{$tnx->AccGrName}}</td>
                    <td class=" text-left" style="width:25%">{{$tnx->AccountName}}</td>
                    <td class=" text-right" style="width:25%">{{$tnx->DrAmt}}</td>
                    <td class=" text-right" style="width:25%">{{$tnx->CrAmt}}</td>

                </tr>
                @endforeach
                <tr>
                    <td colspan="4"   ></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="border-bottom border-top"> </td>
                    <td class="border-bottom border-top"> </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="  text-right"  >{{$totalDrAmt}}</td>
                    <td class="  text-right" >{{$totalCrAmt}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="border-bottom border-top"></td>
                    <td class="border-bottom border-top"></td>
                </tr>
                <tr>
                    <td colspan="4"  ></td>
                </tr>

            </tbody>
            <tfoot>
                {{-- <tr>
                    <td></td>
                    <td colspan="3" class="text-center"><b>Transaction Summary</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" >Total Debit Voucher:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" >Total Debit Amount:</td>
                    <td>{{$totalDrAmt}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" >Total Credit Voucher:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" >Total Credit Amount:</td>
                    <td>{{$totalCrAmt}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr> --}}
                <tr>
                    <td style="height: 50px;">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                </tr>
                <tr>
                    <td  class="border-top text-center"><b>Authorized Officer</b></td>
                    <td></td>
                    <td></td>
                    <td  class="border-top text-center"><b>Authorized Officer</b></td>
                </tr>
            </tfoot>


        </table>


@endif

</body>
</html>

