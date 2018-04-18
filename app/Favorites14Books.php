<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites14Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites14_books';
    
    protected $fillable = ['favorites14_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites14Books::observe(new UserActionsObserver);
    }
    
            public function favorites14()
            {
                return $this->belongsTo('App\Favorites14', 'favorites14_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}