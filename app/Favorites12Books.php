<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites12Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites12_books';
    
    protected $fillable = ['favorites12_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites12Books::observe(new UserActionsObserver);
    }
    
            public function favorites12()
            {
                return $this->belongsTo('App\Favorites12', 'favorites12_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}