<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class EncryptedRoutes extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'encryptedroutes';
    
    protected $fillable = ['sEncryptionName'];
    

    public static function boot()
    {
        parent::boot();

        EncryptedRoutes::observe(new UserActionsObserver);
    }
    
    
    
    
}