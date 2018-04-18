<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Many2 extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'many2';
    
    protected $fillable = [
          'sTitle',
          '-'
    ];
    

    public static function boot()
    {
        parent::boot();

        Many2::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\Books', 'id', 'books_id');
    }


    
    
    
}