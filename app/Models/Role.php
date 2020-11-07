<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'roleid';
    protected $fillable = [
        'role_name', 'isactive','CreatedBy',
        'created_at','UpdatedBy','updated_at',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
