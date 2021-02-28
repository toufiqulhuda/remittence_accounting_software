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
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ReportsController extends Controller
{
    public function houseKeepingPDF(){
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $accMains = DB::table('account_main_head')->select('AccHdID','acctHdName')->get();
        $accGrps = AccountGroup::select('AccGrID','AccGrCode','AccGrName','AccHdID')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        $accSbGrps = AccountSubGroup::select('AccSbGrID','AccSbGrCode','AccSbGrName','AccGrID')->where('ExHouseID',Auth::user()->ExHouseID)->get();
        $accCOAs = ChartOfAccount::select('COACode','AccountName','AccSbGrID')->where('ExHouseID',Auth::user()->ExHouseID)->get();

        $view='reports.houseKeepingRpt-PDF';
        $data =compact('exHouseDtls','accMains','accGrps','accSbGrps','accCOAs');
        $reportName='ChartOfAccount-'.Auth::user()->ExHouseID;
        return $this->createPDF($view,$data,$reportName);

    }
    public function todaysRptView(){
        $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        $COA=ChartOfAccount::select('COACode','AccountName')->get();
        return view('reports.todaysRpt',compact('VoucherDate','COA'));
    }
    public function todaysRpt(Request $request){
        $data = $request->input();
        $frmDate=!empty($data['frmDate']) ? date('Y-m-d', strtotime($data['frmDate'])) : '';
        $toDate=!empty($data['toDate']) ? date('Y-m-d', strtotime($data['toDate'])) :'';
        $reportName=!empty($data['reportName']) ? $data['reportName'] :'';
        $account=!empty($data['account']) ? $data['account'] :'';
        $TnxType=!empty($data['TnxType']) ? $data['TnxType'] :'';
        //dd($TnxType);
        if($TnxType=="All"){
            $Type = array('T','C','D');
        }else if($TnxType=="T"){
            $Type=array('T');
        }else if($TnxType=="C"){
            $Type = array('C');
        }else{
            $Type = array();
        }
        //dd($Type);
        return $this->$reportName($frmDate,$toDate,$reportName,$account,$Type);
    }
    public function voucherPrintRpt($frmDate,$toDate,$reportName,$account=null,$TnxType=null){
        //dd($reportName);
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%b-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->whereBetween('t.VoucherDate',[$frmDate,$toDate])
                        ->get();
                        //dd($tnxs);
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','tnxs');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;
        return $this->createPDF($view,$data,$reportName);
        //return view($view,$data);
    }
    public function transactionJournalRpt($frmDate,$toDate,$reportName,$account=null,$TnxType){
        //dd($TnxType);
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%b-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->whereIn('t.TnxType',$TnxType)
                        ->whereBetween('t.VoucherDate',[$frmDate,$toDate])
                        ->get();
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','tnxs','frmDate','toDate','TnxType');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;
        return $this->createPDF($view,$data,$reportName);
        //return view($view,$data);
    }
    // public function transactionJournalTransferRpt(){}
    // public function transactionJournalCashRpt(){}
    public function profitLossStatementRpt($frmDate,$toDate,$reportName){
        //dd($reportName);
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('mh.AccHdID','mh.AcctHdName','gr.AccGrName','coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'),DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->leftJoin('account_sub_group_detail AS sgr','sgr.AccSbGrID','=','coa.AccSbGrID')
                        ->leftJoin('account_group_detail AS gr','gr.AccGrID','=','sgr.AccGrID')
                        ->leftJoin('account_main_head AS mh','mh.AccHdID','=','gr.AccHdID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->whereIn('mh.AccHdID',[3,4])
                        ->whereBetween('t.VoucherDate',[$frmDate,$toDate])
                        ->groupBy('mh.AccHdID','mh.AcctHdName','gr.AccGrName','coa.AccountName')
                        ->get();

        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','frmDate','toDate','tnxs');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;
        //return view($view,$data);
        return $this->createPDF($view,$data,$reportName);
    }
    public function accountTransactionSummaryRpt($frmDate,$toDate,$reportName,$account,$TnxType){
        //dd($reportName);
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $accountNameCode = ChartOfAccount::select("COACode","AccountName")->where('COACode',$account)->first();
        $tnxs = DB::table('transactions AS t')
                    ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%m-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                    ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                    ->where('t.STATUS','=','1')
                    ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                    ->where('t.COACode','=',$account)
                    ->whereBetween('t.VoucherDate',[$frmDate,$toDate])
                    ->get();
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','accountNameCode','tnxs','frmDate','toDate');
        $reportName=''.$reportName.'-'.$account;
        return $this->createPDF($view,$data,$reportName);
        //return view($view,$data);
    }
    public function rptAsOnDate(){
        return view('reports.reportsAsOnDateRpt');
    }
    public function createPDF($view,$data,$reportName){
        $pdf = PDF::loadView($view,$data)->setPaper('a4', 'portrait');
        return $pdf->download(''.$reportName.'.pdf');
    }


}
