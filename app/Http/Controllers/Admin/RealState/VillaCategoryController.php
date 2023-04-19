<?php

namespace App\Http\Controllers\Admin\RealState;

use App\Http\Requests\CategoryRequest;
use App\Models\Meta;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\City;
use App\Models\Project;
use App\Models\Photo;
use App\Models\Villa;
use App\Models\Location;
use App\Models\User;
use App\Models\Property;
use App\Models\Locale;
use App\Models\ProjectFeature;
use App\Models\ProjectInterest;
use App\Models\ProjectFeatureSet;
use App\Models\CollaborativeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Auth;

class VillaCategoryController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'پروژه ها';
        } elseif ('single') {
            return 'پروژه';
        }
    }
    // public function __construct()
    // {
    //     $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api', ['only' => ['index']]);
    //     $this->middleware('permission:car_rent_col', ['only' => ['index_colleague']]);
    //     $this->middleware('permission:car_rent_message', ['only' => ['message']]);
    //     $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api|car_rent_col', ['only' => ['show']]);
    // }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Project::where(['parent_id' => null, 'type' => 'villa'])->with('children')
            ->orderBy('created_at', 'desc')->with('user')
            ->get()//            ->paginate($this->controller_paginate())
        ;

        return view('admin.real_state.villa-categories.index', compact('categories'),
            ['title' => $this->controller_title('sum')]);
    }

    // public function sort_item(Request $request)
    // {
    //     $category_item_sort = json_decode($request->sort);
    //     $this->sort_category($category_item_sort, null);
    // }

    // private function sort_category(array $category_items, $parent_id)
    // {
    //     foreach ($category_items as $index => $category_item) {
    //         $item = Project::findOrFail($category_item->id);
    //         $item->sort_id = $index + 1;
    //         $item->parent_id = $parent_id;
    //         $item->save();
    //         if (isset($category_item->children)) {
    //             $this->sort_category($category_item->children, $item->id);
    //         }
    //     }
    // }

    public function create()
    {
        // $locations = Location::get();
        // $cities = City::take(200)->get();
        // $locals = Locale::all();
        $countries          = json_decode(file_get_contents(asset('assets/plugins/countries/countries.json')), true);
        $cities             = json_decode(file_get_contents(asset('assets/plugins/countries/cities.json')), true);
        $cities             = $cities;
        $properties         = Property::where('status', 'yes')->get();
        $types              = Project::$types;
        $feature            = ProjectFeature::where('status','active')->get();
        return view('admin.real_state.villa-categories.create', compact('countries','cities','feature','properties','types'),['title' => $this->controller_title('single')]);
    }

    public function store(Request $request)
    {
        try {

            //code
            // $check = Project::where('code', $request->code)->first();

            //new field - general
            

            //translate
            
            $item = new Project();
            $item->type = 'villa';
            $item->show_in_index = $request->get('show_in_index');
            $item->ref = $request->get('ref');
            $item->pot = $request->get('pot');
            $item->bedroom = $request->get('bedroom');
            $item->bathrooms = $request->get('bathrooms');
            $item->parking = $request->get('parking');
            $item->auto_lighting = $request->get('auto_lighting');
            $item->teras = $request->get('teras');
            $item->pool = $request->get('pool');
            $item->constructed_area = $request->get('constructed_area');
            // $item->description_en = translate($request->get('description_fa'), 'fa', 'en');
            // $item->name_en = translate($request->get('name_fa'), 'fa', 'en');
            // $item->brief_en = translate($request->get('brief_fa'), 'fa', 'en');
            // $item->address_en = translate($request->get('address_fa'), 'fa', 'en');

            // $request->description_tr = translate($request->get('description_fa'), 'fa', 'tr');
            // $request->name_tr = translate($request->get('name_fa'), 'fa', 'tr');
            // $request->brief_tr = translate($request->get('brief_fa'), 'fa', 'tr');
            // $request->address_tr = translate($request->get('address_fa'), 'fa', 'tr');

            
            
            $item->name_fa = $request->get('name_fa');
            $item->code = $request->get('code');
            $item->slug = $request->get('slug');
            $item->brief_fa = $request->get('brief_fa');
            $item->description_fa = $request->get('description_fa');
            $item->p_option_fa = $request->get('p_option_fa');
            $item->p_option_en = $request->get('p_option_en');
            $item->city_name = $request->get('city_name');
            $item->city_name_en = $request->get('city_name_en');
            $item->local_id = $request->get('local_id');
            $item->type = $request->get('type');
            $item->address_fa = $request->get('address_fa');
            $item->Property1_fa = $request->get('Property1_fa');
            $item->Property2_fa = $request->get('Property2_fa');
            $item->Property3_fa = $request->get('Property3_fa');

            $item->name_en = $request->get('name_en');
            $item->brief_en = $request->get('brief_en');
            $item->address_en = $request->get('address_en');
            $item->description_en = $request->get('description_en');
            $item->Property1_en = $request->get('Property1_en');
            $item->Property2_en = $request->get('Property2_en');
            $item->Property3_en = $request->get('Property3_en');
            

            $item->unit = $request->get('unit');
            $item->toilet = $request->get('toilet');
            $item->livingroom = $request->get('livingroom');
            $item->diningroom = $request->get('diningroom');
            $item->yearofrenovation = $request->get('yearofrenovation');
            $item->view = $request->get('view');
            $item->heating = $request->get('heating');
            $item->aircondition = $request->get('aircondition');
            $item->loundryroom = $request->get('loundryroom');
            $item->skitchen = $request->get('skitchen');
            $item->storageroom = $request->get('storageroom');
            $item->barbecue = $request->get('barbecue');
            $item->fireplace = $request->get('fireplace');
            $item->orientation = $request->get('orientation');
            $item->terraintype = $request->get('terraintype');
            $item->dis_sea = $request->get('dis_sea');
            $item->dis_center = $request->get('dis_center');
            $item->restaurant = $request->get('restaurant');
            $item->project_status = $request->get('project_status');
            $item->priceF = $request->get('priceF');

            $item->area = $request->get('area');
            $item->floor = $request->get('floor');
            $item->of_sea = $request->get('of_sea');
            $item->of_airport = $request->get('of_airport');
            $item->of_sea_type = $request->get('of_sea_type');
            $item->of_airport_type = $request->get('of_airport_type');
            $item->from_price = $request->get('from_price');
            $item->video_link1 = $request->get('video_link1');
            $item->video_link2 = $request->get('video_link2');
            $item->youtub_link_1 = $request->get('youtub_link_1');
            $item->youtub_link_2 = $request->get('youtub_link_2');
            $item->google_driver_1 = $request->get('google_driver_1');
            $item->google_driver_2 = $request->get('google_driver_2');
            $item->bird_youtub_link = $request->get('bird_youtub_link');
            $item->map = $request->get('map');
            $item->properties_in = json_encode($request->properties_in);
            $item->properties_out = json_encode($request->properties_out);
            $item->properties_access = json_encode($request->properties_access);
            $item->status_fa = $request->status_fa ? $request->status_fa : 'active';
            $item->status_en = $request->status_en ? $request->status_en : 'pending';
            $item->status_tr = $request->status_tr ? $request->status_tr : 'pending';
            $item->status_ru = $request->status_ru ? $request->status_ru : 'pending';
            $item->built_year = $request->built_year;
            $item->b_or_t = $request->b_or_t;
            $item->furniture = $request->furniture;
            $item->kitchen = $request->kitchen;
            $item->room_num = $request->room_num;
            $item->type = $request->type;
            $item->map = $request->map;
            $item->bedroom = $request->bedroom;
            $item->rent = $request->rent;
            $item->place_description = $request->place_description;
            $item->short_text_1 = $request->short_text_1;
            $item->count_description = $request->count_description;
            $item->meter_description = $request->meter_description;
            $item->access_text = $request->access_text;
            $item->price = str_replace(',', '', $request->price);
            $item->villa_view = json_encode($request->villa_view);
            $item->user_id = auth()->id() ?? 00;
            // $item->zone_id = $request->get('zone_id');
            // $item->district = $request->get('district');
            $item->latitude = $request->get('latitude');
            $item->longitude = $request->get('longitude');
            $item->discount = $request->get('discount');
            $item->show_customer_club = $request->get('show_customer_club');
            $item->discount_price = $request->get('discount_price');
            $item->iframe_map = $request->get('iframe_map');

            $item->save();
            //store_lang($request, 'project', $item->id, ['name', 'address', 'brief', 'description']);

            if ($request->hasFile('photo_subheader')) {
                $item->sub_photo = file_store($request->photo_subheader, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');;
            }
            if ($request->hasFile('pic_share')) {
                $item->pic_share = file_store($request->pic_share, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/', 'share-');;
            }
            if ($request->hasFile('video')) {
                $item->video = file_store($request->video, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
            }
            if ($request->hasFile('video_ru')) {
                $item->video_ru = file_store($request->video_ru, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
            }
            if ($request->hasFile('video_en')) {
                $item->video_en = file_store($request->video_en, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
            }
            if ($request->hasFile('video_ar')) {
                $item->video_ar = file_store($request->video_ar, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
            }
            if ($request->hasFile('video_fa')) {
                $item->video_fa = file_store($request->video_fa, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
            }

            if ($request->hasFile('pic')) {
                $item->pic = file_store($request->pic, 'source/assets/uploads/categories/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/', 'pic-');;
            }
            $item->save();

            $files = $request->file('gallery');
            if ($request->hasFile('gallery')) {
                foreach ($files as $file) {
                    $photo = new Photo();
                    $photo->path = file_store($file, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                    $photo->name = 'gallery';
                    $item->photo()->save($photo);
                }
            }
            $plans = $request->file('plan');
            if ($request->hasFile('plan')) {
                foreach ($plans as $plan) {
                    $photo = new Photo();
                    $photo->path = file_store($plan, 'source/assets/uploads/categories/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/plans/', 'plan-');
                    $photo->name = 'plan';
                    $item->plans()->save($photo);
                }
            }

            if ($request->hasFile('home_pic')) {
                $home_pic = $request->file('home_pic');
                $photo = new Photo();
                $photo->path = file_store($home_pic, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/home_pic/', 'home_pic-');
                $photo->name = 'home_pic';
                $item->home_pic()->save($photo);
            }

            $feature=ProjectFeature::where('status','active')->get();

            foreach ($feature as $f)
            {
                $r="feature_id_".$f->id;
                $text_en="feature_en_id_".$f->id;

                if(!blank($request->$r))
                {
                    ProjectFeatureSet::create([
                        'project_id'=>$item->id,
                        'feature_id'=>$f->id,
                        'value'=>$request->$r,
                        'value_en'=>$request->$text_en,
                        'tab'=>$f->tab,
                    ]);
                }
            }


            $item->meta()->create([
                'name_page' => $request->page_name_meta,
                'description' => $request->description_meta,
                'keyword' => $request->keyword_meta,
                'title_page' => $request->page_title_meta,
                'priority' => $request->priority_meta,
                'schima' => $request->schima,
            ]);


            // $birds = $request->file('bird');
            // if ($request->hasFile('bird')) {
            //     foreach ($birds as $plan) {
            //         $photo = new Photo();
            //         $photo->path = file_store($plan, 'source/assets/uploads/categories/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/plans/', 'plan-');
            //         $photo->name = 'bird';
            //         $item->bird()->save($photo);
            //     }
            // }

            // store_lang($request, 'vila_category', $item->id, ['name', 'Property1', 'Property2', 'Property3', 'address', 'brief', 'description']);


            return redirect()->route('admin.villa-category-list')->with('flash_message', 'ایتم با موفقیت افزوده شد.');

        } catch (\Exception $e) {
            dd($e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('err_message', 'مشکلی پیش آمده لطفا مجدد تلاش کنید.');
        }
    }

    public function edit($id)
    {
        $category = Project::with('photos', 'photo', 'plans')->findOrFail($id);
        $locations = Location::get();
        $location = Location::find($category->location_id);
        if ($location) {
            $districts = unserialize($location->districts);
        } else {
            $districts = [];
        }
        $cities = City::all();
        $locals = Locale::all();
        $citys = City::where('state_id', $category->state_id)->where('city_id', null)->get();
        $zones = City::where('city_id', $category->city_id)->get();
        $categories = Project::where('type', 'villa')->latest()->get();
        $propertiesin = Property::where('type', 0)->get();
        $propertiesout = Property::where('type', 1)->get();
        $propertiesaccess = Property::where('type', 2)->get();
        $types = Project::$types;
        $feature=ProjectFeature::where('status','active')->get();
        return view('admin.real_state.villa-categories.edit', compact('locals', 'categories', 'propertiesin',
            'propertiesout', 'propertiesaccess', 'cities', 'citys', 'zones', 'category', 'locations', 'districts', 'types','feature'),
            ['title' => $this->controller_title('single')]);
    }

    public function update(Request $request, $id)
    {
        $category = Project::findOrFail($id);

        // try {
        // $check = Project::where('code', $request->code)->first();
        // if ($check && $check->code != $category->code) {
        //     return redirect()->back()->withInput()->with('err_message', 'کد تکراری است');
        // }


        //new field - general
        $category->show_in_index = $request->get('show_in_index');
        $category->ref = $request->get('ref');
        $category->pot = $request->get('pot');
        $category->constructed_area = $request->get('constructed_area');
        $category->bedroom = $request->get('bedroom');
        $category->bathrooms = $request->get('bathrooms');
        $category->parking = $request->get('parking');
        $category->auto_lighting = $request->get('auto_lighting');
        $category->teras = $request->get('teras');
        $category->pool = $request->get('pool');


        $category->name_fa = $request->get('name_fa');
        // $category->code = $request->get('code');
        $category->slug = $request->get('slug');
        $category->brief_fa = $request->get('brief_fa');
        $category->address_fa = $request->get('address_fa');
        $category->description_fa = $request->get('description_fa');
        $category->p_option_fa = $request->get('p_option_fa');
        $category->p_option_en = $request->get('p_option_en');
        $category->Property1_fa = $request->get('Property1_fa');
        $category->Property2_fa = $request->get('Property2_fa');
        $category->Property3_fa = $request->get('Property3_fa');
        $category->type = $request->get('type_id');

        $category->name_en = $request->get('name_en');
        $category->brief_en = $request->get('brief_en');
        $category->address_en = $request->get('address_en');
        $category->Property1_en = $request->get('Property1_en');
        $category->Property2_en = $request->get('Property2_en');
        $category->Property3_en = $request->get('Property3_en');
        $category->description_en = $request->get('description_en');

        $category->unit = $request->get('unit');
        $category->toilet = $request->get('toilet');
        $category->livingroom = $request->get('livingroom');
        $category->diningroom = $request->get('diningroom');
        $category->yearofrenovation = $request->get('yearofrenovation');
        $category->view = $request->get('view');
        $category->heating = $request->get('heating');
        $category->aircondition = $request->get('aircondition');
        $category->loundryroom = $request->get('loundryroom');
        $category->skitchen = $request->get('skitchen');
        $category->storageroom = $request->get('storageroom');
        $category->barbecue = $request->get('barbecue');
        $category->fireplace = $request->get('fireplace');
        $category->orientation = $request->get('orientation');
        $category->terraintype = $request->get('terraintype');
        $category->dis_sea = $request->get('dis_sea');
        $category->dis_center = $request->get('dis_center');
        $category->restaurant = $request->get('restaurant');
        $category->project_status = $request->get('project_status');
        $category->priceF = $request->get('priceF');

        $category->area = $request->get('area');
        $category->floor = $request->get('floor');
        $category->of_sea = $request->get('of_sea');
        $category->of_sea_type = $request->get('of_sea_type');
        $category->type = $request->get('type');
        $category->of_airport = $request->get('of_airport');
        $category->of_airport_type = $request->get('of_airport_type');
        $category->from_price = $request->get('from_price');
        $category->latitude = $request->get('latitude');
        $category->longitude = $request->get('longitude');
        $category->state_id = $request->get('state_id');
        $category->city_name = $request->get('city_name');
        $category->city_name_en = $request->get('city_name_en');
        $category->local_id = $request->get('local_id');
        // $category->zone_id = $request->get('zone_id');
        // $category->location_id = $request->get('location_id');
        // $category->district = $request->get('district');
        $category->address_fa = $request->get('address_fa');
        $category->video_link1 = $request->get('video_link1');
        $category->video_link2 = $request->get('video_link2');
        $category->youtub_link_1 = $request->get('youtub_link_1');
        $category->youtub_link_2 = $request->get('youtub_link_2');
        $category->google_driver_1 = $request->get('google_driver_1');
        $category->google_driver_2 = $request->get('google_driver_2');
        $category->bird_youtub_link = $request->get('bird_youtub_link');
        $category->map = $request->get('map');
        $category->properties_in = json_encode($request->properties_in);
        $category->properties_out = json_encode($request->properties_out);
        $category->status_fa = $request->status_fa ? $request->status_fa : 'active';
        $category->status_en = $request->status_en ? $request->status_en : 'pending';
        $category->status_tr = $request->status_tr ? $request->status_tr : 'pending';
        $category->status_ru = $request->status_ru ? $request->status_ru : 'pending';
        $category->built_year = $request->built_year;
        // $category->b_or_t = $request->b_or_t;
        // $category->furniture = $request->furniture;
        // $category->kitchen = $request->kitchen;
        // $category->room_num = $request->room_num;
        $category->type = $request->type;
        // $category->map = $request->map;
        // $category->place_description = $request->place_description;
        // $category->short_text_1 = $request->short_text_1;
        // $category->count_description = $request->count_description;
        // $category->meter_description = $request->meter_description;
        // $category->access_text = $request->access_text;
        $category->price = $request->price;
        $category->bedroom = $request->bedroom;
        $category->rent = $request->rent;
        $category->villa_view = json_encode($request->villa_view);
        $category->properties_access = json_encode($request->properties_access);
        $category->discount = $request->get('discount');
        $category->show_customer_club = $request->get('show_customer_club');
        $category->discount_price = $request->get('discount_price');
        $category->iframe_map = $request->get('iframe_map');

        if ($request->hasFile('video')) {
            if ($category->video != null) {
                File::delete($category->video);
            }
            $category->video = file_store($request->video, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
        }


        if ($request->hasFile('pic_share')) {
            if ($category->pic_share != null) {
                File::delete($category->pic_share);
            }
            $category->pic_share = file_store($request->pic_share, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/', 'share-');;
        }
        if ($request->hasFile('pic')) {
            if ($category->pic != null) {
                File::delete($category->pic);
            }
            $category->pic = file_store($request->pic, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/', 'pic-');;
        }

        if ($request->hasFile('video_ru')) {
            if (file_exists($category->video_ru)) {
                File::delete($category->video_ru);
            }
            $category->video_ru = file_store($request->video_ru, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
        }
        if ($request->hasFile('video_en')) {
            if (file_exists($category->video_en)) {
                File::delete($category->video_en);
            }
            $category->video_en = file_store($request->video_en, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
        }
        if ($request->hasFile('video_ar')) {
            if (file_exists($category->video_en)) {
                File::delete($category->video_en);
            }
            $category->video_ar = file_store($request->video_ar, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
        }
        if ($request->hasFile('video_fa')) {

            if (file_exists($category->video_fa)) {
                File::delete($category->video_fa);
            }

            $category->video_fa = file_store($request->video_fa, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/video/', 'video-');;
        }

        //store_lang($request, 'project', $category->id, ['name', 'address', 'brief', 'description']);
        $category->save();

        if ($request->hasFile('gallery')) {
            $files = $request->file('gallery');
            foreach ($files as $file) {
                $photo = new Photo();
                $photo->path = file_store($file, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $photo->name = 'gallery';
                $category->photos()->save($photo);
            }
        }
        if ($request->hasFile('plan')) {
            foreach ($category->plans as $photo) {
                File::delete($photo->path);
                $photo->delete();
            }
            $plans = $request->file('plan');
            foreach ($plans as $plan) {
                $photo = new Photo();
                $photo->path = file_store($plan, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/plans/', 'plan-');
                $photo->name = 'plan';
                $category->plans()->save($photo);
            }
        }


        if ($request->hasFile('home_pic')) {
            if ($category->home_pic) {
                File::delete($category->home_pic->path);
                $category->home_pic->delete();
            }
            $home_pic = $request->file('home_pic');
            $photo = new Photo();
            $photo->path = file_store($home_pic, 'source/assets/uploads/pr/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/home_pic/', 'home_pic-');
            $photo->name = 'home_pic';
            $category->home_pic()->save($photo);
        }


        $villas = Villa::where([
            ['category_id', $category->id],
        ])->get();

        foreach ($villas as $villa) {
            $villa->location_id = $category->location_id;
            $villa->district = $category->district;
            $villa->save();
        }

        if(count($category->features))
        {
            foreach ($category->features as $ff)
            {
                $ff->delete();
            }
        }

        $feature=ProjectFeature::where('status','active')->get();

        foreach ($feature as $f)
        {
            $r="feature_id_".$f->id;
            $text_en="feature_en_id_".$f->id;

            if(!blank($request->$r))
            {
                ProjectFeatureSet::create([
                    'project_id'=>$category->id,
                    'feature_id'=>$f->id,
                    'value'=>$request->$r,
                    'value_en'=>$request->$text_en,
                    'tab'=>$f->tab,
                ]);
            }
        }

        $meta = Meta::where('metaable_id',$category->id)->first();
        if($meta){
            $meta->update([
                'name_page' => $request->page_name_meta,
                'description' => $request->description_meta,
                'keyword' => $request->keyword_meta,
                'title_page' => $request->page_title_meta,
                'priority' => $request->priority_meta,
                'schima' => $request->schima,
            ]);
        }else{
            $category->meta()->create([
                'name_page' => $request->page_name_meta,
                'description' => $request->description_meta,
                'keyword' => $request->keyword_meta,
                'title_page' => $request->page_title_meta,
                'priority' => $request->priority_meta,
                'schima' => $request->schima,
            ]);
        }

        // store_lang($request, 'vila_category', $category->id, ['name', 'Property1', 'Property2', 'Property3', 'address', 'brief', 'description']);

        return redirect()->route('admin.villa-category-list')->with('flash_message', 'پروژه با موفقیت ویرایش شد.');

        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput();
        // }

    }

    public function destroy($id)
    {

        $category = Project::findOrFail($id);
        if (count($category->children)) {
            return redirect()->route('admin.villa-category-list')->with('err_message', 'دسته بندی شامل زیردسته می باشد');
        }
        // if (count($category->villas)) {
        //     return redirect()->route('villa-category-list')->with('err_message', 'دسته بندی به ملک متصل می باشد');
        // }

        try {
            if(count($category->features))
            {
                foreach ($category->features as $ff)
                {
                    $ff->delete();
                }
            }
            $category->delete();
            return redirect()->route('admin.villa-category-list')->with('flash_message', 'پروژه با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function video_delete($id)
    {

        $category = Project::findOrFail($id);
        try {

            File::delete($category->video);
            $category->video = null;
            $category->update();
            return redirect()->back()->with('flash_message', 'ویدئو با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function video_delete_lang($id, $lang)
    {

        $category = Project::findOrFail($id);
        try {
            if ($lang == 'ar') {
                File::delete($category->video_ar);
                $category->video_ar = null;
            } else if ($lang == 'en') {
                File::delete($category->video_en);
                $category->video_en = null;
            } else if ($lang == 'ru') {
                File::delete($category->video_ru);
                $category->video_ru = null;
            } else if ($lang == 'ru') {
                File::delete($category->video_ru);
                $category->video_ru = null;
            } else if ($lang == 'fa') {
                File::delete($category->video_fa);
                $category->video_fa = null;
            }

            $category->update();
            return redirect()->back()->with('flash_message', 'ویدئو با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function photo_destroy($id)
    {

        $photo = Photo::findOrFail($id);
        try {
            try {
                File::delete($photo->path);
            } catch (\Exception $e) {
            }
            $photo->delete();
            return back()->with('flash_message', 'عکس پروژه با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function detail(Request $request)
    {
        $id = $request->get('id');

        $category = Project::find($id);
        $data = [];
        if ($category) {
            $data = $category;
        }


        return response()->json([
            'data' => $data
        ]);
    }

//    unit cod
    public function unit_index($id)
    {
        $project = Project::find($id);
        if ($project) {
            $title = 'لیست واحد های پروژه : ' . $project->name;
            $items = Unit::where('project_id', $id)->get();
            return view('panel.villa-categories.unit.index', compact('items', 'project'), ['title' => $title]);
        } else {
            return redirect()->back()->with('err_message', 'مشکلی پیش آمده دوباره تلاش کنید.');
        }

    }

    public function unit_create($id)
    {

        $project = Project::find($id);
        $titel = 'افزودن واحد به پروژه ' . $project->name;
        return view('panel.villa-categories.unit.create', compact('project'), ['title' => $titel]);
    }

    public function unit_store(Request $request, $id)
    {
        try {

            $item = new Unit();
            $item->name = $request->name;
            $item->code = $request->code;
            $item->room = $request->room;
            $item->direction = $request->direction;
            $item->area = $request->area;
            $item->bathroom = $request->bathroom;
            $item->b_or_t = $request->b_or_t;
            $item->price = $request->price;
            $item->price_from = $request->price_from;
            $item->project_id = $id;
            $item->save();
            return redirect()->route('unit-list', $id)->with('flash_message', 'واحد  با موفقیت افزوده شد.');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('flash_message', 'مشکلی پیش آمده لطفا مجدد تلاش کنید');

        }
    }

    public function unit_edit($id)
    {

        $item = Unit::findOrFail($id);
        return view('panel.villa-categories.unit.edit', compact('item'), ['title' => $this->controller_title('single')]);
    }

    public function unit_update(Request $request, $id)
    {
        $item = Unit::findOrFail($id);

        try {

            $item->name = $request->name;
            $item->code = $request->code;
            $item->room = $request->room;
            $item->direction = $request->direction;
            $item->area = $request->area;
            $item->bathroom = $request->bathroom;
            $item->b_or_t = $request->b_or_t;
            $item->price = $request->price;
            $item->price_from = $request->price_from;
            $item->update();
            return redirect()->route('unit-list', $item->project_id)->with('flash_message', 'واحد  با موفقیت افزوده شد.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('flash_message', 'مشکلی پیش آمده لطفا مجدد تلاش کنید');

        }

    }

    public function unit_destroy($id)
    {
        $post = Unit::findOrFail($id);

        try {

            $post->delete();
            return redirect()->back()->with('flash_message', ' با موفقیت حذف شد.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function favorite()
    {
        $title = "لیست پروژه ها";
        $user = User::findOrFail(Auth::user()->id);
        $items = ProjectInterest::with('project')->where('user_id',$user->id)->get();
        //    dd($items);
        return view('admin.user.project.index',compact('items','title'));
    }

    public function partnership_investment()
    {
        $user = User::findOrFail(Auth::user()->id);
        $role = $user->roles->first();
        if($user->status == "pending" || $user->id_cart == null){
            return redirect()->route('admin.profile.show')->with([
                'flash_message' => __('trans.warning')

            ]);

        }else {
            $title = "لیست پروژه ها";
            $user = User::findOrFail(Auth::user()->id);
            $items = CollaborativeProject::with('langs')->orderByDesc('created_at')->take(3)->get();
            return view('admin.user.partnership.index', compact('items', 'title'));
        }
    }

    public function offer_project()
    {
        $user = User::findOrFail(Auth::user()->id);
        $role = $user->roles->first();
        if($user->status == "pending" || $user->id_cart == null){
            return redirect()->route('admin.profile.show')->with([
                'flash_message' => __('trans.warning')
            ]);

        }else {
            $title = "لیست پروژه ها";
            $user = User::findOrFail(Auth::user()->id);
            $items = Project::with('langs')->where('show_customer_club', 'yes')->orderByDesc('created_at')->take(3)->get();
            return view('admin.user.offer.index', compact('items', 'title'));
        }
    }

}