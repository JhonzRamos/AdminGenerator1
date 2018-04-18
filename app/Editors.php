<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Editors extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'editors';
    
    protected $fillable = [
          'sNoMceEditor',
          'sMceEditor'
    ];
    

    public static function boot()
    {
        parent::boot();

        Editors::observe(new UserActionsObserver);
    }
    
    
    
    
}