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
    <p style="text-align: center;font-size: 9pt">Cash Book As On:  <b>{{date('d-m-Y', strtotime($frmDate)) }}</b> </p>
    <p style="text-align: center;font-size: 9pt">Print Date: <b>{{date('d/m/Y')}}</b></p>

 @if(isset($Debit) && isset($Credit))
 @php $BfBal = 0; $totalDrAmt=0; $totalCrAmt=0; //$Balance=0;
 @endphp

        <table >
            <thead>
                <tr>
                    <th class="border-bottom border-top border-left  text-left" style="width:30%">Debit</th>
                    <th class="border-bottom border-top  text-left" style="width:20%"></th>
                    <th class="border-bottom border-top border-left text-left" style="width:30%">Credit</th>
                    <th class="border-bottom border-top border-right text-right" style="width:20%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="border-right border-bottom border-left" style="width:50%">
                        <table>
                        @foreach ($Debit as $Debit_data)
                        @php
                            $totalDrAmt += $Debit_data->DrAmt;
                            //$totalCrAmt += $Debit_data->CrAmt;

                        @endphp
                        <tr>

                            <td class=" text-left" style="width:25%">{{$Debit_data->AccountName}}</td>
                            <td class=" text-right" style="width:25%">{{number_format($Debit_data->DrAmt,2)}}</td>
                            {{--<td class=" text-right" style="width:25%">$Debit_data->AccountName</td>--}}
                            {{-- <td class=" text-right" style="width:25%">$Debit_data->CrAmt</td> --}}

                        </tr>
                        @endforeach
                        </table>
                    </td>

                    <td colspan="2" class="border-right border-bottom" style="width:50%">
                        <table>
                        @foreach ($Credit as $Credit_data)
                        @php
                            //$totalDrAmt += $Debit_data->DrAmt;
                            $totalCrAmt += $Credit_data->CrAmt;

                        @endphp
                        <tr>

                            <td class=" text-left" style="width:25%">{{$Credit_data->AccountName}}</td>
                            <td class=" text-right" style="width:25%">{{number_format($Credit_data->CrAmt,2)}}</td>
                            {{-- <td class=" text-right" style="width:25%">{{--$Debit_data->AccountName</td> --}}
                            {{-- <td class=" text-right" style="width:25%">$Debit_data->CrAmt</td> --}}

                        </tr>
                        @endforeach
                        </table>
                    </td>
                </tr>


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
                    <td class="  text-right">Closing Balance:</td>
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

