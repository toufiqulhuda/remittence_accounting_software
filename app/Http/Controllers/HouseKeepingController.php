<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HouseKeepingController extends Controller
{
    /********************************
     * GroupAccount
    ***********************************/
    public function groupAccountCreate()
    {
        return view('pages.groupAccountCreate');
    }
    public function groupAccountStore()
    {

    }
    public function groupAccountEdit()
    {
        return view('pages.groupAccountEdit');
    }
    public function groupAccountUpdate()
    {

    }
    /********************************
     * SubGroupAccount
    ***********************************/
    public function subGroupAccountCreate()
    {
        return view('pages.subGroupAccountCreate');
    }
    public function subGroupAccountStore()
    {

    }
    public function subGroupAccountEdit()
    {
        return view('exhouse.subGroupAccountEdit');
    }
    public function subGroupAccountUpdate()
    {

    }
    /********************************
     * ChartOfAccount
    ***********************************/
    public function chartOfAccountCreate()
    {
        return view('exhouse.chartOfAccountCreate');
    }
    public function chartOfAccountStore()
    {

    }
    public function chartOfAccountEdit()
    {
        return view('exhouse.chartOfAccountEdit');
    }
    public function chartOfAccountUpdate()
    {

    }

}
