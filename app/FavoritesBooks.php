<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class FavoritesBooks extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'favorites_books';

    protected $fillable = ['favorites_id','books_id'];


    public function favorites() {
        return $this->belongsTo('App\Favorites', 'favorites_id', 'id');
    }

    public function books() {
        return $this->belongsTo('App\Books', 'books_id', 'id');
    }







}