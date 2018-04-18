<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\Hash; 

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class UpdatedMenusBooks extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'updatedmenus_books';
    
    protected $fillable = ['updatedmenus_id', 'books_id'];
    
    public static $aEnum = ["small" => "small", "medium" => "medium", "large" => "large", ];


    public static function boot()
    {
        parent::boot();

        UpdatedMenusBooks::observe(new UserActionsObserver);
    }
    
            public function updatedmenus()
            {
                return $this->belongsTo('App\UpdatedMenus', 'updatedmenus_id', 'id');
            }


            public function books()
            {
                return $this->belongsTo('App\Books', 'books_id', 'id');
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
    public function setIDAtePickerAttribute($input)
    {
        if($input != '') {
            $this->attributes['iDAtePicker'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['iDAtePicker'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getIDAtePickerAttribute($input)
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