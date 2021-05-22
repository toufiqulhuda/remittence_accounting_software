<?php

namespace App\Exports;

use App\Models\Exhouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StatAffairsDetailRpt implements FromView
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
                'Tnxs' => DB::table('transactions AS t')
                            ->select('ah.AccHdID','t.COACode','coa.AccountName',
                            DB::raw('case
                                        when ah.AccHdID =1 then
                                            nvl(ye.Balance,0)+sum(t.DrAmt) - sum(t.CrAmt)
                                        when ah.AccHdID = 4 then
                                            nvl(ye.Balance,0)+sum(t.DrAmt) - sum(t.CrAmt)
                                        when ah.AccHdID = 2 then
                                            nvl(ye.Balance,0)+sum(t.CrAmt) - sum(t.DrAmt)
                                        when ah.AccHdID = 3 then
                                            nvl(ye.Balance,0)+sum(t.CrAmt) - sum(t.DrAmt)
                                        END AS Balance'))
                            ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                            ->JOIN ('account_sub_group_detail AS asg', 'asg.AccSbGrID','=','coa.AccSbGrID')
                            ->JOIN ('account_group_detail AS ag' , 'ag.AccGrID','=','asg.AccGrID')
                            ->JOIN ('account_main_head AS ah',  'ah.AccHdID','=','ag.AccHdID')
                            ->leftJOIN ('year_closing_details AS ye' , 'ye.COACode','=','t.COACode')
                            ->where('t.STATUS','=','1')
                            ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                            ->whereBetween('t.VoucherDate',[DB::raw("DATE_FORMAT('".$this->frmDate."' ,'%Y-01-01')"),$this->frmDate])
                            ->groupBy ('t.COACode')
                            ->orderBy('t.COACode','asc')
                            ->orderBy('t.VoucherDate','asc')
                            ->get()

            ]
        );
    }
}
