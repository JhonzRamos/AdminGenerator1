<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\Hash; 


use Illuminate\Database\Eloquent\SoftDeletes;

class ExampleMenu extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'examplemenu';
    
    protected $fillable = [
          'sPhoto',
          'sLocation',
          'bToggle',
          'sDesc',
          'sDesc2',
          'sFile',
          'oEnum',
          'sPassword'
    ];
    
    public static $oEnum = ["small" => "small", "medium" => "medium", "large" => "large", ];


    public static function boot()
    {
        parent::boot();

        ExampleMenu::observe(new UserActionsObserver);
    }
    
    /**
     * Hash password
     * @param $input
     */
    public function setSPasswordAttribute($input)
    {
        $this->attributes['sPassword'] = Hash::make($input);
    }


    
    
}