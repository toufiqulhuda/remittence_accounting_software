<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearClosing extends Model
{
    use HasFactory;
    protected $table = 'year_closing_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Type_name', 'COACode','Balance','ExHouseID','Year_Closing_Date','Year_Closing_Execution',
        'CreatedBy','created_at'
    ];
    public $timestamps = false;

}
