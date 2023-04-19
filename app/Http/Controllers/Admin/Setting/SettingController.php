<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use App\Models\Photo;
use App\Http\Requests\Setting\SettingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Spatie\Permission\Models\Permission;

class SettingController extends Controller
{
    public function controller_title($type)
    {
        switch ($type) {
            case 'index':
                return 'تنظیمات سایت';
                break;
            case 'create':
                return 'افزودن  ندارد';
                break;
            case 'edit':
                return 'ویرایش تنظیمات سایت';
                break;
            case 'url_back':
                return route('admin.setting.index');
                break;
            default:
                return '';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('permission:setting_list', ['only' => ['index', 'show']]);
        $this->middleware('permission:setting_edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $items = Setting::orderBy('id')->get();
        return view('admin.setting.site.index', compact('items'), ['title' => $this->controller_title('index')]);
    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function store(SettingRequest $request)
    {

    }

    public function edit($id)
    {
        $url_back = $this->controller_title('url_back');
        $item = Setting::findOrFail($id);
        return view('admin.setting.site.edit', compact('url_back', 'item'), ['title' => $this->controller_title('edit')]);
    }

    public function update(SettingRequest $request, $id)
    {
        $item = Setting::findOrFail($id);
        try {
            Setting::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'username' => $request->username,
                'accesskey' => $request->accesskey,
            ]);
            //edit logo
            if ($request->hasFile('logo')) {
                if ($item->logo) {
                    if (is_file($item->logo->path)) {
                        File::delete($item->logo->path);
                    }
                    $item->logo->delete();
                }
                $photo = new Photo();
                $photo->type = 'logo';
                $photo->path = file_store($request->logo, 'assets/uploads/setting/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'logo-');
                $item->logo()->save($photo);
            }
            //edit icon
            if ($request->hasFile('icon')) {
                if ($item->icon) {
                    if (is_file($item->icon->path)) {
                        File::delete($item->icon->path);
                    }
                    $item->icon->delete();
                }
                $photo = new Photo();
                $photo->type = 'icon';
                $photo->path = file_store($request->icon, 'assets/uploads/setting/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'icon-');
                $item->icon()->save($photo);
            }

            store_lang($item, $request, ['title', 'description', 'keywords'], 'edit');

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

    public function percent(Request $request, $id)
    {
        $item = Setting::findOrFail($id);
        try {
            if ($request->percent > 100 || $request->percent < 0 || blank($request->percent)) {
                return redirect()->back()->withInput()->with('err_message', 'عدد  درصد را صحیح وارد کنید');
            }
            if ($request->percent_bimeh > 100 || $request->percent_bimeh < 0 || blank($request->percent_bimeh)) {
                return redirect()->back()->withInput()->with('err_message', 'عدد  درصد بیمه را صحیح وارد کنید');
            }
            if ($request->prepayment > 100 || $request->prepayment < 0 || blank($request->prepayment)) {
                return redirect()->back()->withInput()->with('err_message', 'عدد  درصد پیش پرداخت را صحیح وارد کنید');
            }
            if (blank($request->rial)) {
                return redirect()->back()->withInput()->with('err_message', 'عدد  مبلغ لیر به تومان را وارد کنید');
            }
            if (blank($request->delivery_car)) {
                return redirect()->back()->withInput()->with('err_message', 'عدد  مبلغ تحویل خودرو خارج از شرکت را به لیر وارد کنید');
            }
            Setting::where('id', $id)->update([
                'percent' => $request->percent,
                'percent_bimeh' => $request->percent_bimeh,
                'prepayment' => $request->prepayment,
                'rial' => $request->rial,
                'delivery_car' => $request->delivery_car,
                'email' => $request->email,
            ]);

            return redirect($this->controller_title('url_back'))->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

    public function delete_pic($id)
    {
        $item = Photo::findOrFail($id);
        try {
            if (is_file($item->path)) {
                File::delete($item->path);
            }
            $item->delete();
            return redirect()->back()->with('flash_message', 'اطلاعات با موفقیت حذف شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای حذف به مشکل خوردیم، مجدد تلاش کنید');
        }
    }

    public function destroy()
    {

    }
}
