<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Photos extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'photos';
    
    protected $fillable = ['sPhoto'];
    

    public static function boot()
    {
        parent::boot();

        Photos::observe(new UserActionsObserver);
    }
    
    
    
    
}