<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites16Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites16_books';
    
    protected $fillable = ['favorites16_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites16Books::observe(new UserActionsObserver);
    }
    
            public function favorites16()
            {
                return $this->belongsTo('App\Favorites16', 'favorites16_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}