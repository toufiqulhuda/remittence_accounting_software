<?php

namespace App\Exports;

use App\Models\Exhouse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionJournalRpt implements FromView
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
                            ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%b-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                            ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                            ->where('t.STATUS','=','1')
                            ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                            ->whereIn('t.TnxType',$this->TnxType)
                            ->whereBetween('t.VoucherDate',[$this->frmDate,$this->toDate])
                            ->orderBy('t.VoucherDate', 'ASC')
                            ->get()

            ]
        );
    }
}
