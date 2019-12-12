<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
    	'title',
    	'file',
        'active',
        'order'
    ];

    /**
    * Get the country that belongs
    */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

}
