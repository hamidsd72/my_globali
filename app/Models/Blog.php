<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','photo');
    }

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if($item->photo)
            {
                if(is_file($item->photo->path))
                {
                    File::delete($item->photo->path);
                }
                $item->photo->delete();
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