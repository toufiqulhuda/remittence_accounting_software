<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    use HasFactory;
    protected $table = 'chart_of_account';
    protected $primaryKey = 'COACode';
    protected $fillable = [
        'AccountName','AccHdID','AccGrID', 'AccSbGrID','ExHouseID','OpenDate',
        'Balance','RptHeadID','DRptlevel','ReportType',
        'CreatedBy','created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
    public $incrementing = false;

}
