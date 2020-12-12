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
    }
    /* .grp-dtls th,.grp-dtls td { border: 1px solid red;} */
    .sub-grp-dtls{
        font-size: 8.5pt;
    }

</style>
</head>
<body>
@if(isset($exHouseDtls))
    <h3 style="text-align: center;font-size: 12pt">{{$exHouseDtls->ExHouseName}}</h3>
    <p style="text-align: center;font-size: 8.5pt">{{$exHouseDtls->Address}}</p>
@endif
@if(isset($accMains))
    @foreach ($accMains as $accMain)
        <div style="font-weight: bold;text-align: left; margin-left: 145px; font-size: 11.5pt">{{$accMain->acctHdName}}</div>
            <table >
            @foreach ($accGrps as $accGrp)
                @if($accGrp->AccHdID==$accMain->AccHdID)

                        <tr>
                            <th style="width: 12%; text-align: left;">Group Detail:</th>
                            <th style="width: 8%; text-align: left;">{{$accGrp->AccGrCode}}</th>
                            <th style="width: 80%; text-align: left;">{{$accGrp->AccGrName}}</th>
                        </tr>
                        <tr >
                            <td colspan="3">
                                @foreach ($accSbGrps as $accSbGrp)
                                    @if($accGrp->AccGrID==$accSbGrp->AccGrID)
                                        <table >
                                            <tr>
                                                <td style="width: 12%; text-align: left; border-bottom: 1px solid #000;">Sub Detail:</td>
                                                <td style="width: 8%; text-align: left; border-bottom: 1px solid #000;">{{$accSbGrp->AccSbGrCode}}</td>
                                                <td style="width: 80%; text-align: left; border-bottom: 1px solid #000;">{{$accSbGrp->AccSbGrName}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <table >
                                                        @foreach ($accCOAs as $accCOA)
                                                            @if($accSbGrp->AccSbGrID==$accCOA->AccSbGrID)
                                                                <tr >
                                                                    <td style="width: 10%; text-align: left;">{{$accCOA->COACode}}</td>
                                                                    <td style="width: 90%; text-align: left;">{{$accCOA->AccountName}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                <td>
                                            </tr>
                                        </table>
                                    @endif

                                @endforeach
                            </td>
                        </tr>
                @endif

            @endforeach
            </table><br>


    @endforeach
@endif

</body>
</html>

