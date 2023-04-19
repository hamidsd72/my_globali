<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\ProjectFeature;
use App\Http\Requests\PostRequest;
//use App\Models\Photo;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ProjectFeatureController extends Controller
{

    public function controller_title($type)
    {
        if ($type == 'sum') {
            return 'فیچر';
        } elseif ('single') {
            return 'فیچر';
        }
    }

    public function controller_paginate()
    {
        $settings = Setting::select('paginate')->latest()->firstOrFail();
        return $settings->paginate;
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        dd('dsfs');
        $title = ' فیچر';
        $items = ProjectFeature::orderByDesc('id')->get();
        return view('admin.setting.real_state.project.feature.index', compact('items'), ['title' => $title]);
    }
    public function create($type = null)
    {
        $title = ' فیچر';
        return view('admin.setting.real_state.project.feature.create', ['title' => $title]);
    }

    public function store(Request $request)
    {
         $this->validate($request, [
             'title_fa' => 'required|max:191',
             'title_en' => 'required|max:191',
         ]);
        try {
            $item = ProjectFeature::create($request->only('title_fa','title_en', 'status', 'type','tab','filter'));
            return redirect()->route('admin.project-feature.index')->with('flash_message', ' با موفقیت افزوده شد.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $title = ' فیچر';
        $item = ProjectFeature::findOrFail($id);
        return view('admin.setting.real_state.project.feature.edit', compact('item'), ['title' => $title]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_fa' => 'required|max:191',
            'title_en' => 'required|max:191',
        ]);
        $item = ProjectFeature::findOrFail($id);
        try {

            $item->title_fa = $request->title_fa;
            $item->title_en = $request->title_en;
            $item->status = $request->status;
            $item->type = $request->type;
            $item->tab = $request->tab;
            $item->filter = $request->filter;
            $item->update();

            return redirect()->route('admin.project-feature.index')->with('flash_message', ' با موفقیت ویرایش شد.');

        } catch (\Exception $e) {
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