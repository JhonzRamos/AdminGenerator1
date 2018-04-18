<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites17Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites17_books';
    
    protected $fillable = ['favorites17_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites17Books::observe(new UserActionsObserver);
    }
    
            public function favorites17()
            {
                return $this->belongsTo('App\Favorites17', 'favorites17_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}