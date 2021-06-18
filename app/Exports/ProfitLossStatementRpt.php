<?php

namespace App\Exports;

use App\Models\Exhouse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProfitLossStatementRpt implements FromView
{

    public function __construct($frmDate,$toDate,$reportName,$account,$Type)
    {
        $this->frmDate = $frmDate;
        $this->toDate = $toDate;
        $this->reportName = $reportName;
        $this->account = $account;
        $this->TnxType = $Type;
    }

    public function view(): View
    {
        return view('reports.'.$this->reportName.'-PDF',
            [
                'frmDate'=>$this->frmDate,
                'toDate'=>$this->toDate,
                'TnxType'=>$this->TnxType,
                'exHouseDtls' => Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first(),
                'tnxs' => DB::table('transactions AS t')
                        ->select('mh.AccHdID','mh.AcctHdName','gr.AccGrName','coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'),DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->leftJoin('account_sub_group_detail AS sgr','sgr.AccSbGrID','=','coa.AccSbGrID')
                        ->leftJoin('account_group_detail AS gr','gr.AccGrID','=','sgr.AccGrID')
                        ->leftJoin('account_main_head AS mh','mh.AccHdID','=','gr.AccHdID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->whereIn('mh.AccHdID',[3,4])
                        ->whereBetween('t.VoucherDate',[$this->frmDate,$this->toDate])
                        ->groupBy('mh.AccHdID','mh.AcctHdName','gr.AccGrName','coa.AccountName')
                        ->get()

            ]
        );
    }
}
