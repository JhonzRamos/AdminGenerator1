<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class DatePickers extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'datepickers';
    
    protected $fillable = [
          'sDatePicker',
          'sDateTimePicker'
    ];
    

    public static function boot()
    {
        parent::boot();

        DatePickers::observe(new UserActionsObserver);
    }
    
    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSDatePickerAttribute($input)
    {
        if($input != '') {
            $this->attributes['sDatePicker'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format(config('quickadmin.date_format_jquery'));
        }else{
            $this->attributes['sDatePicker'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSDatePickerAttribute($input)
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
    public function setSDateTimePickerAttribute($input)
    {
        if($input != '') {
            $this->attributes['sDateTimePicker'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['sDateTimePicker'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getSDateTimePickerAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }


}