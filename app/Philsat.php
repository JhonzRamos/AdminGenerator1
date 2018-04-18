<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Philsat extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'philsat';
    
    protected $fillable = ['sPhilsatName'];
    

    public static function boot()
    {
        parent::boot();

        Philsat::observe(new UserActionsObserver);
    }
    
    
    
    
}