<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Enumeration extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'enumeration';
    
    protected $fillable = ['sEnum'];
    
    public static $sEnum = ["small" => "small", "medium" => "medium", "large" => "large", ];


    public static function boot()
    {
        parent::boot();

        Enumeration::observe(new UserActionsObserver);
    }
    
    
    
    
}