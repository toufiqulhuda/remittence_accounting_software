<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currency';
    protected $primaryKey = 'CurrencyID';
    protected $fillable = [
        'CurrencyName','CountryID',
        'ShortName', 'isactive','CreatedBy',
        'created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
