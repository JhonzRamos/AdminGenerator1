<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Pallete extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'pallete';
    
    protected $fillable = ['sColor'];
    

    public static function boot()
    {
        parent::boot();

        Pallete::observe(new UserActionsObserver);
    }
    
    
    
    
}