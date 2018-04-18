<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites';
    
    protected $fillable = [
          'sTitle'
    ];
    

    public static function boot()
    {
        parent::boot();

        Favorites::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\FavoritesBooks', 'favorites_id', 'id');
    }


    
    
    
}