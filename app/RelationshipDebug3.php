<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class RelationshipDebug3 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'relationshipdebug3';
    
    protected $fillable = ['relationship_id'];
    

    public static function boot()
    {
        parent::boot();

        RelationshipDebug3::observe(new UserActionsObserver);
    }
    
    public function relationship()
    {
        return $this->hasOne('App\Relationship', 'id', 'relationship_id');
    }


    
    
    
}