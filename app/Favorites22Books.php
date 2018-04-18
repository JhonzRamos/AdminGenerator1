<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites22Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites22_books';
    
    protected $fillable = ['favorites22_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites22Books::observe(new UserActionsObserver);
    }
    
            public function favorites22()
            {
                return $this->belongsTo('App\Favorites22', 'favorites22_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}