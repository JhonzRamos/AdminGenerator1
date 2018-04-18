<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites21Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites21_books';
    
    protected $fillable = ['favorites21_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites21Books::observe(new UserActionsObserver);
    }
    
            public function favorites21()
            {
                return $this->belongsTo('App\Favorites21', 'favorites21_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}