<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Toggle extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'toggle';
    
    protected $fillable = ['sToggle'];
    

    public static function boot()
    {
        parent::boot();

        Toggle::observe(new UserActionsObserver);
    }
    
    
    
    
}