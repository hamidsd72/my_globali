@extends('layouts.admin')
@section('styles')
    <style>
        .app-content
        {
            margin-right: unset!important;
        }
        footer.footer
        {
            padding: unset;
        }
        .app-content
        {
            margin-top: 20px!important;
        }
    </style>
@endsection
@section('content')
<div class="container" dir="{{dir_set()}}">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 mx-auto register">
            <div class="col-12 px-3">
                <div class="row bg-info py-4 py-lg-5 register_multi_type_box">
                    <div class="col-auto">
                        <a href="javascript:void(0);" onclick="signUpMod('one')" class="sign_up_mod one p-1 p-lg-2 px-lg-4 redu50 text-success bg-white">{{read_lang_word('صفحه-ورود','customer')}}</a>
                    </div>
                    <div class="col-auto">
                        <a href="javascript:void(0);" onclick="signUpMod('two')" class="sign_up_mod two p-1 p-lg-2 px-lg-4 redu50 text-white">{{read_lang_word('صفحه-ورود','agent')}}</a>
                    </div>
                    <div class="col col-lg-auto">
                        <a href="javascript:void(0);" onclick="signUpMod('tree')" class="sign_up_mod tree p-1 p-lg-2 px-lg-4 redu50 text-white">{{read_lang_word('صفحه-ورود','sales_office')}}</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>{{read_lang_word('صفحه-ورود','register')}}</h2>
                </div>
                <div class="card-body">
                    <div class="p-4 {{app()->getLocale()=='en'?'text-left':''}}">
    
                        <form method="POST" action="{{ route('front.guest.sign_up','fa') }}" class="row ">
                            @csrf
                            <input id="register_type" type="hidden" name="register_type" value="customer">

                            {{-- first_name --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="first_name" >{{read_lang_word('صفحه-ورود','first_name')}}</label>
                                    <input id="first_name" type="text" class="form-control d-ltr text-left @error('first_name') is-invalid @enderror" name="first_name" required autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- last_name --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="last_name" >{{read_lang_word('صفحه-ورود','last_name')}}</label>
                                    <input id="last_name" type="text" class="form-control d-ltr text-left @error('last_name') is-invalid @enderror" name="last_name" required>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- email --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                <label for="email" >{{read_lang_word('صفحه-ورود','email')}}</label>
                                    <input id="email" type="email" class="form-control d-ltr text-left @error('email') is-invalid @enderror" name="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- username --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="username" >{{read_lang_word('صفحه-ورود','username')}}</label>
                                    <input id="username" type="text" class="form-control d-ltr text-left @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" >
                                    @error('username')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- sex --}}
                            <div class="col-lg-3">
                                <div class="form-group">
                                <label for="sex" >{{read_lang_word('صفحه-ورود','sex')}}</label>
                                    <select name="sex" id="sex" class="form-control ">
                                        <option value="woman">{{read_lang_word('صفحه-ورود','woman')}}</option>
                                        <option value="man">{{read_lang_word('صفحه-ورود','man')}}</option>
                                        <option value="other">{{read_lang_word('صفحه-ورود','other')}}</option>
                                    </select>
                                </div>
                            </div>
                            {{-- birth_day --}}
                            <div class="col-lg-3">
                                <div class="form-group">
                                <label for="birth_day" >{{read_lang_word('صفحه-ورود','birth_day')}}</label>
                                    {{-- @if (app()->getLocale()=='fa')
                                        <input id="birth_day" type="text" class="form-control d-ltr text-left date_p @error('birth_day') is-invalid @enderror" name="birth_day_fa" required>
                                    @else --}}
                                        <input id="birth_day" type="date" class="form-control d-ltr text-left @error('birth_day') is-invalid @enderror" name="birth_day" required>
                                    {{-- @endif --}}
                                    @error('birth_day')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
    
                            {{--  کد کشور نماینده --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="country_code" >{{read_lang_word('صفحه-ورود','country_code')}}</label>
                                    <select name="country_code" id="country_code_select" class="form-control select2-show-search custom-select"></select>
                                </div>
                            </div>
                            {{-- شماره تماس «کانفرمیشن» --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="mobile" >{{read_lang_word('صفحه-ورود','phone')}}</label>
                                    <input id="mobile" type="number" class="form-control d-ltr text-left @error('mobile') is-invalid @enderror" name="mobile" required>
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- آدرس دفتر فروش : «کشور ، شهر ، ناحیه ، منطقه ، محله» --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="country" >{{read_lang_word('صفحه-ورود','country')}}</label>
                                    <select name="country" id="country_select" class="form-control select2-show-search custom-select"></select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                <label for="city" >{{read_lang_word('صفحه-ورود','city')}}</label>
                                    <input id="city" type="text" class="form-control d-ltr text-left @error('city') is-invalid @enderror" name="city" required>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                             
                            <div class="col-12 append_box_one d-none">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="zone" >{{read_lang_word('صفحه-ورود','zone')}}</label>
                                            <input id="zone" type="text" class="form-control d-ltr text-left @error('zone') is-invalid @enderror" name="zone">
                                            @error('zone')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="aria" >{{read_lang_word('صفحه-ورود','aria')}}</label>
                                            <input id="aria" type="text" class="form-control d-ltr text-left @error('aria') is-invalid @enderror" name="aria">
                                            @error('aria')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address" >{{read_lang_word('صفحه-ورود','address')}}</label>
                                            <input id="address" type="text" class="form-control d-ltr text-left @error('address') is-invalid @enderror" name="address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- company_name --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="company_name" >{{read_lang_word('صفحه-ورود','company_name')}}</label>
                                            <input id="company_name" type="text" class="form-control d-ltr text-left @error('company_name') is-invalid @enderror" name="company_name">
                                            @error('company_name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 append_box_two d-none">
                                <div class="row">
                                    {{-- bank_name --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="bank_name" >{{read_lang_word('صفحه-ورود','bank_name')}}</label>
                                            <input id="bank_name" type="text" class="form-control d-ltr text-left @error('bank_name') is-invalid @enderror" name="bank_name">
                                            @error('bank_name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- bank_number --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="bank_number" >{{read_lang_word('صفحه-ورود','bank_number')}}</label>
                                            <input id="bank_number" type="text" class="form-control d-ltr text-left @error('bank_number') is-invalid @enderror" name="bank_number">
                                            @error('bank_number')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- passport_number --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="passport_number" >{{read_lang_word('صفحه-ورود','passport_number')}}</label>
                                            <input id="passport_number" type="text" class="form-control d-ltr text-left @error('passport_number') is-invalid @enderror" name="passport_number">
                                            @error('passport_number')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 append_box_tree d-none">
                                <div class="row">
                                    {{-- company_code_maliati --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="company_code_maliati" >{{read_lang_word('صفحه-ورود','company_code_maliati')}}</label>
                                            <input id="company_code_maliati" type="text" class="form-control d-ltr text-left @error('company_code_maliati') is-invalid @enderror" name="company_code_maliati">
                                            @error('company_code_maliati')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- code_melli --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="code_melli" >{{read_lang_word('صفحه-ورود','code_melli')}}</label>
                                            <input id="code_melli" type="text" class="form-control d-ltr text-left @error('code_melli') is-invalid @enderror" name="code_melli">
                                            @error('code_melli')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- project_name --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="project_name" >{{read_lang_word('صفحه-ورود','project_name')}}</label>
                                            <input id="project_name" type="text" class="form-control d-ltr text-left @error('project_name') is-invalid @enderror" name="project_name">
                                            @error('project_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" >{{read_lang_word('صفحه-ورود','password')}}</label>
                                    <input id="password" type="password" class="form-control d-ltr text-left @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="confirm_password" >{{read_lang_word('صفحه-ورود','confirm_password')}}</label>
                                    <input id="confirm_password" type="password" class="form-control d-ltr text-left @error('confirm_password') is-invalid @enderror" name="confirm_password" required>
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12 pb-3">
                                <label for="agreement">{{read_lang_word('صفحه-ورود','agreement')}}</label>
                                <div class="agreement-subgroup">
                                    <span class="field-option">
                                        <label for="agreement">
                                            <input type="checkbox" title="* Agreement" name="agreement" id="agreement" onclick="agreement_function()">
                                            {{read_lang_word('صفحه-ورود','agreement_text')}}
                                        </label>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-12  mb-0">
                                <div class="{{dir_set()=='ltr'?'text-right':'text-left'}}">
                                    <button type="submit" class="btn btn-block btn-info py-3 register_active_btn" disabled>{{read_lang_word('صفحه-ورود','register')}}</button>
                                    <button type="submit" class="btn btn-block btn-info py-3 register_diactive_btn mt-0">{{read_lang_word('صفحه-ورود','register')}}</button>
                                </div>
                                <div class="text-center pt-4"><a href="{{route('login')}}">{{read_lang_word('صفحه-ورود','titr')}}</a></div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
