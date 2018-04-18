<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class TableSorting extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'tablesorting';
    
    protected $fillable = [
          'order1',
          'order2',
          'order3'
    ];
    

    public static function boot()
    {
        parent::boot();

        TableSorting::observe(new UserActionsObserver);
    }
    
    
    
    
}