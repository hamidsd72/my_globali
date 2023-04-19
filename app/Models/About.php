<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class About extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }
    public static function type_about($item)
    {
        switch ($item)
        {
            case 'about':
                $res='صفحه درباره ما';
                break;
            case 'home':
                $res='صفحه اصلی';
                break;
            case 'footer':
                $res='فوتر';
                break;
            case 'conditions':
                $res='شرایط اجاره';
                break;
            default:
                $res='ثبت نشده';
                break;

        }
        return $res;
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
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