<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites23Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites23_books';
    
    protected $fillable = ['favorites23_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites23Books::observe(new UserActionsObserver);
    }
    
            public function favorites23()
            {
                return $this->belongsTo('App\Favorites23', 'favorites23_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}