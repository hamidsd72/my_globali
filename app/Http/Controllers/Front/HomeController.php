<?php

namespace App\Http\Controllers\Front;

use App\Models\ApiCurl;
use App\Models\Car;
use App\Models\CarCat;
use App\Models\CarJoin;
use App\Models\CarSlider;
use App\Models\CarReserve;
use App\Models\CarRentList;
use App\Models\User;
use App\Models\Contact;
use App\Models\CountryCode;
use App\Models\ContactForm;
use App\Models\CarOption;
use App\Models\CarRentOptionList;
use App\Models\About;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\GalleryCategory;
use App\Models\CarSeen;
use App\Models\UserComplete;
use App\Models\CarMessage;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Mail\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index($lang)
    {
        $sliders = CarSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
        $projects = Project::take(6)->get();

        return view('front.index', compact('sliders', 'about', 'contact_home', 'blogs', 'services', 'gallery','projects'), ['title' => 'index']);
    }
    public function landingfa()
    {
        $sliders = CarSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
        session()->put('locale', "FA");
        return view('front.landing.fa', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
public function landingar()
    {
        $sliders = CarSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "AR");
        return view('front.landing.ar', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
    public function landingru()
    {
        $sliders = CarSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "RU");
        return view('front.landing.ru', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
    public function landingen()
    {
        $sliders = CarSlider::orderBy('sort')->get();
        $sliders = $sliders->filter(function ($slider) {
            if (status_check($slider)) {
                return $slider;
            }
        });
        $about = About::where('type', 'home')->first();
        $contact_home = Contact::first();
        $services = Service::take(10)->get();
        $services = $services->filter(function ($service) {
            if (status_check($service)) {
                return $service;
            }
        });
        $blogs = Blog::orderByDesc('id')->take(10)->get();
        $blogs = $blogs->filter(function ($blog) {
            if (status_check($blog)) {
                return $blog;
            }
        });
        $gallery = GalleryCategory::where('status_home', 'active')->orderBy('sort')->take(6)->get();
        $gallery = $gallery->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
                session()->put('locale', "EN");

        return view('front.landing.en', compact( 'about', 'contact_home', 'blogs', 'services', 'gallery'), ['title' => 'index']);
    }
    public function about($lang)
    {
        $item = About::where('type', 'about')->first();
        $blogs = Blog::orderByDesc('id')->take(4)->get();
        return view('front.about', compact('item','blogs'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'about')]);
    }

    public function faq($lang)
    {
        $items = Faq::orderByDesc('id')->paginate(10);
        
        return view('front.faq', compact('items'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'faq')]);
    }

    public function contact($lang)
    {
        $item = Contact::first();
        return view('front.contact', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'contact')]);
    }

    public function contact_post($lang,Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'subject' => 'required|max:250',
            'message' => 'required',
            'captcha' => 'required',
        ]);
        if($request->captcha!=session('captcha_code'))
        {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_captcha'));
        }
        try {
            $item = ContactForm::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            return redirect()->back()->with('flash_message', read_lang_word('پیام', 'success_form'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }

    public function service_list($lang)
    {
        $items = Service::orderByDesc('id')->get();
        $items = $items->filter(function ($item) {
            if (status_check($item)) {
                return $item;
            }
        });
        return view('front.service.index', compact('items'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'service')]);
    }

    public function blog_list($lang,$type = 'all')
    {
        $items = Blog::orderByDesc('id');
        if ($type != 'all')
            $items = $items->where('type', $type);
        $items = $items->get();

        $items = $items->filter(function ($item) {
            if (status_check($item)) {
                return $item;
            }
        });

        $title = $title = read_lang_word('هدر-صفحات-داخلی', 'blog');
        if ($type == 'news')
            $title = read_lang_word('هدر-صفحات-داخلی', 'news');
        elseif ($type == 'article')
            $title = read_lang_word('هدر-صفحات-داخلی', 'article');

        return view('front.blog.index', compact('items'), ['title' => $title]);
    }

    public function blog_show($lang,$type, $id)
    {
        $item = Blog::where('type', $type)->where('id', $id)->firstOrFail();
        if (!status_check($item)) {
            abort(404);
        }
        $item->seen += 1;
        $item->update();
        $items_last = Blog::orderByDesc('id')->where('id', '!=', $id)->take(10)->get();
        $items_last = $items_last->filter(function ($item_last) {
            if (status_check($item_last)) {
                return $item_last;
            }
        });
        $items_seen = Blog::orderByDesc('seen')->where('id', '!=', $id)->take(10)->get();
        $items_seen = $items_seen->filter(function ($item_seen) {
            if (status_check($item_seen)) {
                return $item_seen;
            }
        });
        return view('front.blog.show', compact('item', 'items_last', 'items_seen'), ['title' => read_lang($item, 'title')]);
    }

    public function gallery($lang)
    {
        $items = GalleryCategory::orderBy('sort')->get();
        $items = $items->filter(function ($gall) {
            if (status_check($gall)) {
                return $gall;
            }
        });
        return view('front.gallery.index', compact('items'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'gallery')]);
    }


    public function filter_car($lang,Request $request)
    {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $place = blank($request->location) ? 'no_select' : $request->location;
            if ($from_date > $to_date) {
                return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e_d'));
            }

            $cars = Car::where('type', 'company')->where('status', 'آماده تحویل')->doesntHave('reserves')
                ->orWhere('type', 'company')->where('status', 'آماده تحویل')->whereHas('reserves', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'فعال')->whereDate('reserve_start_date', '>', $to_date)->whereDate('reserve_end_date', '<', $from_date);
                })->orWhere('type', 'company')->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->get();

            $cars_col = Car::where('type', 'colleague')->where('status', 'آماده تحویل')->doesntHave('rents')
                ->orWhere('type', 'colleague')->where('status', 'آماده تحویل')->whereHas('rents', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'active')->whereDate('from_date', '>', $to_date)->whereDate('to_date', '<', $from_date);
                })->orWhere('type', 'colleague')->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->get();

            $cars = $cars->merge($cars_col);

            $cars_id = Car::where('type', 'company')->where('status', 'آماده تحویل')->doesntHave('reserves')
                ->orWhere('type', 'company')->where('status', 'آماده تحویل')->whereHas('reserves', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'فعال')->whereDate('reserve_start_date', '>', $to_date)->whereDate('reserve_end_date', '<', $from_date);
                })->orWhere('type', 'company')->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->select('id')->get()->toArray();

            $cars_col_id = Car::where('type', 'colleague')->where('status', 'آماده تحویل')->doesntHave('rents')
                ->orWhere('type', 'colleague')->where('status', 'آماده تحویل')->whereHas('rents', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'active')->whereDate('from_date', '>', $to_date)->whereDate('to_date', '<', $from_date);
                })->orWhere('type', 'colleague')->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->select('id')->get()->toArray();

            $cars2 = Car::where('type', 'company')->whereIN('status', ['آماده تحویل', 'در حال اجاره'])->whereNotIN('id', $cars_id)->get();


            $cars2_col = Car::where('type', 'colleague')->whereIN('status', ['آماده تحویل', 'در حال اجاره'])->whereNotIN('id', $cars_col_id)->get();

            //  $cars2=$cars2->merge($cars2_col); 

            $whatsapp_car = Contact::first()->whatsapp_car;

            CarSeen::create([
                'type' => 'list',
                'ip' => ip_address(),
                'country' => country_ip(),
                'car_id' => 0,
            ]);
            return view('front.car.index', compact('cars', 'cars2', 'whatsapp_car', 'from_date', 'to_date', 'place'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'car_list')]);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e'));
        }
    }

    public function reserve_car($lang,$car_id,$set=null,Request $request)
    {
        try {
            $sett = Setting::first();
            if(isset($request->phone) && blank($set))
            {
                session(['request_phone' => $request->phone]);
            }
            $car = Car::findOrFail($car_id);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $place = blank($request->location) ? 'no_select' : $request->location;
            $reserve_crm=null;
            if ($from_date > $to_date) {
                if(blank($set))
                    return ['status'=>0,'message'=>read_lang_word('پیام', 'err_e_d')];
                else
                    return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e_d'));
            }
            if ($car->type == 'company') {
                $item = Car::where('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('reserves')
                    ->orWhere('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('reserves', function ($r) use ($to_date, $from_date) {
                        $r->where('status', 'فعال')->whereDate('reserve_start_date', '>', $to_date)->whereDate('reserve_end_date', '<', $from_date);
                    })->orWhere('type', 'company')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();
            }
            elseif ($car->type == 'colleague') {
                $reserve_crm = 'yes';

                $item = Car::where('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('rents')
                    ->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('rents', function ($r) use ($to_date, $from_date) {
                        $r->where('status', 'active')->whereDate('from_date', '>', $to_date)->whereDate('to_date', '<', $from_date);
                    })->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();
            }
            if(!$item)
            {
                if(blank($set))
                {
                    if (session()->has('request_phone')) {
                        if ($sett && !blank($sett->email)) {
                            $text = '<p>';
                            $text .= 'شخصی با شماره تماس: ';
                            $text .= '<strong>';
                            $text .= session('request_phone');
                            $text .= '</strong>';
                            $text .= ' در بازه تاریخی از: ';
                            $text .= '<strong dir="ltr">';
                            $text .= $from_date;
                            $text .= '</strong>';
                            $text .= ' تا: ';
                            $text .= '<strong dir="ltr">';
                            $text .= $to_date;
                            $text .= '</strong>';
                            $text .= ' قصد اجاره خودروی: ';
                            $text .= '<strong  dir="ltr">';
                            $text .= $car->brand;
                            $text .= ' ';
                            $text .= $car->model;
                            $text .= ' ';
                            $text .= $car->year;
                            $text .= ' ';
                            $text .= $car->color;
                            $text .= '</strong>';
                            $text .= ' با پلاک: ';
                            $text .= '<strong  dir="ltr">';
                            $text .= $car->pelak;
                            $text .= '</strong>';
                            $text .= ' داشتند که متاسفانه این خودرو به علت ';
                            if($car->status!='در حال اجاره' && $car->status!='آماده تحویل')
                            {
                                $text .= '<strong>';
                                $text .= ' رزرو قبلی ';
                                $text .= '</strong>';
                            }
                            else
                            {
                                $text .= '<strong>';
                                $text .= ' وضعیت ';
                                $text .= $car->status;
                                $text .= '</strong>';
                            }
                            $text .= ' در دسترس مشتری نبود';
                            $text .= '</p>';
                            $mail_data = [
                                'subject' => 'سعی در اجاره خودرو',
                                'title' => 'سعی در اجاره خودرو و نبود خودرو',
                                'body' => $text,
                            ];

                            \Mail::to($sett->email)->send(new Mail($mail_data));
                        }
                    }
                    return ['status'=>0,'message'=>read_lang_word('پیام', 'not_car2')];
                }
                else
                    return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'not_car'));
            }
            if(blank($set))
                return ['status'=>1,'message'=>read_lang_word('پیام', 'ok_car'),'url'=>route('front.rent.car.level.1',[app()->getLocale(),$car_id,$from_date,$to_date,$place,$reserve_crm])];
            else
                return redirect()->route('front.rent.car.level.1',[app()->getLocale(),$car_id,$from_date,$to_date,$place,$reserve_crm]);
        } catch (\Exception $e) {
            return ['status'=>0,'message'=>read_lang_word('پیام', 'err_e')];
        }
    }

    public function filter_car_id($lang,Request $request,$slug)
    {
        try {
            $cat=CarCat::where('slug',$slug)->firstOrFail();
            if (!status_check($cat)) {
                abort(404);
            }
            $car_cats=CarCat::where('id','!=',$cat->id)->whereHas('photo')->get();
            $car_cats = $car_cats->filter(function ($cat) {
                if (status_check($cat)) {
                    return $cat;
                }
            });
            $car_joins=CarJoin::where('cat_id',$cat->id)->select('car_id')->get()->toArray();
            $cars=Car::whereIN('id',$car_joins)->get();
            if (count($cars) <= 0) {
                return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e'));
            }

            $whatsapp_car = Contact::first()->whatsapp_car;

            CarSeen::create([
                'type' => 'list_cat',
                'title_cat' => $cat->title,
                'ip' => ip_address(),
                'country' => country_ip(),
                'car_id' => 0,
            ]);

            $title=read_lang($cat,'title');
            return view('front.car.index_2', compact('cars','car_cats', 'whatsapp_car'), ['title' => $title]);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_e'));
        }
    }

    public function rent_car_level1($lang,$car_id, $from_date, $to_date, $place, $reserve_crm = null, Request $request)
    {
        $car = Car::findOrFail($car_id);
        if ($car->type == 'company') {
            $item = Car::where('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('reserves')
                ->orWhere('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('reserves', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'فعال')->whereDate('reserve_start_date', '>', $to_date)->whereDate('reserve_end_date', '<', $from_date);
                })->orWhere('type', 'company')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();


//            if (!$item) {
//                $item = Car::where('type', 'company')->where('id', $car_id)->whereIN('status', ['در حال اجاره', 'آماده تحویل'])->firstOrFail();
//                $reserve_crm = 'yes';
//            }
        }
        elseif ($car->type == 'colleague') {
            $reserve_crm = 'yes';

            $item = Car::where('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('rents')
                ->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('rents', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'active')->whereDate('from_date', '>', $to_date)->whereDate('to_date', '<', $from_date);
                })->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();
            //  if(!$item)
            // {
            //     $item = Car::where('type','colleague')->where('id', $car_id)->whereIN('status',['در حال اجاره','آماده تحویل'])->firstOrFail();
            //
            // };
        }
        if(!$item)
        {
            return redirect()->route('front.filter.car',[app()->getLocale(),'location'=>$place,'from_date'=>$from_date,'to_date'=>$to_date])->with('err_message', read_lang_word('پیام', 'not_car'));
        }
        $options = CarOption::all();
        $options = $options->filter(function ($option) {
            if (status_check($option)) {
                return $option;
            }
        });

        $setting = Setting::first();
        $prepayment = 0;
        $off_p = 0;
        $toman = 2000;
        if ($setting) {
            $prepayment = $setting->prepayment;
            $off_p = $setting->percent;
            $toman = $setting->rial;
        }
        CarSeen::create([
            'type' => 'price',
            'ip' => ip_address(),
            'country' => country_ip(),
            'car_id' => $car_id,
        ]);
      
        $codes=CountryCode::orderBy('id')->get();

        return view('front.car.rent_level.level1', compact('item', 'from_date','codes', 'to_date', 'place', 'options', 'reserve_crm', 'toman', 'off_p', 'prepayment'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'car_rental') .' '. $item->brand]);
    }
    public function rent_car_level1_show($lang,$car_id, Request $request)
    {
        $item = Car::findOrFail($car_id);
        $car_cats=CarCat::whereHas('photo')->get();
        $car_cats = $car_cats->filter(function ($cat) {
            if (status_check($cat)) {
                return $cat;
            }
        });
        return view('front.car.show', compact('item','car_cats'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'car_rental') . $item->brand]);
    }

    public function car_post($lang,$id, Request $request)
    {
        $car = Car::findOrFail($id);
        $sett = Setting::first();
        $this->validate($request, [
            'name' => 'required|max:200',
            'phone' => 'required|numeric',
            'email' => 'nullable|email',
            'captcha' => 'required',
        ]);
        if($request->captcha!=session('captcha_code'))
        {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_captcha'));
        }
        try {
            $item = CarMessage::create([
                'car_id' => $car->car_id,
                'car_system_id' => $car->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'lang' => app()->getLocale(),
            ]);

            if ($sett && !blank($sett->email)) {
                $url = route('front.rent.car.level.1.show', [app()->getLocale(),$car->id]);

                $text = '<p>';
                $text .= 'نام: ';
                $text .= '<strong>';
                $text .= $item->name;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'خودرو: ';
                $text .= '<a href="' . $url . '" target="_blank">';
                $text .= '<strong dir="ltr">';
                $text .= $item->car ? $item->car->brand . ' ' . $item->car->model . ' ' . $item->car->year . ' ' . $item->car->color : '__';
                $text .= '</strong>';
                $text .= '</a>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'شماره تماس: ';
                $text .= '<strong dir="ltr">';
                $text .= '<a href="tel:'.$item->phone.'">'.$item->phone.'</a>';
                $text .= '</strong>';
                $text .= '</p>';
                $text .= '<p>';
                $text .= 'ایمیل: ';
                $text .= '<strong dir="ltr">';
                $text .= $item->email;
                $text .= '</strong>';
                $text .= '</p>';
                $text .= 'تاریخ ثبت: ';
                $text .= '<strong dir="ltr">';
                $text .= $item->created_at;
                $text .= '</strong>';
                $text .= '</p>';
                $mail_data = [
                    'subject' => 'فرم درخواست اجاره خودرو',
                    'title' => 'ارسال فرم درخواست کرایه خودرو جدید',
                    'body' => $text,
                ];

                \Mail::to($sett->email)->send(new Mail($mail_data));
            }

            return redirect()->back()->with('flash_message', read_lang_word('پیام', 'success_form1'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }

    public function rent_car_level1_post($lang,$car_id, $from_date, $to_date, $place, $reserve_crm = 'no', Request $request)
    {
        $place = $place == 'no_select' ? null : $place;

        $car = Car::findOrFail($car_id);
        if ($car->type == 'company') {
            $item = Car::where('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('reserves')
                ->orWhere('type', 'company')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('reserves', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'فعال')->whereDate('reserve_start_date', '>', $to_date)->whereDate('reserve_end_date', '<', $from_date);
                })->orWhere('type', 'company')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();

//            if (!$item) {
//                $item = Car::where('type', 'company')->where('id', $car_id)->whereIN('status', ['در حال اجاره', 'آماده تحویل'])->firstOrFail();
//                $reserve_crm = 'yes';
//            }
        } elseif ($car->type == 'colleague') {
            $reserve_crm = 'yes';

            $item = Car::where('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->doesntHave('rents')
                ->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'آماده تحویل')->whereHas('rents', function ($r) use ($to_date, $from_date) {
                    $r->where('status', 'active')->whereDate('from_date', '>', $to_date)->whereDate('to_date', '<', $from_date);
                })->orWhere('type', 'colleague')->where('id', $car_id)->where('status', 'در حال اجاره')->whereDate('return_date', '<', $from_date)->first();
            //  if(!$item)
            // {
            //     $item = Car::where('type','colleague')->where('id', $car_id)->whereIN('status',['در حال اجاره','آماده تحویل'])->firstOrFail();
            //     $reserve_crm='yes';
            // };
        }
        if(!$item)
        {
            return redirect()->route('front.filter.car',[app()->getLocale(),'location'=>$place,'from_date'=>$from_date,'to_date'=>$to_date])->back()->with('err_message', read_lang_word('پیام', 'not_car'));
        }
        $admin_pay='empty';
        $admin_pay_type='empty';
        $admin_pay_file=null;
        if(auth()->check() && auth()->user()->can('car_rent_payNot'))
        {
            if(isset($request->admin_pay))
            {
                $admin_pay=$request->admin_pay;
            }
            if($admin_pay=='yes')
            {
                $admin_pay_type=$request->admin_pay_type;
            }
            if($admin_pay_type=='remove')
            {
                if ($request->hasFile('admin_pay_file')) {
                    $admin_pay_file = file_store($request->admin_pay_file, 'assets/uploads/front/car_rental/' . my_jdate(date('Y/m/d'), 'Y-m-d') . '/', 'file-');
                }
            }
        }
        try {
            $rent = new CarRentList();
            $rent->car_id = $item->car_id;
            $rent->car_system_id = $item->id;
            $rent->first_name = $request->first_name;
            $rent->last_name = $request->last_name;
            $rent->full_name = $request->first_name . ' ' . $request->last_name;
            $rent->phone = $request->country_code.''.$request->phone;
            $rent->email = $request->email;
            $rent->from_date = $from_date;
            $rent->to_date = $to_date;
            $rent->price_rent = nerkh_set($item->id, $from_date, $to_date)['all_not_d_off'];
            $rent->price_depozit = nerkh_set($item->id, $from_date, $to_date)['depozit'];
            if (nerkh_set($item->id, $from_date, $to_date)['day_p_sub_off'] > 0 && nerkh_set($item->id, $from_date, $to_date)['day_p_not_off'] > nerkh_set($item->id, $from_date, $to_date)['day_p_sub_off']) {
                $rent->off_percent = percent_set(nerkh_set($item->id, $from_date, $to_date)['day'])[1];
                $rent->off_price = (int)nerkh_set($item->id, $from_date, $to_date)['all_not_d_off'] - (int)nerkh_set($item->id, $from_date, $to_date)['all_not_d'];
            }
            $rent->price_bimeh = isset($request->bimeh_check)?nerkh_set($item->id, $from_date, $to_date)['bime_price']:0;
            $rent->price_delivery = nerkh_set($item->id, $from_date, $to_date, $place)['delivery_price'];
            $rent->price_all = isset($request->bimeh_check)?nerkh_set($item->id, $from_date, $to_date, $place)['all']:nerkh_set($item->id, $from_date, $to_date, $place)['all_not_bimeh'];
            $rent->place_delivery = $place;
            $rent->status = auth()->check() && auth()->user()->can('car_rent_payNot')?'active':'pending';
            $rent->admin_reserve = auth()->check() && auth()->user()->can('car_rent_payNot')?'yes':'no';
            $rent->admin_pay = $admin_pay;
            $rent->admin_pay_type = $admin_pay_type;
            $rent->admin_pay_file = $admin_pay_file;
            $rent->status_reserve = $reserve_crm;
            $rent->payment_type = 'online';
            $rent->prepayment = isset($request->prepayment) ? 'active' : 'pending';
            $rent->prepayment_percent = nerkh_set($item->id, $from_date, $to_date, $place)['prepayment_percent'];
            $rent->prepayment_price = isset($request->bimeh_check)?nerkh_set($item->id,$from_date,$to_date,$place)['prepayment_price_off']:nerkh_set($item->id,$from_date,$to_date,$place)['prepayment_price_off_not_bimeh'];
            $rent->pay_type = $request->pay_type ?? 'paynkolay';
            $rent->car_type = $item->type;
            $rent->save();

            $rent->rent_code = uniqid($rent->id . '_');
            $rent->save();

            if (auth()->check()) {
                $user = auth()->user();
            } else {
                $user = User::where('username', $rent->phone)->first();
                if (!$user) {
                    $user = new User();
                    $user->name = $rent->full_name;
                    $user->username = $rent->phone;
                    $user->password = 123456;
                    $user->save();

                    $user->assignRole('User');
                }
            }

            $rent->customer_system_id = $user->id;
            $rent->customer_id = $user->customer_id;
            $rent->save();
//option add
            $price_option = 0;
            if ($request->option_check && count($request->option_check)) {
                foreach ($request->option_check as $option) {
                    $car_option = CarOption::find($option);
                    if ($car_option) {
                        $opt_new = new CarRentOptionList();
                        $opt_new->option_id = $car_option->id;
                        $opt_new->rental_id = $rent->id;
                        $opt_new->user_id = $rent->customer_system_id;
                        $opt_new->user_id = $rent->customer_system_id;
                        if ($car_option->type == 'one') {
                            $opt_new->price = $car_option->price;
                            $opt_new->num = 1;
                        } else {
                            $num = 'option_num_' . $car_option->id;
                            $opt_new->num = $request->$num;
                            $opt_new->price = $car_option->price * $request->$num;
                        }
                        $opt_new->save();

                        $price_option += $opt_new->price;
                    }
                }
            }
            if ($price_option > 0) {
                $all_pp = $rent->price_all + $price_option;
                $rent->price_all = $all_pp;
                $rent->price_option = $price_option;
                $rent->prepayment_price = (int)$rent->prepayment_percent > 0 ? round($all_pp * nerkh_set($item->id, $from_date, $to_date, $place)['prepayment_percent'] / 100) : 0;
                $rent->save();
            }
            if(auth()->check() && auth()->user()->can('car_rent_payNot'))
            {
                return redirect()->route('front.information.complete.get',[app()->getLocale(),$rent->rent_code])->with('flash_message', read_lang_word('پیام','success_record'));
            }
            if ($request->pay_type && $request->pay_type == 'zarinpal') {
                return redirect()->route('front.zarin_pall.pay', [app()->getLocale(),$rent->id]);
            }

            return redirect()->route('front.payment.send', [app()->getLocale(),$rent->id]);
        } catch (\Exception $e) {
            return redirect()->back()->with('err_message', read_lang_word('پیام', 'err_e'));
        }
    }


    public function rental_conditions($lang)
    {
        $item = About::where('type', 'conditions')->first();
        return view('front.conditions', compact('item'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'conditions')]);
    }

    public function information_get($lang,$id)
    {
        $item = CarRentList::where('rent_code', $id)->firstOrFail();
        $car = $item->car;
        if (!$car) {
            abort(404);
        }
        return view('front.info_get', compact('item', 'car', 'id'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'information')]);
    }

    public function information_post($lang,Request $request, $id)
    {
        $item = CarRentList::where('rent_code', $id)->firstOrFail();
        $this->validate($request, [
            'f_name' => 'required|max:191',
            'l_name' => 'required|max:191',
            'birth_date' => 'required',
            'birth_place' => 'required|max:191',
            'father_name' => 'required|max:191',
            'mother_name' => 'required|max:191',
            'passport_number' => 'required',
            'passport_start_date' => 'required',
            'passport_end_date' => 'required',
            'certificate_number' => 'required',
            'certificate_start_date' => 'required',
            'certificate_end_date' => 'required',
            'address' => 'required|max:300',
            'phone1' => 'required|max:20',
            'phone2' => 'required|max:20',
        ]);

        try {
            $user = $item->user;
            if (!$user) {
                $user = new User();
                $user->name = $item->full_name;
                $user->username = $item->phone;
                $user->password = 123456;
                $user->save();

                $user->assignRole('User');

                $item->customer_system_id = $user->id;
                $item->update();
            }

            $info = UserComplete::create([
                'user_id' => $user->id,
                'reserve_id' => $item->id,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'full_name' => $request->f_name . ' ' . $request->l_name,
                'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d'),
                'birth_place' => $request->birth_place,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'passport_number' => $request->passport_number,
                'passport_start_date' => Carbon::parse($request->passport_start_date)->format('Y-m-d'),
                'passport_end_date' => Carbon::parse($request->passport_end_date)->format('Y-m-d'),
                'kimilik_number' => $request->kimilik_number,
                'kimilik_serial' => $request->kimilik_serial,
                'kimilik_start_date' => blank($request->kimilik_start_date) ? null : Carbon::parse($request->kimilik_start_date)->format('Y-m-d'),
                'kimilik_end_date' => blank($request->kimilik_end_date) ? null : Carbon::parse($request->kimilik_end_date)->format('Y-m-d'),
                'certificate_number' => $request->certificate_number,
                'certificate_start_date' => Carbon::parse($request->certificate_start_date)->format('Y-m-d'),
                'certificate_end_date' => Carbon::parse($request->certificate_end_date)->format('Y-m-d'),
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
            ]);

            return redirect()->route('front.receipt', [app()->getLocale(),$id])->with('flash_message', read_lang_word('پیام', 'success_record'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }

    public function receipt($lang,$id)
    {
        $tl2rial = Setting::first() ? Setting::first()->rial : 2000;
        $item = CarRentList::where('rent_code', $id)->firstOrFail();

        $price = $item->final_price;
        if (auth()->check() && auth()->user()->hasRole('UserAgent') && auth()->id() == $item->customer_system_id) {
            if ($item->pay_type == 'paynkolay') {
                $price = (int)$item->price_all + (int)$item->off_price;
            } else {
                $price = (int)$item->price_all + (int)$item->off_price;
                $price = $price * $tl2rial;
            }
        }
        $car = $item->car;
        if (!$car) {
            abort(404);
        }
        return view('front.receipt', compact('item', 'car', 'price'), ['title' => read_lang_word('هدر-صفحات-داخلی', 'chap')]);
    }

    public function projects($lang)
    {
        $items = Project::get();

        return view('front.project.index',compact('items'));
    }

    public function project_show($lang,$id,$slug)
    {
        $project = Project::where('id', $id)->first();
        $details = ProjectFeature::where('tab', 'general')->get();
        $Features = ProjectFeature::where('tab', 'equlpment')->where('type', 'select')->get();
        $Additional_details = ProjectFeature::where('tab', 'moref')->get();

        return view('front.project.show1',compact('project','details','Features','Additional_details'));
    }
    public function verifyEmail($lang)
    {
        return view('auth.verify');
    }
    public function verifyEmail_check($lang,Request $request)
    {
        $item=User::where('id',auth()->id())->firstOrFail();
//        return [$item->email_code,$request->email_code];
        if ($item->email_code==$request->email_code){
            User::where('id',auth()->id())->update([
                'email_status'   =>'active',
            ]);

            return redirect()->route('panel.index',app()->getLocale())->withInput()->with('flash_message', 'verify successfully');;
        }else{
            return redirect()->back()->withInput()->with('err_message', 'code is false');
        }
    }

}
