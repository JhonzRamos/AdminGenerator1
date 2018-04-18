<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\Hash; 

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class AllMenus extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'allmenus';
    
    protected $fillable = [
          'sTitle',
          'sEmail',
          'sNUmber',
          'sLocation',
          'sColor',
          'iTime',
          'sToggle',
          '',
          'sT',
          'sSFa',
          'sRadio',
          'bCheckBox',
          'bDatePicker',
          'bDateTimePicker',
          'user_id','-',
          'sFile',
          'sPhoto',
          'sPassword',
          'dMoney',
          'sEnum'
    ];
    
    public static $sEnum = ["small" => "small", "medium" => "medium", "large" => "large", ];


    public static function boot()
    {
        parent::boot();

        AllMenus::observe(new UserActionsObserver);
    }
    
    public function books()
    {
        return $this->hasMany('App\AllMenusBooks', 'allmenus_id', 'id');
    }


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    /**
     * Hash password
     * @param $input
     */
    public function setSPasswordAttribute($input)
    {
        $this->attributes['sPassword'] = Hash::make($input);
    }


    /**
     * Set attribute to date format
     * @param $input
     */
    public function setBDatePickerAttribute($input)
    {
        if($input != '') {
            $this->attributes['bDatePicker'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['bDatePicker'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getBDatePickerAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    /**
     * Set attribute to datetime format
     * @param $input
     */
    public function setBDateTimePickerAttribute($input)
    {
        if($input != '') {
            $this->attributes['bDateTimePicker'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['bDateTimePicker'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getBDateTimePickerAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }


}