<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class FileUpload extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'fileupload';
    
    protected $fillable = ['sFileUpload'];
    

    public static function boot()
    {
        parent::boot();

        FileUpload::observe(new UserActionsObserver);
    }
    
    
    
    
}