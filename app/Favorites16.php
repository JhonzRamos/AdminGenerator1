<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites16 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites16';
    
    protected $fillable = [
          'sTitle',
          ''
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorites16::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\Favorites16Books', 'favorites16_id', 'id');
    }


    
    
    
}