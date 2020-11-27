<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = ['VoucherNo','VoucherDate','ExHouseID'];
    protected $fillable = [
        'VoucherNo','VoucherDate','ExHouseID','Particulars','COACode','TnxType','DrAmt','CrAmt','Status',
        'IsFT','VrSlNo','IsPrintable',
        'CreatedBy','created_at','AuthorizeBy','AuthorizeDate',
    ];
    protected $hidden = [
        'remember_token',
    ];
    public $incrementing = false;
    public $timestamps = false;
}
