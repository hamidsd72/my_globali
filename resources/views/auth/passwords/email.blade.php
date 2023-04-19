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
        <div class="col-xl-7 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header"><h2>{{read_lang_word('صفحه-ورود','ResetPassword')}}</h2></div>
                <div class="card-body">
                    <div class="p-4 {{app()->getLocale()=='en'?'text-left':''}}">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-lg-4 col-form-label text-lg-right">{{read_lang_word('صفحه-ورود','email')}}</label>
                                <div class="col-lg-6">
                                    <input id="email" type="email" class="form-control d-ltr text-left @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-block btn-info py-3 col-12">{{read_lang_word('صفحه-ورود','SendPasswordResetLink')}}</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
