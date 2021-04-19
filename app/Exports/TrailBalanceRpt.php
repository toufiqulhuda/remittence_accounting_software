<?php

namespace App\Exports;

use App\Models\Exhouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TrailBalanceRpt implements FromView
{

    public function __construct($frmDate,$reportName)
    {
        $this->frmDate = $frmDate;
        $this->reportName = $reportName;

    }

    public function view(): View
    {
        return view('reports.'.$this->reportName.'-PDF',
            [
                'frmDate'=>$this->frmDate,
                'exHouseDtls' => Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first(),
                'tnxs' => DB::table('transactions AS t')
                        ->select('ag.AccGrName','coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'),DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->Join('account_sub_group_detail AS asg','asg.AccSbGrID','=','coa.AccSbGrID')
                        ->Join('account_group_detail AS ag' , 'ag.AccGrID','=', 'asg.AccGrID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate',$this->frmDate)
                        ->groupBy('ag.AccGrName','coa.AccountName')
                        ->get()

            ]
        );
    }
}
