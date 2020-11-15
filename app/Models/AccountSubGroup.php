<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubGroup extends Model
{
    use HasFactory;
    protected $table = 'account_sub_group_detail';
    protected $primaryKey = 'AccSbGrID';
    protected $fillable = [
        'AccSbGrCode','AccSbGrName','AccGrID', 'ExHouseID',
        'CreatedBy','created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
