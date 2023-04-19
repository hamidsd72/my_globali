<?php

namespace App\Http\Controllers\panel;

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
use App\Models\Country;
use App\Models\ProjectFeature;
use App\Models\ProjectInterest;
use App\Models\ProjectFeatureSet;
use App\Models\CollaborativeProject;
use App\Models\Category;
use App\Models\CityLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'پروژه ها';
        } elseif ('single') {
            return 'پروژه';
        }
    }
    /* public function __construct()
     {

    //     $this->middleware('permission:car_rent_col', ['only' => ['index_colleague']]);
    //     $this->middleware('permission:car_rent_message', ['only' => ['message']]);
    //     $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api|car_rent_col', ['only' => ['show']]);
     }*/

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:project_list|project_add|project_edit', ['only' => ['index']]);
        $this->middleware('permission:project_list', ['only' => ['index']]);
        $this->middleware('permission:project_add', ['only' => ['create','store']]);
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $categories = Project::orderBy('created_at', 'desc')->get();
        }else{
            $categories = Project::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }



        return view('panel.villa-categories.index', compact('categories'),
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
        $countries = Country::all();
        $cities = City::all();
        $locations = CityLocation::all();

        $properties         = Property::where('status', 'yes')->get();
        $types              = Project::$types;
        $feature            = ProjectFeature::where('status','active')->get();
        $categories = Category::all();
        return view('panel.villa-categories.create', compact('countries','cities','feature','properties','types','categories','locations'),['title' => $this->controller_title('single')]);
    }

    public function store(Request $request)
    {
         //try {

        //code
        // $check = Project::where('code', $request->code)->first();


        $item = new Project();
        $item->user_id = auth()->user()->id;
        $item->slug = $request->get('slug');
        ///$item->type = $request->get('type');
        $item->name = $request->get('name');
        $item->address = $request->get('address');
        $item->text = $request->get('text');
        $item->brief = $request->get('brief');
        $item->status = 'pending';
        $item->rent = $request->rent;
        $item->price = $request->get('price');
        $item->iframe_map = $request->get('iframe_map');
        $item->country_id = $request->get('country_id');
        $item->city_id = $request->get('city_id');
        $item->local_id = $request->get('local_id');
        $item->category_id = $request->get('category_id');
        $item->offers = $request->get('offers');

        $item->save();

        store_lang($item, $request, ['name', 'address', 'brief', 'text','status'],'create');


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


        $feature=ProjectFeature::where('status','active')->get();

        foreach ($feature as $f)
        {
            $r="feature_id_".$f->id;

            if(!blank($request->$r))
            {
                $ProjectFeatureSet = ProjectFeatureSet::create([
                    'project_id'=>$item->id,
                    'feature_id'=>$f->id,
                    'value'=>$request->$r,
                ]);
                store_lang($ProjectFeatureSet,$request,[$r],'create');
            }
        }


        /*  $item->meta()->create([
              'name_page' => $request->page_name_meta,
              'description' => $request->description_meta,
              'keyword' => $request->keyword_meta,
              'title_page' => $request->page_title_meta,
              'priority' => $request->priority_meta,
              'schima' => $request->schima,
          ]);*/


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


        return redirect()->route('panel.project-list')->with('flash_message', 'The item was registered successfully.');

        //} catch (\Exception $e) {
        //    return redirect()->back()->withInput()->with('err_message', 'Something went wrong, please try again.');
        //}
    }

    public function edit($lang,$id)
    {
        $category = Project::findOrFail($id);

        $countries = Country::all();
        $cities = City::all();
        $locations = CityLocation::all();

        $feature=ProjectFeature::where('status','active')->get();
        $categories = Category::all();

        return view('panel.villa-categories.edit', compact( 'categories', 'cities', 'category','feature','countries','categories','locations'),
            ['title' => $this->controller_title('single')]);
    }

    public function update(Request $request, $lang, $id)
    {
        $category = Project::findOrFail($id);

        // try {
        // $check = Project::where('code', $request->code)->first();
        // if ($check && $check->code != $category->code) {
        //     return redirect()->back()->withInput()->with('err_message', 'کد تکراری است');
        // }


        //new field - general

        $category->slug = $request->get('slug');
        $category->type = $request->get('type');
        $category->name = $request->get('name');
        $category->address = $request->get('address');
        $category->text = $request->get('text');
        $category->brief = $request->get('brief');
/*        $category->status = $request->status ? $request->status : 'pending';*/
        $category->rent = $request->rent;
        $category->price = $request->get('price');
        $category->iframe_map = $request->get('iframe_map');
        $category->country_id = $request->get('country_id');
        $category->city_id = $request->get('city_id');
        $category->local_id = $request->get('local_id');
        $category->category_id = $request->get('category_id');
        $category->offers = $request->get('offers');

        $category->save();

        //store_lang($category, $request, ['name', 'address', 'brief', 'text','status'],'edit');

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
        /*   if ($request->hasFile('plan')) {
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
           }*/


        /*  $villas = Villa::where([
              ['category_id', $category->id],
          ])->get();

          foreach ($villas as $villa) {
              $villa->location_id = $category->location_id;
              $villa->district = $category->district;
              $villa->save();
          }*/

        /* if(count($category->features))
         {
             foreach ($category->features as $ff)
             {
                 $ff->delete();
             }
         }*/

        $feature=ProjectFeature::where('status','active')->get();

        foreach ($feature as $f)
        {
            $r="feature_id_".$f->id;

            if(!blank($request->$r))
            {
                $ProjectFeatureSet = ProjectFeatureSet::where('project_id',$category->id)->where('feature_id',$f->id)->first();
                if($ProjectFeatureSet != null){

                    $ProjectFeatureSet->project_id =$category->id;
                    $ProjectFeatureSet->feature_id = $f->id;
                    $ProjectFeatureSet->value = $request->$r;
                    $ProjectFeatureSet->save();
                }else{
                    $ProjectFeatureSet = ProjectFeatureSet::create([
                        'project_id'=>$category->id,
                        'feature_id'=>$f->id,
                        'value'=>$request->$r,
                    ]);
                }

                store_lang($ProjectFeatureSet,$request,[$r],'edit');
            }
        }


        /* $meta = Meta::where('metaable_id',$category->id)->first();
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
         }*/

        // store_lang($request, 'vila_category', $category->id, ['name', 'Property1', 'Property2', 'Property3', 'address', 'brief', 'description']);

        return redirect()->route('panel.project-list',app()->getLocale())->with('flash_message', 'The project was edited successfully.');

        // } catch (\Exception $e) {
        //     return redirect()->back()->withInput();
        // }

    }

    public function destroy($lang,$id)
    {

        $category = Project::findOrFail($id);

        try {
            if(count($category->features))
            {
                foreach ($category->features as $ff)
                {
                    $ff->delete();
                }
            }
            $category->delete();
            return redirect()->route('admin.villa-category-list')->with('flash_message', 'The project was successfully deleted.');

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

    public function photo_destroy($lang,$id)
    {

        $photo = Photo::findOrFail($id);
        try {
            try {
                File::delete($photo->path);
            } catch (\Exception $e) {
            }
            $photo->delete();
            return back()->with('flash_message', 'The project photo has been successfully deleted.');

        } catch (\Exception $e) {

            return redirect()->back();

        }
    }

    public function status($lang,$id,$status)
    {

        $project = Project::findOrFail($id);

        try {
           if($status == "active"){
               $project->status = "active";
           }else if($status == "pending"){
               $project->status = "pending";
           }
            $project->save();
           
            return back()->with('flash_message', 'Project status changed.');

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



}