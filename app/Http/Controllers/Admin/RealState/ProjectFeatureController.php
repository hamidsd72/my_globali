<?php

namespace App\Http\Controllers\Admin\RealState;

use App\Models\ProjectFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectFeatureController extends Controller
{
    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'فیچرها';
        } elseif ('single') {
            return 'فیچر';
        }
    }
    
    // TODO
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    // public function __construct()
    // {
    //     $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api', ['only' => ['index']]);
    //     $this->middleware('permission:car_rent_col', ['only' => ['index_colleague']]);
    //     $this->middleware('permission:car_rent_message', ['only' => ['message']]);
    //     $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api|car_rent_col', ['only' => ['show']]);
    // }

    public function index()
    {
        $items = ProjectFeature::orderByDesc('id')->get();
        return view('admin.real_state.project_feature.index', compact('items'), ['title' => $this->controller_title('sum')]);
    }
    public function create()
    {
        return view('admin.real_state.project_feature.create', ['title' => $this->controller_title('single')]);
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'fa' => 'required|max:255',
            'en' => 'required|max:255',
            'ru' => 'required|max:255',
            'ar' => 'required|max:255',
         ]);
        try {
            $item   = ProjectFeature::create($request->only('fa_status','en_status','ru_status', 'ar_status', 'type','tab','filter'));
            set_lang($item,'fa',$request->fa,'title','create');
            set_lang($item,'en',$request->en,'title','create');
            set_lang($item,'ru',$request->ru,'title','create');
            set_lang($item,'ar',$request->ar,'title','create');
            return redirect()->route('admin.project-feature.index')->with('flash_message', ' با موفقیت افزوده شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $item = ProjectFeature::findOrFail($id);
        return view('admin.real_state.project_feature.edit', compact('item'), ['title' => $this->controller_title('single')]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fa' => 'required|max:255',
            'en' => 'required|max:255',
            'ru' => 'required|max:255',
            'ar' => 'required|max:255',
        ]);
        $item = ProjectFeature::findOrFail($id);
        try {
            $item->fa_status    = $request->fa_status ? $request->fa_status : 'pending';
            $item->en_status    = $request->en_status ? $request->en_status : 'pending';
            $item->ru_status    = $request->ru_status ? $request->ru_status : 'pending';
            $item->ar_status    = $request->ar_status ? $request->ar_status : 'pending';
            $item->type         = $request->type;
            $item->tab          = $request->tab;
            $item->filter       = $request->filter;
            $item->update();

            set_lang($item,'fa',$request->fa,'title','edit');
            set_lang($item,'en',$request->en,'title','edit');
            set_lang($item,'ru',$request->ru,'title','edit');
            set_lang($item,'ar',$request->ar,'title','edit');

            store_lang($item, $request, ['title', 'description', 'keywords'], 'edit');

            return redirect()->route('admin.project-feature.index')->with('flash_message', 'updated successfully');

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withInput();

        }

    }

    public function destroy($id)
    {
        $item = ProjectFeature::findOrFail($id);

        try {
           /* if(count($item->sets))
            {
                return redirect()->back()->with('flash_message', 'آمکان حذف وجود ندارد بدلیل استفاده در پروژه ها(غیرفعال کنید).');
            }*/
            $item->delete();
            return redirect()->back()->with('flash_message', ' با موفقیت حذف شد.');

        } catch (\Exception $e) {
            return redirect()->back();

        }
    }

}