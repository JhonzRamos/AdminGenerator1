<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites13Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites13_books';
    
    protected $fillable = ['favorites13_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites13Books::observe(new UserActionsObserver);
    }
    
            public function favorites13()
            {
                return $this->belongsTo('App\Favorites13', 'favorites13_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}