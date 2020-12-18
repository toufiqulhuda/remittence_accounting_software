<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // protected $fillable = ['title','parent_id','url','icon','roleid','order'];

    // public function childs() {
    //     return $this->hasMany('App\Menu','parent_id','id') ;
    // }

    public $timestamps = false;

    protected $table = 'menus';

    protected $fillable = array('parent_id','title','url','icon','roleid','order');

    public function parent()
    {
      return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function children()
    {
      return $this->hasMany('App\Models\Menu', 'parent_id');
    }
}
