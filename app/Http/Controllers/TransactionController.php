<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Transactions;
use App\Models\Exhouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;
use PhpParser\Node\Stmt\TryCatch;

class TransactionController extends Controller
{
    /********************************
     * Account Transaction
    ***********************************/
    public function accountTransactionCreate()
    {
        $COA=ChartOfAccount::select('COACode','AccountName')->get();
        $vrDate= Exhouse::selectRAW('DATE_FORMAT(TnxDate,"%d-%b-%Y") AS TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        $vrNo = Transactions::selectRAW('IFNULL(MAX(VoucherNo),0)+1 AS VoucherNo')
                                        ->where('VoucherDate','=',date('Y-m-d', strtotime($vrDate['TnxDate'])))
                                        ->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        //dd($vrNo);
        return view('pages.accountTransaction',compact('COA','vrDate','vrNo'));
    }
    public function accountTransactionStore(Request $request)
    {
        //dd($request);
        $rules = [
			'TnxType' => 'required|string|max:1'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('transaction-account')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            $AuthUser = Auth::user();

            $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',$AuthUser->ExHouseID)->first();
            $VoucherNo = Transactions::selectRAW('IFNULL(MAX(VoucherNo),0)+1 AS VoucherNo')
                                        ->where('VoucherDate','=',$VoucherDate['TnxDate'])
                                        ->where('ExHouseID','=',$AuthUser->ExHouseID)->first();
            //dd($VoucherNo['VoucherNo']);
            try{

                //dd($AuthUser);
                $Tnx = new Transactions;
                $Particulars = !empty($data['Particulars']) ? $data['Particulars'] : '';
                $COACode = !empty($data['accountCode']) ? $data['accountCode'] : '';
                $DrAmt = !empty($data['DrAmt']) ? $data['DrAmt'] : '0.00';
                $CrAmt = !empty($data['CrAmt']) ? $data['CrAmt'] : '0.00';
                $TnxType = !empty($data['TnxType']) ? $data['TnxType'] : '';
                $VrNo = $VoucherNo['VoucherNo'];
                $VrDate=$VoucherDate['TnxDate'];

                $saveData = array();

                for($i=0; $i < count($Particulars); $i++){
                    if($i>0){
                        $VrNo += 1;
                    }

                    $parseData = [
                        'VoucherNo' => $VrNo,
                        'VoucherDate' => $VrDate,
                        'ExHouseID' => $AuthUser->ExHouseID,
                        'TnxType' => $TnxType,
                        'Particulars' => $Particulars[$i],
                        'COACode' => $COACode[$i],
                        'DrAmt' => !empty($DrAmt[$i]) ? $DrAmt[$i] : "0.00",
                        'CrAmt' => !empty($CrAmt[$i]) ? $CrAmt[$i] : "0.00",
                        'Status' => '1',
                        'CreatedBy' => $AuthUser->user_id,
                        'created_at' => Carbon::now(),
                        'AuthorizeBy' => Null,
                        'AuthorizeDate' => Null,
                        'remember_token' => $data['_token'],
                    ];
                    $saveData[$i] = $parseData;
                }
                if ($TnxType == "C" && !in_array("10101001", $COACode)){

                    $cashInHandData = [
                        'VoucherNo' => $VrNo+1,
                        'VoucherDate' => $VrDate,
                        'ExHouseID' => $AuthUser->ExHouseID,
                        'TnxType' => $TnxType,
                        'Particulars' => $Particulars[0],
                        'COACode' => '10101001',
                        'DrAmt' => array_sum($CrAmt),
                        'CrAmt' => array_sum($DrAmt),
                        'Status' => '1',
                        'CreatedBy' => $AuthUser->user_id,
                        'created_at' => Carbon::now(),
                        'AuthorizeBy' => Null,
                        'AuthorizeDate' => Null,
                        'remember_token' => $data['_token'],
                    ];

                    array_push($saveData,$cashInHandData);
                }
                //dd($saveData);
                $Tnx->insert($saveData);
                return redirect()->route('transaction-account')
                                ->with('status','Transaction created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('transaction-account')->with('failed',"Operation failed");
			}
        }
    }
    /*public function groupAccountEdit()
    {
        return view('pages.groupAccountEdit');
    }
    public function groupAccountUpdate()
    {

    }*/
    /********************************
     * Reverse Transaction
    ***********************************/
    public function reverseTransactionCreate()
    {

        $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('t.VoucherNo','t.VoucherDate','t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->leftJoin('exhouse AS ex','ex.ExHouseID','=','t.ExHouseID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate','=',$VoucherDate->TnxDate)
                        ->paginate(20);

        return view('pages.reverseTransaction',compact('tnxs'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }
    public function transactionDelete(Request $request)
    {

        $checkedVrNo = $request->chk;

        $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        Transactions::whereIn('VoucherNo',$checkedVrNo)
                    ->where('ExHouseID',Auth::user()->ExHouseID)
                    ->where('VoucherDate',$VoucherDate->TnxDate)
                    ->update([
                        'Status'=>3,
                        'CancelBy'=>Auth::user()->user_id,
                        'CancelDate'=>Carbon::now(),
                    ]);
        return redirect()->route('transaction-reverse')
                        ->with('status','Transaction(s) deleted successfully.');
    }
    /*public function subGroupAccountEdit()
    {
        return view('pages.subGroupAccountEdit');
    }
    public function subGroupAccountUpdate()
    {

    }*/

    public function endOfDay(){
        return view('pages.endOfDay');
        //return 'hello';
    }
    public function endOfDayProcess(Request $request){
        //dd($request);

        $rules = [
			'endOfDayConf' => 'required|string|max:1'
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('endOfDay')->with('failed','Confirm all the reports have Printed and Checked.');
		}else{
            $TnxDate = Exhouse::select('TnxDate')->where('ExHouseID',Auth::user()->ExHouseID)->first();
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
                        ->whereBetween('t.VoucherDate',[DB::raw("DATE_ADD(ye.Year_Closing_Date, INTERVAL 1 DAY)"),$TnxDate->TnxDate])
                        ->groupBy ('t.COACode')
                        ->orderBy('t.COACode','asc')
                        ->orderBy('t.VoucherDate','asc')
                        ->get();
                $capital= array();
                $assets= array();
                $a = 0;
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
                //echo '<pre>';
                //print_r($capital);
                //print_r($assets);

                if(count($capital) > 0 && count($assets) > 0){
                    $sum_cap = array_sum($capital);
                    $sum_ass = array_sum($assets);
                    if($sum_cap != $sum_ass){
                        return redirect()->route('endOfDay')->with('failed','Debit and credit mismatch');
                    }else{
                        try {
                            Exhouse::where('ExHouseID',Auth::user()->ExHouseID)
                                    ->update([
                                        'PrevDate'=>$TnxDate->TnxDate,
                                        'UpdatedBy'=>Auth::user()->user_id,
                                        'updated_at'=>Carbon::now(),
                                    ]);
                            return redirect()->route('endOfDay')->with('status',"End Of Day Successfully Done.");
                        }catch(Exception $e){
                            return redirect()->route('endOfDay')->with('failed',"Faild to End Of Day.");
                        }

                    }
                }else{
                    return redirect()->route('endOfDay')->with('failed','Operation failed');
                }
        }
                    //dd(DB::getQueryLog());
    }

    public function yearClosing(){
        return 'hello';
    }
    public function yearClosingProcess(){

    }

    public function createPDF() {
        // retreive all records from db
        $VoucherDate = Exhouse::select('TnxDate')->where('ExHouseID','=',Auth::user()->ExHouseID)->first();
        $tnxs = DB::table('transactions AS t')
                        ->select('t.VoucherNo','t.VoucherDate','t.COACode','coa.AccountName','t.Particulars','t.TnxType','t.DrAmt','t.CrAmt')
                        ->leftJoin('chart_of_account AS coa','coa.COACode','=','t.COACode')
                        ->leftJoin('exhouse AS ex','ex.ExHouseID','=','t.ExHouseID')
                        ->where('t.STATUS','=','1')
                        ->where('t.ExHouseID','=',Auth::user()->ExHouseID)
                        ->where('t.VoucherDate','=',$VoucherDate->TnxDate)
                        ->get();
        //dd($tnxs);
        //$data = Employee::all();

        // share data to view
        //view()->share('pages.reverseTransaction',$tnxs);
        //return view('pages.reverseTransaction-pdf',compact('tnxs'));
        $pdf = PDF::loadView('pages.reverseTransaction-pdf',compact('tnxs') );

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }

}
