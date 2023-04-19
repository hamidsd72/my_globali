<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectFeatureSet;
class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static $types=[
        'Residential' => 'مسکونی',
        'vila' => 'ویلایی',
        'Official' => 'اداری',
        'Commercial' => 'تجاری',
        'Hotel' => 'هتل',
        'ground' => 'زمین',

    ];
//    protected $fillable = ['sort_id', 'parent_id', 'name', 'slug', 'type'];

    protected  $guarded=[];
    public function parent()
    {
        return $this->hasOne('App\Models\Project', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Project', 'parent_id')->with('children');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit', 'project_id');
    }
    public function features()
    {
        return $this->hasMany('App\Models\ProjectFeatureSet', 'project_id');
    }
    public function features_g()
    {
        return $this->hasMany('App\Models\ProjectFeatureSet', 'project_id')->where('tab','general');
    }
    public function features_e()
    {
        return $this->hasMany('App\Models\ProjectFeatureSet', 'project_id')->where('tab','equlpment');
    }
    public function features_m()
    {
        return $this->hasMany('App\Models\ProjectFeatureSet', 'project_id')->where('tab','moref');
    }
    public static function feature_set($f_id,$p_id)
    {
        $res=null;
        $item=ProjectFeatureSet::where('feature_id',$f_id)->where('project_id',$p_id)->first();

        if($item)
        {
            $res=$item->value;
        }

        return $res;
    }
    public static function feature_set_en($f_id,$p_id)
    {
        $res=null;
        $item=ProjectFeatureSet::where('feature_id',$f_id)->where('project_id',$p_id)->first();

        if($item)
        {
            $res=$item->value_en;
        }

        return $res;
    }

    public function villas()
    {
        return $this->hasMany('App\Models\Villa', 'category_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function like()
    {
        return $this->hasOne('App\Models\Like', 'likable_id')->where('likable_type','project')->where('user_id',auth()->user()->id);
    }
    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures');
    }

    public function home_pic()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('name','home_pic');
    }

    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'pictures')->where('name','gallery');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

    public function plans()
    {
        return $this->morphMany('App\Models\Photo', 'pictures')->where('name','plan');
    }

    public function bird()
    {
        return $this->morphMany('App\Models\Photo', 'pictures')->where('name','bird');
    }

    public function pic_1()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Project')->where('name','pic_1');
    }
    public function pic_2()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Project')->where('name','pic_2');
    }
    public function pic_3()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Project')->where('name','pic_3');
    }
    public function pic_4()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Project')->where('name','pic_4');
    }
    public function pic_5()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','pic_5');
    }
    public function map_pic()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','map_pic');
    }
    public function access_bg()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','access_bg');
    }
    public function single_sample()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','single_sample');
    }
    public function possibilities()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','possibilities');
    }

    public function icon_possibilities()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','icon_possibilities');
    }
    public function map_home()
    {
        return $this->hasOne('App\Models\Photo', 'pictures_id')->where('pictures_type','App\Category')->where('name','map_home');
    }

    public static function types()
    {
        $array = [
//            'has_sea' => 'چشم انداز دریا',
//            'has_jungle' => 'چشم انداز جنگل',
            'is_special' => 'پیشنهاد ویژه',
//            'is_popular' => 'محبوب ترین',
        ];

        return $array;
    }
    public static function views()
    {
        $array = [
            ['id'=>1,'name'=>__('lang.project.views.1')],
            ['id'=>2,'name'=>__('lang.project.views.2')],
            ['id'=>3,'name'=>__('lang.project.views.3')],
            ['id'=>4,'name'=>__('lang.project.views.4')],
            ['id'=>5,'name'=>__('lang.project.views.5')],
            ['id'=>6,'name'=>__('lang.project.views.6')],
            ['id'=>7,'name'=>__('lang.project.views.7')],
            ['id'=>8,'name'=>__('lang.project.views.8')],
        ];

        return $array;
    }

    public static function project_types()
    {
        $array = [
            'commercial' => 'تجاری',
            'residential' => 'مسکونی',
        ];

        return $array;
    }

    public function getIsLikedAttribute()
    {
        if (auth()->check()) {

        }

        return false;
    }

    public function getMinimumPriceAttribute()
    {
        if (count($this->villas)) {
            return $this->villas->min('price');
        }

        return 0;
    }

    public static function check_pro($id,$item)
    {
        $items=json_decode($item);
//        dd($items);
        if($items)
        {
            foreach ($items as $i)
            {
                if($i==$id)
                {
                    return true;
                }
            }
        }
//        if(in_array($id,$items))
//        {
//            return true;
//        }
        return false;
    }
    public function state()
    {
        return $this->belongsTo('App\Models\City', 'state_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
    public function local()
    {
        return $this->belongsTo('App\Models\Locale', 'local_id');
    }
    public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }
    public function zine()
    {
        return $this->belongsTo('App\Models\City', 'zine_id');
    }

    public function getDescriptionAttribute()
    {
        $name = 'description_'.app()->getLocale();
        return $this->{$name};
    }

    public function trans($name)
    {
        $name = $name.'_'.app()->getLocale();
        return $this->{$name};
    }

    public function set_of_type($type)
    {
        switch ($type){
            case 'metr':
                return __('lang.project.of_metr');
                break;
            case 'k_metr':
                return __('lang.project.of_k_metr');
                break;
            case 'minit':
                return __('lang.project.of_minit');
                break;
            default:
                return 'ثبت نشده';
                break;

        }
    }


    public function langs()
    {
        return $this->hasMany('App\Models\Lang','item_id')->where('type','project');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            foreach ($item->langs as $lang){
                $lang->delete();
            }
        });
    }


    public function get_feature_fa_7(){
        $item =  ProjectFeatureSet::where('project_id',$this->id)->where('feature_id',7)->first();
        if($item){
            return $item->value;
        }else{
            return '--';
        }

    }

    public function get_feature_en_7(){
        $item =  ProjectFeatureSet::where('project_id',$this->id)->where('feature_id',7)->first();
       
        if($item){
            return $item->value_en;
        }else{
            return '--';
        }
    }

}
