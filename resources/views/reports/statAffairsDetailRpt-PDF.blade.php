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
    <p style="text-align: center;font-size: 9pt">Statement of Affairs As On:  <b>{{date('d-m-Y', strtotime($frmDate)) }}</b> </p>
    <p style="text-align: center;font-size: 9pt">Print Date: <b>{{date('d/m/Y')}}</b></p>

@if(isset($Tnxs))
 @php $BfBal = 0; $totalDrAmt=0; $totalCrAmt=0; //$Balance=0;
 $accountHead = array('2','3');
 @endphp

        <table >
            <thead>
                <tr>
                    <th class="border-bottom border-top border-left text-center" style="width:30%">Capital & Liabilities</th>
                    <th class="border-bottom border-top border-left text-center" style="width:20%">Amount</th>
                    <th class="border-bottom border-top border-left text-center" style="width:30%">Assets</th>
                    <th class="border-bottom border-top border-left border-right text-center" style="width:20%">Amount</th>
                </tr>
            </thead>
            <tbody>
                @dd($Tnxs);
                @foreach ($Tnxs as $Tnx )
                @dd($Tnx->AccHdID);
                <tr>
                    @if(in_array($Tnx->AccHdID,$accountHead))

                    <td class="border-right border-bottom border-left" >
                        {{$Tnx->AccHdID}}
                    </td>

                    <td class="border-right border-bottom text-right" >
                        {{$Tnx->AccHdID}}
                    </td>
                    @else

                    <td class="border-right border-bottom border-left" >
                        {{$Tnx->AccHdID}}
                    </td>

                    <td class="border-right border-bottom text-right" >
                        {{$Tnx->AccHdID}}
                    </td>
                    @endif
                </tr>
                @endforeach

                <tr>
                    <td colspan="4"   ></td>
                </tr>
                <tr>
                    <td ></td>
                    <td class="  text-right"  >{{number_format($totalDrAmt,2)}}</td>
                    <td></td>
                    <td class="  text-right" >{{number_format($totalCrAmt,2)}}</td>
                </tr>
                <tr>
                    <td ></td>
                    <td class="border-bottom  text-right">0.00</td>
                    <td></td>
                    <td class="border-bottom  text-right"> {{number_format($totalDrAmt-$totalCrAmt,2)}}</td>
                </tr>
                <tr>
                    <td ></td>
                    <td class="border-bottom  text-right"  >{{number_format($totalDrAmt,2)}}</td>
                    <td></td>
                    <td class="border-bottom  text-right" >{{number_format($totalCrAmt+($totalDrAmt-$totalCrAmt),2)}}</td>
                </tr>
                <tr>
                    <td ></td>
                    <td class="border-bottom  text-right"  ></td>
                    <td></td>
                    <td class="border-bottom  text-right" ></td>
                </tr>
                <tr>
                    <td colspan="4"  ></td>
                </tr>

            </tbody>
            <tfoot>

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

