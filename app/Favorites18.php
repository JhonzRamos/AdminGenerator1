<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites18 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites18';
    
    protected $fillable = [
          'sTitle',
          ''
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorites18::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\Favorites18Books', 'favorites18_id', 'id');
    }


    
    
    
}