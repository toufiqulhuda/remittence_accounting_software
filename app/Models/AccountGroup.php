<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;
    protected $table = 'account_group_detail';
    protected $primaryKey = 'AccGrID';
    protected $fillable = [
        'AccGrCode','AccGrName','AccHdID', 'ExHouseID',
        'CreatedBy','created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
