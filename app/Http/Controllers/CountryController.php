<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Models\Country;
use App\Models\Currency;
use Carbon\Carbon;


use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        $currency = Currency::select('CurrencyID', 'CurrencyName')->where('isactive','1')->orderBy('CurrencyID')->get();
        $countries = DB::table('country AS c')
                        ->leftJoin('users AS cr', 'cr.user_id', '=', 'c.CreatedBy')
                        ->leftJoin('users AS up', 'up.user_id', '=', 'c.UpdatedBy')
                        ->leftJoin('currency AS curr', 'curr.CurrencyID', '=', 'c.CurrencyID')
                        ->select('c.CountryID','c.CountryName','curr.CurrencyName',
                        'cr.username AS CreatedBy','c.created_at','up.username AS UpdatedBy','c.updated_at',
                        'c.isactive' )
                        ->paginate(5);
        //dd($countries);
        return view('country.index',compact('countries','currency'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('country.create');
    }


    public function store(Request $request)
    {
        //dd($request);
        $rules = [
			'countryName' => 'required|unique:Country|string|max:50',
			'countryCode' => 'required|string|max:3',
			'isoCode' => 'required|string|max:3',
			'currencyID' => 'required|string',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('countries.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
				$country = new Country;
                $country->CountryCode = !empty($data['countryCode']) ? $data['countryCode'] : '' ;
                $country->CountryName = !empty($data['countryName']) ? $data['countryName'] : '' ;
                $country->iso_code = !empty($data['isoCode']) ? $data['isoCode'] : '';
                $country->CurrencyID = !empty($data['currencyID']) ? $data['currencyID'] : '';
                //$country->isactive = '';
				$country->CreatedBy = $user->user_id;
                $country->created_at = Carbon::now();
                $country->UpdatedBy = null;
				$country->updated_at = null;
				$country->remember_token = $data['_token'];
				$country->save();
                return redirect()->route('countries.index')
                                ->with('status','Country created successfully.');
			}
			catch(Exception $e){
				return redirect()->route('countries.index')->with('failed',"operation failed");
			}
        }
    }


    public function show(User $user)
    {
        // return view('country.show',compact('user'));
    }


    public function edit(Country $country)
    {
        $currency = Currency::select('CurrencyID', 'CurrencyName')->where('isactive','1')->orderBy('CurrencyID')->get();
        return view('country.edit',compact('country','currency'));
    }


    public function update(Request $request,$CountryID)
    {
        //dd($request);
        $rules = [
			'countryName' => 'required|string|max:50',
			'countryCode' => 'required|string|max:3',
			'isoCode' => 'required|string|max:3',
			'currencyID' => 'required|string',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('countries.edit',$CountryID)->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $user = Auth::user();
                $country = country::find($CountryID);
				//$role = new Role;
                $country->CountryCode = !empty($data['countryCode']) ? $data['countryCode'] : '' ;
                $country->CountryName = !empty($data['countryName']) ? $data['countryName'] : '' ;
                $country->iso_code = !empty($data['isoCode']) ? $data['isoCode'] : '';
                $country->CurrencyID = !empty($data['currencyID']) ? $data['currencyID'] : '';
                //$role->isactive = '';
				$country->UpdatedBy = $user->user_id;
				$country->updated_at = Carbon::now();
				$country->remember_token = $data['_token'];
                $country->save();
                $country->update($request->all());
                return redirect()->route('countries.index')
                                ->with('status','Country update successfully.');
			}
			catch(Exception $e){
				return redirect()->route('countries.edit',$CountryID)->with('failed',"operation failed");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $user->delete();

        // return redirect()->route('users.index')
        //                 ->with('success','Product deleted successfully');
    }
}
