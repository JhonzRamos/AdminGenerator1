<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Timepicker extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'timepicker';
    
    protected $fillable = ['sTime'];
    

    public static function boot()
    {
        parent::boot();

        Timepicker::observe(new UserActionsObserver);
    }
    
    
    
    
}