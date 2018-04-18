<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites15Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites15_books';
    
    protected $fillable = ['favorites15_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites15Books::observe(new UserActionsObserver);
    }
    
            public function favorites15()
            {
                return $this->belongsTo('App\Favorites15', 'favorites15_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}