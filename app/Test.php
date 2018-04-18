<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'test';
    
    protected $fillable = [
          'sClassification',
          'sTitle',
          'bRadio',
          'bCheck',
          'fMoney',
          'iDateEntry',
          'sEmail'
    ];
    
    public static $sClassification = ["enum1" => "enum1", "enum2" => "enum2", "enum3" => "enum3", ];


    public static function boot()
    {
        parent::boot();

        Test::observe(new UserActionsObserver);
    }
    
    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setIDateEntryAttribute($input)
    {
        if($input != '') {
            $this->attributes['iDateEntry'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['iDateEntry'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getIDateEntryAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}