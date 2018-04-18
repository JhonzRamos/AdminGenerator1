<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Uploading extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'uploading';
    
    protected $fillable = ['sFileName'];
    

    public static function boot()
    {
        parent::boot();

        Uploading::observe(new UserActionsObserver);
    }
    
    
    
    
}