<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Many3 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'many3';
    
    protected $fillable = [
          'sTitle',
          '-'
    ];
    

    public static function boot()
    {
        parent::boot();

        Many3::observe(new UserActionsObserver);
    }
    
    public function many3()
    {
        return $this->hasMany('App\Many3Books', 'many3_id', 'id');
    }


    
    
    
}