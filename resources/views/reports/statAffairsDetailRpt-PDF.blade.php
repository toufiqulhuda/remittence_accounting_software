<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
    @page { margin: 15px 50px 15px 50px; }

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
 //$accountHead = array('2','3');
$finalData = array();
$capital = array();
$assets = array();
$a=0;
$c=0;
 @endphp
@foreach ($Tnxs as $key => $Tnx )
@if(in_array($Tnx->AccHdID,array(1,4)) && $Tnx->Balance > 0)
@php
    $assets [$a]= array($Tnx->AccountName,$Tnx->Balance);
    $a++;
@endphp
@elseif (in_array($Tnx->AccHdID,array(2,3)) && $Tnx->Balance > 0)
@php
    $capital [$c]= array($Tnx->AccountName,$Tnx->Balance);
    $c++;
@endphp
@elseif (in_array($Tnx->AccHdID,array(1,4)) && $Tnx->Balance < 0)
@php
    $capital [$c]= array($Tnx->AccountName,abs($Tnx->Balance));
    $c++;
@endphp
@elseif (in_array($Tnx->AccHdID,array(2,3)) && $Tnx->Balance < 0)
@php
    $assets [$a]= array($Tnx->AccountName,abs($Tnx->Balance));
    $a++;
@endphp
@endif
@endforeach

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
                <tr>
                    <td colspan="2" class="border-top  border-bottom text-center border-left">
                        <table style="width: 100%">
                            @foreach ($capital as $cap )
                            @php
                                $totalDrAmt += $cap[1];
                            @endphp
                            <tr>
                                <td class="border-bottom  border-top border-right text-left" style="width: 60%">{{$cap[0]}}</td>
                                <td class="border-bottom  border-top text-right" style="width: 40%">{{number_format($cap[1],2)}}</td>

                            </tr>
                            @endforeach
                        </table>

                    </td>
                    <td colspan="2" class="border-top border-bottom text-center border-left border-right">
                        <table style="width: 100%">
                            @foreach ($assets as $asset )
                            @php
                                $totalCrAmt += $asset[1];
                            @endphp
                            <tr>
                                <td class="border-bottom  border-right text-left" style="width: 60%">{{$asset[0]}}</td>
                                <td class="border-bottom  text-right" style="width: 40%">{{number_format($asset[1],2)}}</td>

                            </tr>
                            @endforeach
                        </table>
                    </td>




                </tr>


                <tr>
                    <td ></td>
                    <td class="border-bottom  text-right"  >{{number_format($totalDrAmt,2)}}</td>
                    <td></td>
                    <td class="border-bottom  text-right" >{{number_format($totalCrAmt,2)}}</td>
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

