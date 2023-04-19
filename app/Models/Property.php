<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Property extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;
    public function langs()
    {
        return $this->hasMany('App\Models\Lang','item_id')->where('type','property');
    }
    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures');
    }
}
