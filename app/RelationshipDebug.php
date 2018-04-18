<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class RelationshipDebug extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'relationshipdebug';
    
    protected $fillable = ['books_id','-'];
    

    public static function boot()
    {
        parent::boot();

        RelationshipDebug::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasOne('App\Books', 'id', 'books_id');
    }


    
    
    
}