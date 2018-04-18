<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites24Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites24_books';
    
    protected $fillable = ['favorites24_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorites24Books::observe(new UserActionsObserver);
    }
    
            public function favorites24()
            {
                return $this->belongsTo('App\Favorites24', 'favorites24_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}