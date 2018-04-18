<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite24Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorite24_books';
    
    protected $fillable = ['favorite24_id', 'books_id'];
    

    public static function boot()
    {
        parent::boot();

        Favorite24Books::observe(new UserActionsObserver);
    }
    
            public function favorite24()
            {
                return $this->belongsTo('App\Favorite24', 'favorite24_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
            }


    
    
    
}