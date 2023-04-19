<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    protected $table = 'project_featurs';
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sets()
    {
        return $this->hasMany('App\Models\ProjectFeatureSet','feature_id');
    }
    
    
    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }
    
    public function title()
    {
        if(app()->getLocale() == "fa"){
            return $this->title_fa;
        }else{
            return $this->title_en;
        }

    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            foreach ($item->sets as $set){
                $set->delete();
            }
        });
    }

}

