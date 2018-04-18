<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites15 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites15';
    
    protected $fillable = [
          'sTitle',
          ''
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorites15::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\Favorites15Books', 'favorites15_id', 'id');
    }


    
    
    
}