<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use Carbon\Carbon;


use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = DB::table('currency AS curr')
                        ->leftJoin('users AS cr', 'cr.user_id', '=', 'curr.CreatedBy')
                        ->leftJoin('users AS up', 'up.user_id', '=', 'curr.UpdatedBy')
                        ->select('curr.CurrencyID','curr.CurrencyName','curr.ISO_CODE','curr.ShortName',
                        'cr.username AS CreatedBy','curr.created_at','up.username AS UpdatedBy','curr.updated_at',
                        'curr.isactive' )
                        ->paginate(20);
        //dd($allUsers);
        return view('currency.index',compact('currencies'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }


    public function create()
    {
        return view('currency.create');
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
			'currencyName' => 'required|unique:Currency|string',
			'isoCode' => 'required|string',
			'shortName' => 'required|string',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('currencies.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
				$currency = new Currency;
                $currency->CurrencyName = !empty($data['currencyName']) ? $data['currencyName'] : '' ;
                $currency->ISO_CODE = !empty($data['isoCode'])?$data['isoCode']:'';
                $currency->ShortName = !empty($data['shortName'])?$data['shortName']:'';
                //$currency->isactive = '';
				$currency->CreatedBy = $user->user_id;
                $currency->created_at = Carbon::now();
                $currency->UpdatedBy = null;
				$currency->updated_at = null;
				$currency->remember_token = $data['_token'];
				$currency->save();
                return redirect()->route('currencies.index')
                                ->with('status','Currency created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('currencies.index')->with('failed',"operation failed");
			}
        }
    }


    public function show(User $user)
    {
        // return view('currency.show',compact('user'));
    }


    public function edit(Currency $currency)
    {
        return view('currency.edit',compact('currency'));
    }


    public function update(Request $request,$CurrencyID)
    {
        //dd($request);
        $rules = [
			'currencyName' => 'required|string',
			'isoCode' => 'required|string',
			'shortName' => 'required|string',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('currencies.edit',$CurrencyID)->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                $currency = Currency::find($CurrencyID);
				//$role = new Role;
                $currency->CurrencyName = !empty($data['currencyName']) ? $data['currencyName'] : '' ;
                $currency->ISO_CODE = !empty($data['isoCode'])?$data['isoCode']:'';
                $currency->ShortName = !empty($data['shortName'])?$data['shortName']:'';
                //$role->isactive = '';
				$currency->UpdatedBy = $user->user_id;
				$currency->updated_at = Carbon::now();
				$currency->remember_token = $data['_token'];
                $currency->save();
                $currency->update($request->all());
                return redirect()->route('currencies.index')
                                ->with('status','Currency update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('currencies.edit',$CurrencyID)->with('failed',"operation failed");
            }
        }
    }


    public function destroy(Currency $currency)
    {
        // $user->delete();

        // return redirect()->route('users.index')
        //                 ->with('success','Product deleted successfully');
    }
    public function isactive(Request $request)
    {
        //dd($request);
        //$user = User::find($user_id);
        $role = Currency::find($request->id)->update(['isactive' => $request->status]);
        return response()->json(['success'=>'Status changed successfully.']);

    }
}
