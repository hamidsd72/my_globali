<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFeatureSet extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function feature()
    {
        return $this->belongsTo('App\Models\ProjectFeatur', 'feature_id');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\ProjectFeatur', 'project_id');
    }

    public function value()
    {
        if(app()->getLocale() == "fa"){
            return $this->value;
        }else{
            return $this->value_en;
        }

    }

}
