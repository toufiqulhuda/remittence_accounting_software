<?php

namespace App\Exports;

use App\Models\Exhouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DailyCashBookRpt implements FromView
{

    public function __construct($frmDate,$reportName)
    {
        $this->frmDate = $frmDate;
        $this->reportName = $reportName;

    }

    public function view(): View
    {
        $DebitUnion = DB::table('transactions AS t')
                    ->select('coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'))
                    ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                    ->where('t.STATUS','=','1')
                    ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                    ->where('t.VoucherDate',$this->frmDate)
                    ->where('t.TnxType','C')
                    ->where('t.DrAmt','<>','0.00')
                    ->groupBy('coa.AccountName');

        return view('reports.'.$this->reportName.'-PDF',
            [
                'frmDate'=>$this->frmDate,
                'exHouseDtls' => Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first(),
                'Debit' => DB::table('transactions AS t')
                        ->select(DB::raw('"-BF-" AS AccountName'),DB::raw('sum(t.DrAmt) AS DrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate','<',$this->frmDate)
                        ->where('t.TnxType','C')
                        ->union($DebitUnion)->get(),

                'Credit' => DB::table('transactions AS t')
                        ->select('coa.AccountName',DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate',$this->frmDate)
                        ->where('t.TnxType','C')
                        ->where('t.CrAmt','<>','0.00')
                        ->groupBy('coa.AccountName')
                        ->get()

            ]
        );
    }
}
