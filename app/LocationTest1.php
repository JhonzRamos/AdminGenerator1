<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class LocationTest1 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'locationtest1';
    
    protected $fillable = ['location'];
    

    public static function boot()
    {
        parent::boot();

        LocationTest1::observe(new UserActionsObserver);
    }
    
    
    
    
}