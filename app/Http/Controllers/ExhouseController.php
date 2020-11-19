<?php

namespace App\Http\Controllers;
use App\Models\Exhouse;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;

class ExhouseController extends Controller
{

    public function index()
    {
        $country = Country::select('CountryID', 'CountryName')->where('isactive','1')->orderBy('CountryID')->get();
        //$exParent = Ex::select('ExHouseID','ExHouseName')->where('ExParentID','=','ExHouseID')->orderBy('ExHouseID')->get();
        $exParent = DB::select("SELECT exhouse.ExHouseID,exhouse.ExHouseName FROM exhouse WHERE exhouse.ExParentID=exhouse.ExHouseID");
        //dd($exParent);
        $exhouses = DB::table('exhouse AS h')
                        ->leftJoin('users AS cr', 'cr.user_id', '=', 'h.CreatedBy')
                        ->leftJoin('users AS up', 'up.user_id', '=', 'h.UpdatedBy')
                        ->leftJoin('country AS c', 'c.CountryID', '=', 'h.CountryID')
                        ->leftJoin('exhouse AS p', 'p.ExParentID', '=', 'h.ExHouseID')
                        ->select('h.ExHouseID','h.ExHouseName','h.Address','c.CountryName','h.TnxDate','h.PrevDate','p.ExHouseName AS ExParentName','h.RespExID','h.ShortName',
                        'cr.username AS CreatedBy','h.created_at','up.username AS UpdatedBy','h.updated_at',
                        'h.isactive' )
                        ->paginate(5);
        //dd($countries);
        return view('exhouse.index',compact('exhouses','country','exParent'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('exhouse.create');
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
			'exHouseName' => 'required|unique:Exhouse|string|max:50',
			'country' => 'required|string|max:3',
			'exParentCode' => 'required|string|max:11',
			'address' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('exhouses.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                $exHouseCode = DB::select("Select CONCAT(CountryCode,LPAD(CurrencyID,3,'0'),
                LPAD((SELECT COUNT(CountryID)+1 AS SL FROM exhouse WHERE CountryID= ?),4,'0')) AS EXHOUSE_ID FROM country WHERE CountryID=?",[$data['country'],$data['country']]);
                $exH_ID =(array)$exHouseCode[0];
                //dd($exH_ID['EXHOUSE_ID']);
                $exParentCode = ($data['exParentCode']=='self') ? $exH_ID['EXHOUSE_ID'] : $data['exParentCode'];
				$exHouse = new Exhouse;
                $exHouse->ExHouseID =  !empty($exH_ID['EXHOUSE_ID']) ? $exH_ID['EXHOUSE_ID'] : '';
                $exHouse->ExHouseName = !empty($data['exHouseName']) ? $data['exHouseName'] : '' ;
                $exHouse->ExParentID = $exParentCode;
                $exHouse->Address = !empty($data['address']) ? $data['address'] : '';
                $exHouse->CountryID = !empty($data['country']) ? $data['country'] : '';
                $exHouse->TnxDate = Carbon::today();
                $exHouse->PrevDate = Carbon::yesterday();
                //$exHouse->isactive = '';
				$exHouse->CreatedBy = $user->user_id;
                $exHouse->created_at = Carbon::now();
                $exHouse->UpdatedBy = null;
				$exHouse->updated_at = null;
				$exHouse->remember_token = $data['_token'];
				$exHouse->save();
                return redirect()->route('exhouses.index')
                                ->with('status','ExHouse created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('exhouses.index')->with('failed',"operation failed");
			}
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Exhouse $exhouse)
    {
        $country = Country::select('CountryID', 'CountryName')->where('isactive','1')->orderBy('CountryID')->get();
        $exParent = DB::select("SELECT ExHouseID,ExHouseName FROM exhouse WHERE exhouse.ExParentID = exhouse.ExHouseID");

        return view('exhouse.edit',compact('exhouse','country','exParent'));
    }


    public function update(Request $request,$ExHouseID)
    {
        //dd($request);
        $rules = [
			'exHouseName' => 'required|string|max:50',
			'country' => 'required|string|max:3',
			'exParentCode' => 'required|string|max:11',
			'address' => 'required|string|max:255',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('exhouses.edit',$ExHouseID)->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                //dd($user);
                $exHouse = Exhouse::find($ExHouseID);

                //$exHouse->ExHouseID =  !empty($exH_ID['EXHOUSE_ID']) ? $exH_ID['EXHOUSE_ID'] : '';
                if($data['exParentCode'] == 'self'){
                    $ExParent=$ExHouseID;
                }else{
                    $ExParent= !empty($data['exParentCode']) ? $data['exParentCode'] : '' ;
                }
                $exHouse->ExHouseName = !empty($data['exHouseName']) ? $data['exHouseName'] : '' ;
                $exHouse->ExParentID = $ExParent;
                $exHouse->Address = !empty($data['address']) ? $data['address'] : '';
                $exHouse->CountryID = !empty($data['country']) ? $data['country'] : '';
                $exHouse->TnxDate = Carbon::today();
                $exHouse->PrevDate = Carbon::yesterday();

				$exHouse->UpdatedBy = $user->user_id;
				$exHouse->updated_at = Carbon::now();
				$exHouse->remember_token = $data['_token'];
                $exHouse->save();
                $exHouse->update($request->all());
                return redirect()->route('exhouses.index')
                                ->with('status','Exchanage house update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('exhouses.edit',$ExHouseID)->with('failed',"operation failed");
            }
        }
    }


    public function destroy($id)
    {
        //
    }
    public function isactive(Request $request)
    {
        //dd($request);
        //$user = User::find($user_id);
        $role = Exhouse::find($request->id)->update(['isactive' => $request->status]);
        return response()->json(['success'=>'Status changed successfully.']);

    }
}
