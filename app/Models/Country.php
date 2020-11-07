<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';
    //protected $primaryKey = 'roleid';
    protected $fillable = [
        'ExHouseID','ExHouseName','ExParentID','Address','CountryID','CurrencyID','TnxDate','PrevDate','RespExID',
        'ShortName', 'isactive','CreatedBy',
        'created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
