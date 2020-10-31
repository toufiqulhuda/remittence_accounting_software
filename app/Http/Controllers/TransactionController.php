<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /********************************
     * Account Transaction
    ***********************************/
    public function accountTransactionCreate()
    {
        return view('pages.accountTransaction');
    }
    public function accountTransactionStore()
    {

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
        return view('pages.reverseTransaction');
    }
    public function reverseTransactionStore()
    {

    }
    /*public function subGroupAccountEdit()
    {
        return view('pages.subGroupAccountEdit');
    }
    public function subGroupAccountUpdate()
    {

    }*/

}
