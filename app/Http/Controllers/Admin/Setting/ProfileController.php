<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\User;
use App\Models\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile_list', ['only' => ['index','show']]);
        $this->middleware('permission:profile_edit', ['only' => ['edit','update']]);
    }
    public function show()
    {
        $item=User::findOrFail(Auth::user()->id);
        return view('admin.setting.profile.show', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $this->validate($request, [
//            'username' => 'required|min:4|max:20',
            'password' => 'nullable|min:6|confirmed',
             'photo' => "nullable|image|mimes:jpeg,jpg,png|max:2048",
        ]);
        try {
//            $item->username = $request->input('username');
            if ($request->input('password') != null and $request->input('password') != '') {
                $item->password = $request->input('password');
            }
            $item->update();

            //edit User photo
            if ($request->hasFile('photo')) {
                if($item->photo)
                {
                    if(is_file($item->photo->path))
                    {
                        File::delete($item->photo->path);
                    }
                    $item->photo->delete();
                }
                $photo = new Photo();
                $photo->type = 'photo';
                $photo->path = file_store($request->photo, 'assets/uploads/user/profile/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/photos/', 'photo-');
                $item->photo()->save($photo);
            }

            return redirect()->back()->with('flash_message', 'اطلاعات با موفقیت ویرایش شد');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', 'برای ویرایش به مشکل خوردیم، مجدد تلاش کنید');
        }
    }


}
