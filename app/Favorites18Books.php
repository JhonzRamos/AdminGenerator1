<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites18Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites18_books';
    
    protected $fillable = ['favorites18_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites18Books::observe(new UserActionsObserver);
    }
    
            public function favorites18()
            {
                return $this->belongsTo('App\Favorites18', 'favorites18_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}