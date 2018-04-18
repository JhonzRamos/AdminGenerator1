<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Uploads extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'uploads';
    
    protected $fillable = [
          'iDateTime',
          'sFile',
          'sPhoto'
    ];
    

    public static function boot()
    {
        parent::boot();

        Uploads::observe(new UserActionsObserver);
    }
    
    
    
    /**
     * Set attribute to datetime format
     * @param $input
     */
    public function setIDateTimeAttribute($input)
    {
        if($input != '') {
            $this->attributes['iDateTime'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['iDateTime'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getIDateTimeAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }


}