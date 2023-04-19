<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Agent;
use App\Models\SalesOffice;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'country'       => ['required', 'string', 'max:255'],
            'city'          => ['required', 'string', 'max:255'],
            'birth_day'     => ['required', 'string', 'max:255'],
            'type'          => ['required', 'string', 'max:255'],
            'sex'           => ['required', 'string', 'max:255'],
            'country_code'  => ['required', 'ingeter'],
            'mobile'        => ['required', 'ingeter'],
            'username'      => ['required', 'string', 'username', 'max:255', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        $countries      = json_decode(file_get_contents(asset('assets/plugins/countries/countries.json')), true);
        $date_picker    = 'time';
        return view('auth.register', compact('countries','date_picker'));
    }
    
    // protected function create(array $data)
    protected function create(Request $request)
    {
        try {
            $user   = User::create([
                'email'                     => $request->email,
                'first_name'                => $request->first_name,
                'last_name'                 => $request->last_name,
                'country'                   => $request->country,
                'city'                      => $request->city,
                'birth_day'                 => $request->birth_day,
                'type'                      => $request->type,
                'sex'                       => $request->sex,
                'country_code'              => $request->country_code,
                'mobile'                    => $request->mobile,
                'username'                  => $request->username,
                'type'                      => $request->register_type,
                'password'                  => $request->password,
            ]);
    
            if ($request->register_type=='agent') {
                // ثبت ایجنت
                Agent::create([
                    'user_id'               => $user->id,
                    'zone'                  => $request->zone,
                    'aria'                  => $request->aria,
                    'address'               => $request->address,
                    'company_name'          => $request->company_name,
                    'bank_name'             => $request->bank_name,
                    'bank_number'           => $request->bank_number,
                    'passport_number'       => $request->passport_number,
                ]);
                $user->assignRole('agent');
            } elseif($request->register_type=='sales_office') {
                // ثبت دفتر فروش
                SalesOffice::create([
                    'user_id'               => $user->id,
                    'zone'                  => $request->zone,
                    'aria'                  => $request->aria,
                    'address'               => $request->address,
                    'company_name'          => $request->company_name,
                    'company_code_maliati'  => $request->company_code_maliati,
                    'code_melli'            => $request->code_melli,
                    'project_name'          => $request->project_name,
                ]);
                $user->assignRole('sales_office');
            } else {
                $user->assignRole('User');
            }

            auth()->loginUsingId($user->id);
            return redirect()->route('admin.profile.show');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('err_message', 'مشگل در ایجاد کاربر, لطفا فیلدهارو بررسی و دوباره امتحان کنید');
        }
    }
}
