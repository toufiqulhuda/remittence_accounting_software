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
use Excel;
use App\Exports\TransactionJournalRpt;
use App\Exports\ProfitLossStatementRpt;
use App\Exports\AccountTransactionSummaryRpt;
use App\Exports\TrailBalanceRpt;
use App\Exports\DailyCashBookRpt;
use App\Exports\StatAffairsDetailRpt;
use PhpParser\Node\Stmt\Foreach_;

//use DB;


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
        $DloadType=!empty($data['DloadType']) ? $data['DloadType'] :'';
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

        if($DloadType=='PDF' || $DloadType=='PRV'){
            $dType = $this->$reportName($frmDate,$toDate,$reportName,$account,$Type,$DloadType);
        }else{
            $dType = $this->exportExcel($frmDate,$toDate,$reportName,$account,$Type);
        }

        return $dType;
    }
    public function voucherPrintRpt($frmDate,$toDate,$reportName,$account=null,$TnxType=null,$DloadType){
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

        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;
    }
    public function transactionJournalRpt($frmDate,$toDate,$reportName,$account=null,$TnxType,$DloadType){
        //dd($DloadType);
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
        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;
    }

    public function profitLossStatementRpt($frmDate,$toDate,$reportName,$DloadType){
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
        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;
    }
    public function accountTransactionSummaryRpt($frmDate,$toDate,$reportName,$account,$TnxType,$DloadType){
        //dd($reportName);
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $accountNameCode = ChartOfAccount::select("COACode","AccountName","OpenDate",DB::raw("nvl(Balance,0) AS Balance"))->where('COACode',$account)->first();

        $bfBal =  DB::table('transactions AS t')
                    ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%m-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                    ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                    ->where('t.STATUS','=','1')
                    ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                    ->where('t.COACode','=',$account)
                    ->whereBetween('t.VoucherDate',['coa.OpenDate',date('Y-m-d',strtotime('-1 day', strtotime($frmDate)))])
                    ->orderBy('t.VoucherDate')
                    ->get();
        $tnxs = DB::table('transactions AS t')
                    ->select('t.VoucherNo',DB::raw("DATE_FORMAT(t.VoucherDate,'%d-%m-%Y') AS VoucherDate"),'t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                    ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                    ->where('t.STATUS','=','1')
                    ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                    ->where('t.COACode','=',$account)
                    ->whereBetween('t.VoucherDate',[$frmDate,$toDate])
                    ->orderBy('t.VoucherDate')
                    ->get();
                    //dd($tnxs);
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','accountNameCode','bfBal','tnxs','frmDate','toDate');
        $reportName=''.$reportName.'-'.$account;
        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;
    }
    public function rptAsOnDateView(){
        $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        //dd($VoucherDate);
        return view('reports.reportsAsOnDateRpt',compact('VoucherDate'));
    }
    public function rptAsOnDate(Request $request){
        //dd($request);
        $data = $request->input();
        $frmDate=!empty($data['asOnDate']) ? date('Y-m-d', strtotime($data['asOnDate'])) : '';
        $toDate=!empty($data['toDate']) ? date('Y-m-d', strtotime($data['toDate'])) :'';
        $reportName=!empty($data['reportName']) ? $data['reportName'] :'';
        $account=!empty($data['account']) ? $data['account'] :'';
        $Type=!empty($data['TnxType']) ? $data['TnxType'] :'';
        $DloadType=!empty($data['DloadType']) ? $data['DloadType'] :'';
        //dd($TnxType);

        if($DloadType=='PDF' || $DloadType == 'PRV'){
            $dType = $this->$reportName($frmDate,$reportName,$DloadType);
        }else{
            $dType = $this->exportExcel($frmDate,$toDate,$reportName,$account,$Type);
        }

        return $dType;
    }
    public function trailBalanceRpt($frmDate,$reportName,$DloadType){
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('ag.AccGrName','coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'),DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->Join('account_sub_group_detail AS asg','asg.AccSbGrID','=','coa.AccSbGrID')
                        ->Join('account_group_detail AS ag' , 'ag.AccGrID','=', 'asg.AccGrID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate',$frmDate)
                        ->groupBy('ag.AccGrName','coa.AccountName')
                        ->get();
                        //dd($tnxs);
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','tnxs','frmDate');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;

        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;

    }
    public function dailyCashBookRpt($frmDate,$reportName,$DloadType){
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        $DebitUnion =DB::table('transactions AS t')
                        ->select('coa.AccountName',DB::raw('sum(t.DrAmt) AS DrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate',$frmDate)
                        ->where('t.TnxType','C')
                        ->where('t.DrAmt','<>','0.00')
                        ->groupBy('coa.AccountName');
        $Debit =DB::table('transactions AS t')
                        ->select(DB::raw('"-BF-" AS AccountName'),DB::raw('sum(t.DrAmt) AS DrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate','<',$frmDate)
                        ->where('t.TnxType','C')
                        ->union($DebitUnion)->get();

        $Credit =DB::table('transactions AS t')
                        ->select('coa.AccountName',DB::raw('sum(t.CrAmt) AS CrAmt'))
                        ->Join('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate',$frmDate)
                        ->where('t.TnxType','C')
                        ->where('t.CrAmt','<>','0.00')
                        ->groupBy('coa.AccountName')
                        ->get();


        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','frmDate','Debit','Credit');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;

        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;

    }
    public function statAffairsDetailRpt($frmDate,$reportName,$DloadType){
        $exHouseDtls = Exhouse::select('ExHouseName','Address')->where('ExHouseID',Auth::user()->ExHouseID)->first();
        //DB::enableQueryLog(); // Enable query log
        $Tnxs = DB::table('transactions AS t')
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
                    ->whereBetween('t.VoucherDate',[DB::raw("DATE_ADD(ye.Year_Closing_Date, INTERVAL 1 DAY)"),$frmDate])
                    ->groupBy ('t.COACode')
                    ->orderBy('t.COACode','asc')
                    ->orderBy('t.VoucherDate','asc')
                    ->get();
        /*$a = 0;
        $c = 0;
        foreach ($Tnxs as $Tnx) {
            if(in_array($Tnx->AccHdID,array(1,4)) && $Tnx->Balance > 0){
                $assets [$a]= $Tnx->Balance;
                $a++;
            }elseif (in_array($Tnx->AccHdID,array(2,3)) && $Tnx->Balance > 0){
                $capital [$c]= $Tnx->Balance;
                $c++;
            }elseif (in_array($Tnx->AccHdID,array(1,4)) && $Tnx->Balance < 0){
                $capital [$c]= abs($Tnx->Balance);
                $c++;
            }elseif (in_array($Tnx->AccHdID,array(2,3)) && $Tnx->Balance < 0){
                $assets [$a]= abs($Tnx->Balance);
                $a++;
            }

        }
        echo '<pre>';
        print_r($capital);
        print_r($assets);
        echo $sum_cap = array_sum($capital);
        echo '<br>';
        echo $sum_ass = array_sum($assets);
        if($sum_cap != $sum_ass){
            echo 'Debit and credit mismatch';
        }else{
            echo 'Both are equal';
        }
        exit();*/
        //dd(DB::getQueryLog());
        //exit();
        $view='reports.'.$reportName.'-PDF';
        $data =compact('exHouseDtls','Tnxs','frmDate');
        $reportName=''.$reportName.'-'.Auth::user()->ExHouseID;

        if($DloadType=='PDF'){
            $outPut = $this->createPDF($view,$data,$reportName);
        }else{
            $outPut = view($view,$data);
        }

        return $outPut;

    }
    public function createPDF($view,$data,$reportName){
        $pdf = PDF::loadView($view,$data)->setPaper('a4', 'portrait');
        return $pdf->stream(''.$reportName.'.pdf');
        //return $pdf->download(''.$reportName.'.pdf');
    }
    public function exportExcel($frmDate,$toDate,$reportName,$account,$Type){
        if($reportName=='transactionJournalRpt'){
            $obj = new TransactionJournalRpt($frmDate,$toDate,$reportName,$account,$Type);
        }else if($reportName=='profitLossStatementRpt'){
            $obj = new ProfitLossStatementRpt($frmDate,$toDate,$reportName,$account,$Type);
        }else if($reportName=='accountTransactionSummaryRpt'){
            $obj = new AccountTransactionSummaryRpt($frmDate,$toDate,$reportName,$account,$Type);
        }else if($reportName=='trailBalanceRpt'){
            $obj = new TrailBalanceRpt($frmDate,$reportName);
        }else if($reportName=='dailyCashBookRpt'){
            $obj = new DailyCashBookRpt($frmDate,$reportName);
        }else if($reportName=='statAffairsDetailRpt'){
            $obj = new StatAffairsDetailRpt($frmDate,$reportName);
        }
        return Excel::download($obj, $reportName.'.xlsx');
    }



}
