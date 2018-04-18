<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Timepicker1 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'timepicker1';
    
    protected $fillable = ['sTime'];
    

    public static function boot()
    {
        parent::boot();

        Timepicker1::observe(new UserActionsObserver);
    }
    
    
    
    
}