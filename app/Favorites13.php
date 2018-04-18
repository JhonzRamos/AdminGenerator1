<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites13 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites13';
    
    protected $fillable = [
          'sTitle',
          ''
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorites13::observe(new UserActionsObserver);
    }
    
    public function favorites13()
    {
        return $this->hasMany('App\Favorites13Books', 'favorites13_id', 'id');
    }


    
    
    
}