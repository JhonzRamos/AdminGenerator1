<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Numbers extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'numbers';
    
    protected $fillable = ['iNumber'];
    

    public static function boot()
    {
        parent::boot();

        Numbers::observe(new UserActionsObserver);
    }
    
    
    
    
}