<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Setting extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function logo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','logo');
    }
    public function icon()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','icon');
    }

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if($item->logo)
            {
                if(is_file($item->logo->path))
                {
                    File::delete($item->logo->path);
                }
                $item->logo->delete();
            }
            if($item->icon)
            {
                if(is_file($item->icon->path))
                {
                    File::delete($item->icon->path);
                }
                $item->icon->delete();
            }
            if(count($item->langs))
            {
                foreach ($item->langs as $lang)
                {
                    $lang->delete();
                }
            }


        });
    }
}