<?php

namespace App\Http\Controllers;
use App\Models\Exhouse;
use App\Models\AccountGroup;
use App\Models\AccountSubGroup;
use App\Models\ChartOfAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    public function houseKeepingPDF(){
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        $accMains = DB::table('account_main_head')->select('AccHdID','acctHdName')->get();
        $accGrps = AccountGroup::select('AccGrID','AccGrCode','AccGrName','AccHdID')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        $accSbGrps = AccountSubGroup::select('AccSbGrID','AccSbGrCode','AccSbGrName','AccGrID')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        $accCOAs = ChartOfAccount::select('COACode','AccountName','AccSbGrID')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        //dd($accMains);
        //return view('reports.houseKeepingRpt-PDF',compact('exHouseDtls','accMains','accGrps','accSbGrps','accCOAs'));

        $pdf = PDF::loadView('reports.houseKeepingRpt-PDF',compact('exHouseDtls','accMains','accGrps','accSbGrps','accCOAs') );
        return $pdf->download('ChartOfAccount-'.Auth::user()->ExHouseID.'.pdf');

    }
}
