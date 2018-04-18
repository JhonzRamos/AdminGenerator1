<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites20Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites20_books';
    
    protected $fillable = ['favorites20_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites20Books::observe(new UserActionsObserver);
    }
    
            public function favorites20()
            {
                return $this->belongsTo('App\Favorites20', 'favorites20_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}