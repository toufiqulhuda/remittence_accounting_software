<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'roleid';
    protected $fillable = [
        'role_name', 'CreatedBy',
        'created_at','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
