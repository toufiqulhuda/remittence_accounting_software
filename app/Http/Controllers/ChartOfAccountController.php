<?php

namespace App\Http\Controllers;

use App\Models\Exhouse;
use App\Models\AccountSubGroup;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChartOfAccountController extends Controller
{

    public function index()
    {
        $accSubGroupType=AccountSubGroup::select('AccSbGrID','AccSbGrName')->orderBy('AccSbGrID')->get();
        $exHouse = Exhouse::select('ExHouseID','ExHouseName')->where('isactive','1')->orderBy('ExHouseID')->get();
        return view('pages.chartOfAccountCreate',compact('accSubGroupType','exHouse'));


    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
			'exhouseName' => 'required|string|max:11',
			'AccountName' => 'required|unique:chart_of_account|string|max:100',
			'subAccGroupType' => 'required|string',
			//'balance' => 'required|string|max:1',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('chartOfAccount.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            $AccSubGrCode = AccountSubGroup::select('AccSbGrCode')->where('AccSbGrID',$data['subAccGroupType'])->get();
            $AccSubGrCodeData=$AccSubGrCode[0]->AccSbGrCode;
            $accSbGrMax = DB::select("SELECT LPAD(IFNULL(max(COACode),0)+1,3,0) AS  COACode FROM chart_of_account WHERE COACode LIKE '".$AccSubGrCodeData."%'");
            $accSbGrMaxArr =(array)$accSbGrMax[0];
            $coaCode = $AccSubGrCodeData.$accSbGrMaxArr['COACode'];
            //dd($coaCode);
            try{
                $authUser = Auth::user();
				$coa = new ChartOfAccount;
                $coa->COACode = $coaCode;
                $coa->ExHouseID = !empty($data['exhouseName']) ? $data['exhouseName'] :'';
                $coa->AccountName = !empty($data['AccountName']) ? $data['AccountName'] : '';
                $coa->AccSbGrID   = !empty($data['subAccGroupType']) ? $data['subAccGroupType'] : '';
                //$coa->Balance   = !empty($data['subAccGroupType']) ? $data['subAccGroupType'] : '';
                //$role->isactive = '';
                $coa->OpenDate = Carbon::now();
				$coa->CreatedBy = $authUser->user_id;
                $coa->created_at = Carbon::now();
                $coa->UpdatedBy = null;
				$coa->updated_at = null;
				$coa->remember_token = $data['_token'];
				$coa->save();
                return redirect()->route('chartOfAccount.index')
                                ->with('status','Sub Group Account created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('chartOfAccount.index')->with('failed',"operation failed");
			}
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
