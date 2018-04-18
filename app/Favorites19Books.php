<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites19Books extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites19_books';
    
    protected $fillable = ['favorites19_id', 'books_id'];


    public function favorites19()
    {
                return $this->belongsTo('App\Favorites19', 'favorites19_id', 'id');
    }


    public function books()
    {
                return $this->belongsTo('App\Books', 'books_id', 'id');
    }


    
    
    
}