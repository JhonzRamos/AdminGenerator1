<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite24 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorite24';
    
    protected $fillable = [
          'sTitle',
          'sPhoto',
          ''
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorite24::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\Favorite24Books', 'favorite24_id', 'id');
    }


    
    
    
}