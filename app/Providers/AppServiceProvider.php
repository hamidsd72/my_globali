<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\ApiCurl;
use App\Models\Meta;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\About;
use App\Models\SiteWord;
use App\Models\CarRentList;
use App\Models\Car;
use App\Models\CarMessage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->url = $request->fullUrl();
        Schema::defaultStringLength(191);
        view()->composer('layouts.admin', function ($view) {
            $setting=Setting::first();

            $view
                 ->with('setting', $setting);
        });
         view()->composer('layouts.front', function ($view) {

             $sett=Setting::first();
             $seo = Meta::where('link', $this->url)->first();
             if (is_null($seo)) {
                 $seo = Meta::where('link', $this->url . '/')->first();
                 if (is_null($seo)) {
                     $seo = Meta::where('link', explode('?', $this->url)[0])->first();
                     if (is_null($seo)) {
                         $seo = Meta::where('link', explode('?', $this->url)[0] . '/')->first();
                     }
                 }
             }
             if (!is_null($seo)) {
                    $seo_set=false;
                   if(status_check($seo))
                    {
                       $seo_set=true;
                    }
                    if($seo_set)
                 {
                     $titleSeo = read_lang($seo,'title_page');
                     $keywordsSeo = read_lang($seo,'keyword');
                     $descriptionSeo = read_lang($seo,'description');
                 }
             }
             else {
                 $titleSeo =read_lang($sett,'title');
                 $keywordsSeo = read_lang($sett,'keywords');
                 $descriptionSeo = read_lang($sett,'description');
             }
             $view
                 ->with('urlPage', $this->url)
                 ->with('fav_icon', $sett->icon && is_file($sett->icon->path)?url($sett->icon->path):url('assets/front/img/favicon.png'))
                 ->with('logo', $sett->logo && is_file($sett->logo->path)?url($sett->logo->path):url('assets/front/img/logo.png'))
                 ->with('contact_info', Contact::first())
                 ->with('about_footer', About::where('type','footer')->first())
                 ->with('word_header', SiteWord::where('place_out','هدر')->get())
                 ->with('word_footer', SiteWord::where('place_out','فوتر')->get())
                 ->with('titleSeo', $titleSeo)
                 ->with('keywordsSeo', $keywordsSeo)
                 ->with('descriptionSeo', $descriptionSeo);
         });
        view()->composer('layouts.admin', function ($view) {
            if(Auth::check())
            {
                $car_rental_all=CarRentList::where('seen','no');
             if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                        $car_rental_all=$car_rental_all->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_all=$car_rental_all->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_all=$car_rental_all->whereIN('car_system_id',$car_id);
                    }
            $car_rental_all=$car_rental_all->count();
            
             $car_rental_no=CarRentList::where('status','active')->where('car_type','company')->where('status_reserve','no')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $car_rental_no=$car_rental_no->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_no=$car_rental_no->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_no=$car_rental_no->whereIN('car_system_id',$car_id);
                    }
            $car_rental_no=$car_rental_no->count();
            
              $car_rental_yes=CarRentList::where('status','active')->where('car_type','company')->where('status_reserve','yes')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $car_rental_yes=$car_rental_yes->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_yes=$car_rental_yes->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_yes=$car_rental_yes->whereIN('car_system_id',$car_id);
                    }
            $car_rental_yes=$car_rental_yes->count();
            
             $car_rental_pending=CarRentList::whereIN('status',['pending','blocked'])->where('car_type','company')->where('status_record','site')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $car_rental_pending=$car_rental_pending->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_pending=$car_rental_pending->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_pending=$car_rental_pending->whereIN('car_system_id',$car_id);
                    }
            $car_rental_pending=$car_rental_pending->count();
            
             $car_rental_api=CarRentList::where('status_record','api')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $car_rental_api=$car_rental_api->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_api=$car_rental_api->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_api=$car_rental_api->whereIN('car_system_id',$car_id);
                    }
            $car_rental_api=$car_rental_api->count();
            
               $car_rental_col=CarRentList::where('car_type','colleague')->where('seen','no');
             if(Auth::user()->hasRole('User'))
                    {
                        $car_rental_col=$car_rental_col->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $car_rental_col=$car_rental_col->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $car_rental_col=$car_rental_col->whereIN('car_system_id',$car_id);
                    }
            $car_rental_col=$car_rental_col->count();
            
            $view
                ->with('car_rental_all', $car_rental_all)
                ->with('car_rental_no', $car_rental_no)
                ->with('car_rental_yes', $car_rental_yes)
                ->with('car_rental_pending', $car_rental_pending)
                ->with('car_rental_api', $car_rental_api)
                ->with('car_rental_col', $car_rental_col)
                ->with('car_message', CarMessage::where('seen','no')->count())
                ->with('contact_form', ContactForm::where('seen','no')->count());
            }
            
        });
    }


}
