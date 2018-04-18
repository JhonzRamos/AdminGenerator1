<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Examples extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'examples';
    
    protected $fillable = [
          'sTitleName',
          'sTitleEmail'
    ];
    

    public static function boot()
    {
        parent::boot();

        Examples::observe(new UserActionsObserver);
    }
    
    
    
    
}