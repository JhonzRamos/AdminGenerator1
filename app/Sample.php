<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'sample';
    
    protected $fillable = [
          'sTitle',
          'sEmail',
          'sFile',
          'sLocation'
    ];
    

    public static function boot()
    {
        parent::boot();

        Sample::observe(new UserActionsObserver);
    }
    
    
    
    
}