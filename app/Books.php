<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'books';
    
    protected $fillable = ['sTitle'];
    

    public static function boot()
    {
        parent::boot();

        Books::observe(new UserActionsObserver);
    }
    
    
    
    
}