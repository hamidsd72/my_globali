<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Bus\PendingClosureDispatch;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Foundation\Mix;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Queue\CallQueuedClosure;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

use App\Models\CarToken;
use App\Models\TblError;
use App\Models\TblNotError;
use App\Models\Setting;
use App\Models\ApiCurl;
use App\Models\CarPic;
use App\Models\CarPhoto;
use App\Models\Photo;
use App\Models\CarCronJob;
use App\Models\Car;
use App\Models\CarReserve;
use App\Models\CarNerkh;
use App\Models\CarRentList;
use App\Models\Lang;
use App\Models\LangSet;
use App\Models\CrmLang;
use App\Models\SiteWord;
use App\Models\UserToken;
use App\Models\UserWork;
use App\Models\User;
use App\Models\Select;
use App\Models\CountryCode;

if (!function_exists('captcha')) {
    function captcha()
    {
        header('Content-type: image/jpeg');
        $image_name=rand(100,199);
//        $characters = '123456789abcdefghijklmnpqrstwxyz';
//        $charactersLength = strlen($characters);
        $string = rand(1000,9999);
//        for ($i = 0; $i < 5; $i++) {
//            $string .= $characters[rand(0, $charactersLength - 1)];
//        }
        session(['captcha_code' => $string]);
        $font_size = 30;
        $img_width = 150;
        $img_height = 40;

        $image = imagecreate($img_width, $img_height); // create background image with dimensions
        imagecolorallocate($image, 255, 255, 255); // set background color
        $text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color
        imagettftext($image, $font_size, 0, 15, 30, $text_color, 'Vazir-Bold.ttf', $string);
        $image_name=$image_name.'.png';
        imagejpeg($image, $image_name);
        imagedestroy($image);
        return $image_name;
//            return 44;
    }
}

if (!function_exists('optimize_all_pic')) {
    function optimize_all_pic()
    {
        $photos=Photo::where('opt','no')->get();
     	foreach($photos as $ph)
        {
          	optimize_img($ph->path);
          $ph->opt='yes';
          $ph->save();
        }
      $photos=CarPhoto::where('opt','no')->get();
     	foreach($photos as $ph)
        {
          if(blank($ph->path_crm))
          {
            $ph->opt='yes';
            $ph->save();
          }
          else
          {
            optimize_img($ph->path);
          	$ph->opt='yes';
          	$ph->save();
          }
        }
    }
}

if (!function_exists('optimize_img')) {
    function optimize_img($path)
    {
       	$WEBSERVICE = 'http://api.resmush.it/ws.php?img=';
        $optimized_png_arr = json_decode(file_get_contents($WEBSERVICE . urlencode(url($path))));
	
        if (isset($optimized_png_arr->dest)) {
            $optimized_png_url = $optimized_png_arr->dest;

            $fp = fopen($path, 'w+');

            $ch = curl_init($optimized_png_url);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla5.0');
            curl_exec($ch);

            curl_close($ch);
            fclose($fp);
        } 
    }
}

if (!function_exists('get_response_code')) {
    function get_response_code($url) {
      @file_get_contents($url);
      list($version, $status, $text) = explode(' ', $http_response_header[0], 3);

      return $status;
	}
}
if (!function_exists('country_ip')) {
    function country_ip()
    {
        if(ip_address()=='UNKNOWN')
        {
            $country='UNKNOWN';
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".ip_address());
            curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            $params = json_decode($result);
            $country=$params->geoplugin_continentName."/".$params->geoplugin_countryName;
        }
        return $country;
    }
}
if (!function_exists('country_code')) {
    function country_code()
    {
        if(ip_address()=='UNKNOWN')
        {
            $country='UNKNOWN';
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".ip_address());
            curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close($ch);
            $params = json_decode($result);
            $country=$params->geoplugin_countryName;
        }
        $country_code=CountryCode::where('nicename','LIKE','%'.$country.'%')->orWhere('name','LIKE','%'.$country.'%')->first();
        if($country_code)
            return $country_code->phonecode;
        else
            return 1;
    }
}
if (!function_exists('ip_address')) {
    function ip_address()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
if (!function_exists('api_token_delete')) {
    function api_token_delete()
    {
        $end_date=Carbon::now()->subHours(1)->format('Y-m-d H:i:s');
       $items=UserToken::where('updated_at','<',$end_date)->get();
       
       foreach($items as $item)
       {
           $item->delete();
       }
    }
}
if (!function_exists('api_error_delete')) {
    function api_error_delete()
    {
        $end_date=Carbon::now()->subDays(20)->format('Y-m-d H:i:s');
        $items=TblError::where('created_at','<',$end_date)->get();
        $items2=TblNotError::where('created_at','<',$end_date)->get();

        foreach($items as $item)
        {
            $item->delete();
        }
        foreach($items2 as $item)
        {
            $item->delete();
        }
    }
}
if (!function_exists('crm_token_delete')) {
    function crm_token_delete()
    {
        $end_date=Carbon::now()->subHours(24)->format('Y-m-d H:i:s');
        $item=CarToken::where('updated_at','<',$end_date)->first();

        if($item)
        {
            login_crm();
        }
    }
}
if (!function_exists('status_class')) {
    function status_class($item)
    {
        switch ($item)
        {
            case 'مسدود':
                $res='text-danger';
                break;
            case 'در حال اجاره':
                $res='text-warning';
                break;
            case 'آماده تحویل':
                $res='text-success';
                break;
            default:
                $res='';
                break;
        }
        return $res;
    }
}
if (!function_exists('status_rent')) {
    function status_rent($item)
    {
        switch ($item)
        {
            case 'active':
                $class='text-success';
                $res='موفق';
                break;
            case 'pending':
                $class='text-warning';
                $res='نهایی نشده';
                break;
            case 'blocked':
                $class='text-danger';
                $res='نا موفق';
                break;
            default:
                $class='';
                $res='';
                break;
        }
        return [$class,$res];
    }
}
if (!function_exists('nerkh_set')) {
    function nerkh_set($car_id,$from_date,$to_date,$place=null)
    {
        $setting=Setting::first();
        $add_price_delivery=0;
        if($setting && $place=='در محل مشتری')
        {
            $add_price_delivery=$setting->delivery_car;
        }
        $sub_percent_bimeh=0;
        $add_percent_col=0;
        $car=Car::find($car_id);
        if($car && $car->type=='colleague')
        {
            $work=UserWork::where('user_id',$car->colleague_id)->first();
            if($work)
            {
                $add_percent_col=$work->percent;
            }
        }
        if($setting && $add_percent_col==0)
        {
            $sub_percent_bimeh=$setting->percent_bimeh;
        }
       $price=CarNerkh::where('car_system_id',$car_id)->orderByDesc('id')->first();
       
        $start_date = Carbon::parse($from_date);
        $end_date = Carbon::parse($to_date);
        $diff_h = Carbon::parse($start_date)->diffInMinutes(Carbon::parse($end_date), false);
        if((int)$diff_h<1440)
        {
            $diff=1;
        }
        else{
            $diff=(int)floor($diff_h/1440);
            if((int)ceil($diff_h%1440)>120)
            {
                $diff+=1;
            }
        }
	
        $day_p=0;
        $week_p=0;
        $month_p=0;
        $depozit=0;
        $percent_d=0;
        $price_bimeh=0;
        $percent=Setting::first();
        if($percent && $percent->percent>0)
        {
            $percent_d= $percent->percent;
        }
        $day_price=0;
        $price_day_off=0;
        $price_all_off=0;
        $price_all=0;
        $price_rent_off=0;
        $price_rent=0;
        $prepayment_percent=$setting && !blank($setting->prepayment)?$setting->prepayment:0;
        $prepayment_price=0;
        $prepayment_price_off=0;
        $price_all_not_bimeh=0;
        $price_all_off_not_bimeh=0;
        $prepayment_price_not_bimeh=0;
        $prepayment_price_off_not_bimeh=0;
        if($price)
        {
            if($diff<7)
            {
                //bimeh days
                $bime_price_day=((int)$price->price_day * (int)$sub_percent_bimeh)/100;
                //price_day
                $day_price=((int)$price->price_day + round((((int)$price->price_day * (int)$add_percent_col)/100))) - (int)$bime_price_day;
                 //depozit
                $depozit=(int)$price->depozit_day;
            }
            elseif($diff>=7 && $diff<30)
            {
                  $week_num=round($diff/7,1);

                  //price_day_week
                    $price_day_week=round((int)$price->price_week / 7);
                    //bimeh day
                    $bime_price_day=((int)$price_day_week * (int)$sub_percent_bimeh)/100;
                    //price_day
                    $day_price=((int)$price_day_week + round((((int)$price_day_week * (int)$add_percent_col)/100))) - (int)$bime_price_day;
                    //depozit
                    $depozit=(int)$price->depozit_day;
            }
            else
            {
                $month_num=round($diff/30,1);

                //price_day_month
                $price_day_month=round((int)$price->price_month / 30);
                //bimeh day
                $bime_price_day=((int)$price_day_month * (int)$sub_percent_bimeh)/100;
                //price_day
                $day_price=((int)$price_day_month + round((((int)$price_day_month * (int)$add_percent_col)/100))) - (int)$bime_price_day;
                //depozit
                $depozit=(int)$price->depozit_month;
            }

            $price_day_off=(int)$day_price - round(((int)$day_price*$percent_d)/100);
            //rent
            $price_rent=(int)$day_price * $diff;
            $price_rent_off=(int)$price_day_off * $diff;
            //bimeh
            $price_bimeh=(int)$bime_price_day * $diff;
            //all
            $price_all=(int)$price_rent + (int)$depozit + (int)$price_bimeh + (int)$add_price_delivery;
            $price_all_off=(int)$price_rent_off + (int)$depozit + (int)$price_bimeh + (int)$add_price_delivery;
            //beyaneh
            $prepayment_price=round(($price_all * $prepayment_percent) / 100);
            $prepayment_price_off=round(($price_all_off * $prepayment_percent) / 100);
            //all - bimeh
            $price_all_not_bimeh=(int)$price_rent + (int)$depozit  + (int)$add_price_delivery;
            $price_all_off_not_bimeh=(int)$price_rent_off + (int)$depozit  + (int)$add_price_delivery;
            //beyaneh - bimeh
            $prepayment_price_not_bimeh=round(($price_all_not_bimeh * $prepayment_percent) / 100);
            $prepayment_price_off_not_bimeh=round(($price_all_off_not_bimeh * $prepayment_percent) / 100);


            $day_p=$price->price_day+($price->price_day*$add_percent_col)/100;
            $week_p=$price->price_week+($price->price_week*$add_percent_col)/100;
            $month_p=$price->price_month+($price->price_month*$add_percent_col)/100;
        }

        return ['all'=>(int)$price_all_off,'all_not_off'=>(int)$price_all,
                'all_not_bimeh'=>(int)$price_all_off_not_bimeh,'all_not_off_bimeh'=>(int)$price_all_not_bimeh,
                'day_p_not_off'=>(int)$day_price,'day_p_sub_off'=>(int)$price_day_off,
            'all_not_d'=>(int)$price_rent_off,'all_not_d_off'=>(int)$price_rent,
            'delivery_price'=>(int)$add_price_delivery,'bime_price'=>(int)$price_bimeh,
            'day'=>(int)$day_p,'week'=>(int)$week_p,'month'=>(int)$month_p,
            'prepayment_price'=>(int)$prepayment_price,'prepayment_price_off'=>(int)$prepayment_price_off,'prepayment_percent'=>(int)$prepayment_percent,
            'prepayment_price_not_bimeh'=>(int)$prepayment_price_not_bimeh,'prepayment_price_off_not_bimeh'=>(int)$prepayment_price_off_not_bimeh,
            'depozit'=>(int)$depozit,'count_day'=>(int)$diff];
    }
}

if (!function_exists('nerkh_set_day')) {
    function nerkh_set_day($car_id)
    {
        $setting=Setting::first();
        $add_percent_col=0;
        $percent_d=0;
        $day_price=0;
        $price_day_off=0;
        $bime_price_day=0;
        $sub_percent_bimeh=0;

           //car select
        $car=Car::find($car_id);
        if($car && $car->type=='colleague')
        {
            $work=UserWork::where('user_id',$car->colleague_id)->first();
            if($work)
            {
                $add_percent_col=$work->percent;
            }
        }
       //list price
        $price=CarNerkh::where('car_system_id',$car_id)->orderByDesc('id')->first();

        if($setting && $setting->percent>0)
        {
            $percent_d= $setting->percent;
        }
        //bimeh
        if($setting && $add_percent_col==0)
        {
            $sub_percent_bimeh=$setting->percent_bimeh;
        }
        if($price)
        {
            $bime_price_day=((int)$price->price_day * (int)$sub_percent_bimeh)/100;
            $day_price=((int)$price->price_day + round((((int)$price->price_day * (int)$add_percent_col)/100))) - (int)$bime_price_day;
            $price_day_off=(int)$day_price - round(((int)$day_price*$percent_d)/100);
        }

        return ['day_price'=>(int)$day_price,'day_price_off'=>(int)$price_day_off,'day_price_bimeh'=>(int)$bime_price_day];
    }
}

if (!function_exists('login_crm')) {
    function login_crm()
    {
        TblNotError::create([
            'text'=>'درخواست لاگین',
        ]);
            $username = Setting::first()->username;
            $access_key = Setting::first()->accesskey;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://atiavip.crm24.io/webservice.php?operation=getchallenge&username='.$username,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response=(array)json_decode($response, true);

            if ($response && $response["success"]) {
                $result = $response["result"];
                $token = $result["token"];

                $token=md5($token.$access_key);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://atiavip.crm24.io/webservice.php',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array('operation' => 'login', 'username' => $username, 'accessKey' => $token),
                ));

                $response1 = curl_exec($curl);

                curl_close($curl);

                $response1 = (array)json_decode($response1, true);

                if ($response1 && $response1["success"]) {
                    $result1 = $response1["result"];
                if(!CarToken::first())
                {
                    CarToken::create([
                        'token'=>$result1["sessionName"],
                    ]);
                }
                else
                {
                    $car_t=CarToken::first();
                    $car_t->token=$result1["sessionName"];
                    $car_t->update();
                }
                    session(['sessionName' => $result1["sessionName"]]);
                    session(['user_id' => $result1["userId"]]);

                    return $result1["sessionName"];
                }
                else
                {
                    TblError::create([
                       'text'=>'ارور در بخش 2 لاگین',
                    ]);
//                    login_crm();
                }
            }
            else
            {
                TblError::create([
                    'text'=>'ارور در بخش اول لاگین',
                ]);
//                login_crm();
            }

            return false;
        }
}

if (!function_exists('export_car_list')) {
    function export_car_list($start,$count)
    {
        TblNotError::create([
            'text'=>'درخواست خودرو از crm',
        ]);
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $query_car = "select * from vtcmarac limit ".$start.",".$count;
            $result_car = ApiCurl::query_set($sessionName, $query_car);
            $result_car = (array)json_decode($result_car, true);
            if($result_car && $result_car["success"])
            {
                return $result_car["result"];
            }
            else
            {
                if($result_car["error"]["code"]=="INVALID_SESSIONID" || $result_car["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ارور در خروجی خودرو(کوئری)__'.$result_car["error"]["code"],
                ]);
//                export_car_list($start,$count);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در خروجی خودرو(نبود سشن)',
            ]);
//            export_car_list($start,$count);
        }
    }
}
if (!function_exists('car_insert')) {
    function car_insert($start,$count)
    {
            $items=export_car_list($start,$count);
            if(!$items)
            {
                TblError::create([
                    'text'=>'ارور در بخش خروجی خودرو(نبود آیتم ها)',
                ]);
//                car_insert($start,$count);
            }
            foreach ($items as $item)
            {

                $car_update=true;
                $car=Car::where('car_id',$item["id"])->first();
                if(!$car)
                {
                    $car_update=false;
                    $car=new Car();
                }
                $fuel_en=null;
                if(!blank($item["cf_3175"]))
                {
                    $crm_lang=CrmLang::where('value',$item["cf_3175"])->first();
                    if($crm_lang && $crm_lang->lang!='EN')
                    {
                        $crm_lang_en=CrmLang::where('id',$crm_lang->parent_id)->first();
                        if($crm_lang_en)
                        {
                            $fuel_en=$crm_lang_en->value;
                        }
                    }
                    else
                    {
                        $fuel_en=$item["cf_3175"];
                    }
                }
                $gearbox_en=null;
                if(!blank($item["cf_3177"]))
                {
                    $crm_lang=CrmLang::where('value',$item["cf_3177"])->first();
                    if($crm_lang && $crm_lang->lang!='EN')
                    {
                        $crm_lang_en=CrmLang::where('id',$crm_lang->parent_id)->first();
                        if($crm_lang_en)
                        {
                            $gearbox_en=$crm_lang_en->value;
                        }
                    }
                    else
                    {
                        $gearbox_en=$item["cf_3177"];
                    }
                }
                $color_en=null;
                if(!blank($item["cf_3179"]))
                {
                    $crm_lang=CrmLang::where('value',$item["cf_3179"])->first();
                    if($crm_lang && $crm_lang->lang!='EN')
                    {
                        $crm_lang_en=CrmLang::where('id',$crm_lang->parent_id)->first();
                        if($crm_lang_en)
                        {
                            $color_en=$crm_lang_en->value;
                        }
                    }
                    else
                    {
                        $color_en=$item["cf_3179"];
                    }
                }
                $car->car_id=!blank($item["id"])?$item["id"]:null;
                $car->brand=!blank($item["cf_3171"])?$item["cf_3171"]:null;
                $car->model=!blank($item["cf_3173"])?$item["cf_3173"]:null;
                $car->fuel=$fuel_en;
                $car->gearbox=$gearbox_en;
                $car->color=$color_en;
                $car->year=!blank($item["cf_3181"])?$item["cf_3181"]:null;
                $car->motor_power=!blank($item["cf_3183"])?$item["cf_3183"]:null;
                $car->shasi_number=!blank($item["cf_3185"])?$item["cf_3185"]:null;
                $car->motor_number=!blank($item["cf_3187"])?$item["cf_3187"]:null;
                $car->technical_from_date=!blank($item["cf_3189"])?$item["cf_3189"]:null;
                $car->technical_to_date=!blank($item["cf_3191"])?$item["cf_3191"]:null;
                $car->end_service_date=!blank($item["cf_3193"])?$item["cf_3193"]:null;
                $car->sale_type=!blank($item["cf_3207"])?$item["cf_3207"]:null;
                $car->sale_date=!blank($item["cf_3209"])?$item["cf_3209"]:null;
                $car->sale_km=!blank($item["cf_3213"])?$item["cf_3213"]:null;
                $car->status=!blank($item["cf_3626"])?$item["cf_3626"]:null;
                $car->return_date=!blank($item["cf_3948"])?$item["cf_3948"]:null;
                $car->useful_km=!blank($item["cf_4120"])?$item["cf_4120"]:null;
                $car->all_km=!blank($item["cf_4122"])?$item["cf_4122"]:null;
                $car->bak_litr=!blank($item["cf_4323"])?$item["cf_4323"]:null;
                $car->created_car=$item["createdtime"];
                $car->update_car=$item["modifiedtime"];
                $car->pelak=!blank($item["fld_vtcmaracf1"])?$item["fld_vtcmaracf1"]:null;
                $car->delete_set='no';

                $car_update?$car->update():$car->save();

                $element_end=$car_update?'edit':'create';
              
                store_lang($car,'crm_lang',['fuel','gearbox','color'],$element_end,'not_request');
            }


            return count($items);
    }
}

if (!function_exists('export_reserve_list')) {
    function export_reserve_list($start,$count)
    {
        TblNotError::create([
            'text'=>'درخواست رزرو خودرو از crm',
        ]);
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $query_reserve="select * from vtcmreserv WHERE cf_3778 in ('فعال','ثبت قرارداد') limit ".$start.",".$count;
            $result_reserve = ApiCurl::query_set($sessionName, $query_reserve);
            $result_reserve = (array)json_decode($result_reserve, true);
            if($result_reserve && $result_reserve["success"])
            {
                return $result_reserve["result"];
            }
            else
            {
                if($result_reserve["error"]["code"]=="INVALID_SESSIONID" || $result_reserve["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ارور در خروجی رزروها(کوئری)__'.$result_reserve["error"]["code"],
                ]);
//                export_reserve_list($start,$count);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در خروجی رزروها(نبود سشن)',
            ]);
//            export_reserve_list($start,$count);
        }
    }
}
if (!function_exists('reserve_insert')) {
    function reserve_insert($start,$count)
    {
            $items=export_reserve_list($start,$count);
            if(!$items)
            {
                TblError::create([
                    'text'=>'ارور در خروجی رزروها(نبود آیتم)',
                ]);
//                reserve_insert($start,$count);
            }
            foreach ($items as $item)
            {
                $car_id=null;
                $car_set=Car::where('car_id',$item["cf_3757"])->first();
                if($car_set)
                {
                    $car_id=$car_set->id;
                }
                $reserve_update=true;
                $end_date=Carbon::parse($item["cf_3769"])->addDays($item["cf_3771"])->format('Y-m-d');
                $reserve=CarReserve::where('reserve_id',$item["id"])->first();
                if(!$reserve)
                {
                    $reserve_update=false;
                    $reserve=new CarReserve();
                }
                $reserve->reserve_id=!blank($item["id"])?$item["id"]:null;
                $reserve->car_system_id=$car_id;
                $reserve->car_id=!blank($item["cf_3757"])?$item["cf_3757"]:null;
                $reserve->customer_id=!blank($item["cf_4012"])?$item["cf_4012"]:null;
                $reserve->first_name=!blank($item["cf_3759"])?$item["cf_3759"]:null;
                $reserve->last_name=!blank($item["cf_3761"])?$item["cf_3761"]:null;
                $reserve->full_name=$item["cf_3759"].' '.$item["cf_3761"];
                $reserve->phone=!blank($item["cf_3763"])?$item["cf_3763"]:null;
                $reserve->whatssapp=!blank($item["cf_3765"])?$item["cf_3765"]:null;
                $reserve->request_date=!blank($item["cf_3767"])?$item["cf_3767"]:null;
                $reserve->reserve_start_date=!blank($item["cf_3769"])?$item["cf_3769"]:null;
                $reserve->reserve_end_date=!blank($end_date)?$end_date:null;
                $reserve->reserve_day=!blank($item["cf_3771"])?$item["cf_3771"]:null;
                $reserve->price_beyaneh=!blank($item["cf_3773"])?$item["cf_3773"]:null;
                $reserve->payment_type=!blank($item["cf_3775"])?$item["cf_3775"]:null;
                $reserve->status=!blank($item["cf_3778"])?$item["cf_3778"]:null;
                $reserve->price_all=!blank($item["cf_3780"])?$item["cf_3780"]:null;
                $reserve->price_depozit=!blank($item["cf_3782"])?$item["cf_3782"]:null;
                $reserve->place_at=!blank($item["cf_3784"])?$item["cf_3784"]:null;
                $reserve->created_reserve=$item["createdtime"];
                $reserve->update_reserve=$item["modifiedtime"];
                $reserve->reserve_code=!blank($item["reservno"])?$item["reservno"]:null;

                $reserve_update?$reserve->update():$reserve->save();
            }

            return count($items);
    }
}

if (!function_exists('export_nerkh_list')) {
    function export_nerkh_list($start,$count)
    {
        TblNotError::create([
            'text'=>'درخواست نرخ خودرو از crm',
        ]);
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $query_nerkh="select * from vtcmnerkh limit ".$start.",".$count;
            $result_nerkh = ApiCurl::query_set($sessionName, $query_nerkh);
            $result_nerkh = (array)json_decode($result_nerkh, true);
            if($result_nerkh && $result_nerkh["success"])
            {
                return $result_nerkh["result"];
            }
            else
            {
                if($result_nerkh["error"]["code"]=="INVALID_SESSIONID" || $result_nerkh["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ارور در خروجی نرخها(کوئری)__'.$result_nerkh["error"]["code"],
                ]);
//                export_nerkh_list($start,$count);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در خروجی نرخ ها(نبود سشن)',
            ]);
//            export_nerkh_list($start,$count);
        }
    }
}
if (!function_exists('nerkh_insert')) {
    function nerkh_insert($start,$count)
    {
            $items=export_nerkh_list($start,$count);
            if(!$items)
            {
                TblError::create([
                    'text'=>'ارور در خروجی نرخ ها(نبود آیتم)',
                ]);
//                nerkh_insert($start,$count);
            }
            foreach ($items as $item)
            {
                $car_id=null;
                $car_set=Car::where('car_id',$item["cf_3791"])->first();
                if($car_set)
                {
                    $car_id=$car_set->id;
                }
                $reserve_update=true;
                $reserve=CarNerkh::where('nerkh_id',$item["id"])->first();
                if(!$reserve)
                {
                    $reserve_update=false;
                    $reserve=new CarNerkh();
                }
                $reserve->nerkh_id=!blank($item["id"])?$item["id"]:null;
                $reserve->car_system_id=$car_id;
                $reserve->car_id=!blank($item["cf_3791"])?$item["cf_3791"]:null;
                $reserve->car_pelak=!blank($item["fld_vtcmnerkhf1"])?$item["fld_vtcmnerkhf1"]:null;
                $reserve->update_nerkh=!blank($item["cf_3218"])?$item["cf_3218"]:null;
                $reserve->date_to_nerkh=!blank($item["cf_3220"])?$item["cf_3220"]:null;
                $reserve->price_day=!blank($item["cf_3230"])?$item["cf_3230"]:null;
                $reserve->price_week=!blank($item["cf_3232"])?$item["cf_3232"]:null;
                $reserve->price_month=!blank($item["cf_3234"])?$item["cf_3234"]:null;
                $reserve->depozit_month=!blank($item["cf_3787"])?$item["cf_3787"]:null;
                $reserve->depozit_day=!blank($item["cf_3789"])?$item["cf_3789"]:null;
                $reserve->update_ok=!blank($item["cf_4331"])?$item["cf_4331"]:null;
                $reserve->created_field=!blank($item["createdtime"])?$item["createdtime"]:null;
                $reserve->update_field=!blank($item["modifiedtime"])?$item["modifiedtime"]:null;
                $reserve->nerkh_code=!blank($item["nerkhno"])?$item["nerkhno"]:null;

                $reserve_update?$reserve->update():$reserve->save();
            }
        return count($items);

    }
}
if (!function_exists('export_img_car_id')) {
    function export_img_car_id($id)
    {
        TblNotError::create([
            'text'=>'درخواست تصاویر خودرو از crm',
        ]);
        $car=Car::findOrFail($id);
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
                $result_img=ApiCurl::query_doc1($sessionName, $car->car_id);
                $result_img = (array)json_decode($result_img, true);
                if($result_img && $result_img["success"])
                {
                    $ressss=false;
                    if(count($result_img["result"]))
                    {
                        foreach ($result_img["result"] as $res)
                        {
                            $result_img2=ApiCurl::query_doc2($sessionName, $res["id"]);
                            $result_img2 = (array)json_decode($result_img2, true);
                            if($result_img2 && $result_img2["success"])
                            {
                                $img_res=$result_img2["result"];
                                if($img_res && count($img_res) && $img_res["filetype"] && explode('/',$img_res["filetype"])[0]=='image')
                                {
                                    $title=$res["notes_title"];
                                    if(stripos($title, 'عکس خودرو') !== FALSE || stripos($title, 'جلو') !== FALSE || stripos($title, 'عقب') !== FALSE ){
                                        $photo_set=CarPhoto::where('car_id',$car->car_id)->where('car_system_id',$car->id)->where('path_crm',$img_res["filepath"])->first();
                                        //  && isFile($img_res["filepath"])

                                        if(blank($photo_set))
                                        {

                                            if((int)get_response_code($img_res["filepath"])!=403)
                                            {
                                                $file_name='assets/uploads/car/crm/'.time().'_'.basename($img_res["filepath"]);
                                                $file_d=file_put_contents($file_name, fopen($img_res["filepath"],'r'));

                                                $photo_car=new CarPhoto();
                                                $photo_car->car_id=$car->car_id;
                                                $photo_car->car_system_id=$car->id;
                                                $photo_car->path=$file_name;
                                                $photo_car->path_crm=$img_res["filepath"];
                                                $photo_car->note=$res["notes_title"];
                                                $photo_car->save();

                                                $ressss=true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        return 'not_pic';
                    }

                    return $ressss;
                }

        }
        else
        {
            TblError::create([
                'text'=>'ارور در خروجی تصاویر خودروها(نبود سشن)',
            ]);
            return false;
        }
    }
}
if (!function_exists('export_img_car_list')) {
    function export_img_car_list($start,$count)
    {
        TblNotError::create([
            'text'=>'درخواست تصاویر خودرو از crm',
        ]);
        $cars=Car::where('type','company')->skip($start)->take($count)->get();
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            foreach ($cars as $car)
            {
                if($car->id==792)
                {
                    $result_img=ApiCurl::query_doc1($sessionName, $car->car_id);
                    $result_img = (array)json_decode($result_img, true);
                    if($result_img && $result_img["success"])
                    {
                        foreach ($result_img["result"] as $res)
                        {
                            $result_img2=ApiCurl::query_doc2($sessionName, $res["id"]);
                            $result_img2 = (array)json_decode($result_img2, true);
                            if($result_img2 && $result_img2["success"])
                            {
                                $img_res=$result_img2["result"];
                                if($img_res && count($img_res) && $img_res["filetype"] && explode('/',$img_res["filetype"])[0]=='image')
                                {
                                    $title=$res["notes_title"];
                                    if(stripos($title, 'عکس خودرو') !== FALSE || stripos($title, 'جلو') !== FALSE || stripos($title, 'عقب') !== FALSE ){
                                        $photo_set=CarPhoto::where('car_id',$car->car_id)->where('car_system_id',$car->id)->where('path_crm',$img_res["filepath"])->first();
                                        //  && isFile($img_res["filepath"])

                                        if(!$photo_set)
                                        {

                                            if((int)get_response_code($img_res["filepath"])!=403)
                                            {
                                                $file_name='assets/uploads/car/crm/'.time().'_'.basename($img_res["filepath"]);
                                                $file_d=file_put_contents($file_name, fopen($img_res["filepath"],'r'));

                                                $photo_car=new CarPhoto();
                                                $photo_car->car_id=$car->car_id;
                                                $photo_car->car_system_id=$car->id;
                                                $photo_car->path=$file_name;
                                                $photo_car->path_crm=$img_res["filepath"];
                                                $photo_car->note=$res["notes_title"];
                                                $photo_car->save();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return $cars;
        }
        else
        {
            TblError::create([
                'text'=>'ارور در خروجی تصاویر خودروها(نبود سشن)',
            ]);
            export_img_car_list($start,$count);
        }
    }
}
if (!function_exists('img_car_insert')) {
    function img_car_insert($start,$count)
    {
        $items=export_img_car_list($start,$count);
        if(!$items)
        {
            TblError::create([
                'text'=>'ارور در خروجی تصاویر خودروها(نبود آیتم)',
            ]);
//            img_car_insert($start,$count);
        }
        return count($items);

    }
}

if (!function_exists('reserve_ok_insert_to_crm')) {
    function reserve_ok_insert_to_crm()
    {
        $items=CarRentList::where('status','active')->where('car_type','company')->where('status_reserve','no')->where('status_record','site')->where('send_crm','no')->get();
      foreach ($items as $item)
        {
//            if($item->user_info)
//            {
                $check=reserve_insert_to_crm($item);

                if($check && count($check))
                {
                    $item->customer_id=!blank($check["cf_4012"])?$check["cf_4012"]:null;
                    $item->send_crm='yes';
                    $item->update();

                    $item->user->customer_id=$item->customer_id;
                    $item->user->update();

                    $reserve=new CarReserve();
                    $reserve->reserve_id=!blank($check["id"])?$check["id"]:null;
                    $reserve->car_system_id=$item->car_system_id;
                    $reserve->car_id=$item->car_id;
                    $reserve->customer_id=!blank($check["cf_4012"])?$check["cf_4012"]:null;
                    $reserve->first_name=$item->first_name;
                    $reserve->last_name=$item->last_name;
                    $reserve->full_name=$item->full_name;
                    $reserve->phone=$item->phone;
                    $reserve->whatssapp=!blank($check["cf_3765"])?$check["cf_3765"]:null;
                    $reserve->request_date=!blank($check["cf_3767"])?$check["cf_3767"]:null;
                    $reserve->reserve_start_date=!blank($check["cf_3769"])?$check["cf_3769"]:null;
                    $reserve->reserve_end_date=$item->to_date;
                    $reserve->reserve_day=!blank($check["cf_3771"])?$check["cf_3771"]:null;
                    $reserve->price_beyaneh=!blank($check["cf_3773"])?$check["cf_3773"]:null;
                    $reserve->payment_type=!blank($check["cf_3775"])?$check["cf_3775"]:null;
                    $reserve->status=!blank($check["cf_3778"])?$check["cf_3778"]:null;
                    $reserve->price_all=!blank($check["cf_3780"])?$check["cf_3780"]:null;
                    $reserve->price_depozit=!blank($check["cf_3782"])?$check["cf_3782"]:null;
                    $reserve->place_at=!blank($check["cf_3784"])?$check["cf_3784"]:null;
                    $reserve->created_reserve=$check["createdtime"];
                    $reserve->update_reserve=$check["modifiedtime"];
                    $reserve->reserve_code=!blank($check["reservno"])?$check["reservno"]:null;
                    $reserve->save();
                }
//            }
        }
    }
}
if (!function_exists('customer_check_to_crm')) {
    function customer_check_to_crm($item)
    {
        TblNotError::create([
            'text'=>'درخواست وجود مشتری از crm',
        ]);
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $s_name = $sessionName;
//            customer invent??
            $username=str_replace(['-','_','/'],'',$item->phone);
            $query_customer="select * from Accounts WHERE cf_3952 = ".$username;
//            $query_customer="select * from Accounts WHERE cf_3952 = '09187107810'";
            $result_customer = ApiCurl::query_set($sessionName, $query_customer);
            $result_customer = (array)json_decode($result_customer, true);
            if($result_customer && $result_customer["success"])
            {
                return $result_customer["result"];
            }
            else
            {
                if($result_customer["error"]["code"]=="INVALID_SESSIONID" || $result_customer["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ارور در چک کردن اطلاعات مشتری(کوئری)__'.$result_customer["error"]["code"],
                ]);
//                customer_check_to_crm($item);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در چک کردن اطلاعات مشتری (نبود سشن)',
            ]);
//            customer_check_to_crm($item);
        }
    }
}
if (!function_exists('customer_insert_to_crm')) {
    function customer_insert_to_crm($item)
    {
        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
      if($item->user_info)
      {
        $customer=[
          "accountname"=>$item->user_info->full_name,
          
          "cf_3952"=>$item->user_info->phone1,
          "cf_3954"=>$item->user_info->phone2,
          
          "cf_3956"=>$item->user_info->f_name,
          "cf_3958"=>$item->user_info->l_name,
          "cf_4044"=>$item->user_info->father_name,
          
          "cf_4018"=>$item->user_info->birth_date,
          "cf_4016"=>$item->user_info->birth_place,
          
          "cf_3972"=>$item->user_info->passport_number,
          "cf_3974"=>$item->user_info->passport_start_date,
          "cf_3976"=>$item->user_info->passport_end_date,
          
          "cf_3980"=>$item->user_info->kimilik_number,
           "cf_3982"=>$item->user_info->kimilik_serial,
          "cf_3984"=>$item->user_info->kimilik_start_date,
          "cf_3986"=>$item->user_info->kimilik_end_date,
          
          "cf_3962"=>$item->user_info->certificate_number,
          "cf_3964"=>$item->user_info->certificate_start_date,
          "cf_3966"=>$item->user_info->certificate_end_date,
          
          "cf_1009"=>$item->user_info->address,
          
          "assigned_user_id"=>'19x27',
        ];
      }
      else
       { 
        $customer=[
            "accountname"=>$item->full_name,
            "cf_3952"=>$item->phone,
            "assigned_user_id"=>'19x27',
        ];
      }
        $customer_json=json_encode($customer);

        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $s_name = $sessionName;

            $result_customer = ApiCurl::create_f($s_name, $customer_json, 'Accounts');
            $result_customer = (array)json_decode($result_customer, true);
            if($result_customer && $result_customer["success"])
            {
                return $result_customer["result"];
            }
            else
            {
                if($result_customer["error"]["code"]=="INVALID_SESSIONID" || $result_customer["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ارور در ثبت کردن اطلاعات مشتری(کوئری)__'.$result_customer["error"]["code"],
                ]);
//                customer_insert_to_crm($item);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در ثبت کردن اطلاعات مشتری (نبود سشن)',
            ]);
//            customer_insert_to_crm($item);
        }
    }
}
if (!function_exists('reserve_insert_to_crm')) {
    function reserve_insert_to_crm($item)
    {
        $start_date = Carbon::parse($item->from_date);
        $end_date = Carbon::parse($item->to_date);
        $diff = $start_date->diffInDays($end_date, false);
        $customer_id=0;
        $user_check=customer_check_to_crm($item);
        if($user_check && count($user_check))
        {
            $customer_id=$user_check[0]["id"];
        }
        else
        {
            $check_user=customer_insert_to_crm($item);
            if($check_user && count($check_user))
            {
                $customer_id=$check_user["id"];
            }
        }

        if (CarToken::first()) {
            $sessionName=CarToken::first()->token;
        }
        else
        {
            $sessionName=login_crm();
        }
        if ($sessionName) {
            $s_name = $sessionName;

            $tbl_name = 'vtcmreserv';
            $element=[
                'cf_3757'=>$item->car_id,
                'cf_3759'=>$item->first_name,
                'cf_3761'=>$item->last_name,
                'cf_4012'=>$customer_id,
                'cf_3763'=>$item->phone,
                'cf_3767'=>Carbon::parse($item->created_at)->format("Y-m-d"),
                'cf_3769'=>Carbon::parse($item->from_date)->format("Y-m-d"),
                'cf_3771'=>$diff,
                'cf_3773'=>$item->price_all,
                'cf_3775'=>"نقدی",
                'cf_3778'=>"فعال",
                'cf_3780'=>$item->price_all,
                'cf_3782'=>$item->price_depozit,
                'cf_3784'=>$item->place_delivery,
                'assigned_user_id'=>"19x27",
            ];
            $element=json_encode($element);

            $response = ApiCurl::create_f($s_name, $element, $tbl_name);

            $response = (array)json_decode($response, true);
            if ($response && $response["success"])
            {
                return $response["result"];
            }
            else
            {
                if($response["error"]["code"]=="INVALID_SESSIONID" || $response["error"]["code"]=="AUTHENTICATION_REQUIRED")
                {
                    login_crm();
                }
                TblError::create([
                    'text'=>'ثبت رزرو خودرو در crm(کوئری)__'.$response["error"]["code"],
                ]);
            }
        }
        else
        {
            TblError::create([
                'text'=>'ارور در ثبت کردن اطلاعات رزرو (نبود سشن)',
            ]);
//            reserve_insert_to_crm($item);
        }
    }
}

if (!function_exists('reserv_list')) {
    function reserv_list($car_id,$reserv_list)
    {
        $reserve_check=false;
       foreach ($reserv_list as $reserve)
       {
           if($car_id==$reserve["cf_3757"])
           {
               $reserve_check=true;
           }
       }
       return $reserve_check;
    }
}
if (!function_exists('isFile')) {
    function isFile($url)
    {
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}
if (!function_exists('pic_set_car')) {
    function pic_set_car($data,$check=null)
    {
        $address_pic_set=false;
        $address_pic=url('assets/front/img/home1/car-8.jpg');
        $car=Car::find($data->id);
      
        if($car)
        {
            if($car->car_photo && is_file($car->car_photo->path))
            {
                $address_pic=url($car->car_photo->path);
                $address_pic_set=true;
            }
            elseif($car->car_photos && count($car->car_photos) && is_file($car->car_photos[0]->path))
            {
                $address_pic=url($car->car_photos[0]->path);
                $address_pic_set=true;
            }
             elseif($car->photo)
            {
                $address_pic=url($car->photo->path);
                $address_pic_set=true;
            }
            elseif($car->photos && count($car->photos))
            {
                $address_pic=url($car->photos[0]->path);
                $address_pic_set=true;
            }
            else
            {
                $car_pic=CarPic::where('brand',str_replace(' ','_',$data->brand))->where('model',str_replace(' ','_',$data->model))->where('year',$data->year)->where('motor',$data->motor_power)->where('color',$data->color)->first();
                if($car_pic && $car_pic->photo && is_file($car_pic->photo->path))
                {
                    $address_pic=url($car_pic->photo->path);
                    $address_pic_set=true;
                }
            }
        }
        if($check)
        {
            return $address_pic_set;
        }
        return $address_pic;
    }
}

if (!function_exists('percent_set')) {
    function percent_set($price)
    {
        $price_p=0;
        $percent_d=0;
        $off_price=0;
        $percent=Setting::first();
        if($percent && $percent->percent>0)
        {
            $price_p=$price-(($price*$percent->percent)/100);
            $percent_d= $percent->percent;
            $off_price=($price*$percent->percent)/100;
        }
        
       return [round($price_p,0),$percent_d,$off_price];
    }
}

if (!function_exists('dir_set')) {
    function dir_set()
    {
       return LangSet::where('lang',app()->getLocale())->firstOrFail()->align;
    }
}
if (!function_exists('font_farsi')) {
    function font_farsi()
    {
       return LangSet::where('lang',app()->getLocale())->firstOrFail()->farsi_font;
    }
}

if (!function_exists('tab_langs')) {
    function tab_langs()
    {
       return LangSet::where('status','!=','default')->get();
    }
}
if (!function_exists('menu_langs')) {
    function menu_langs()
    {
       return LangSet::whereIN('status',['active','default'])->where('lang','!=',app()->getLocale())->get();
    }
}
if (!function_exists('site_lang')) {
    function site_lang()
    {
       return LangSet::where('lang',app()->getLocale())->first();
    }
}
if (!function_exists('lang')) {
    function lang()
    {
       return app()->getLocale();
    }
}
if (!function_exists('set_lang')) {
    function set_lang($item,$lang,$data,$col,$type)
    {
        if($type=='edit') {
            foreach ($item->langs as $l_del) {
                $l_del->delete();
            }
        }

        $new_l              = new Lang();
        $new_l->lang        = $lang;
        $new_l->text        = $data;
        $new_l->col_name    = $col;
        $item->langs()->save($new_l);
    }
}

if (!function_exists('store_lang')) {
    function store_lang($item,$request,$cols,$type,$end=null)
    {
        $langs=LangSet::where('status','!=','default')->get();

        if($type=='edit')
        {
            foreach ($item->langs as $l_del)
            {
                $l_del->delete();
            }
        }
        foreach ($langs as $lang)
        {
            foreach ($cols as $col)
            {
                if($end=='not_request')
                {
            
                    $crm_lang_en=CrmLang::where('value',$item->$col)->first();
                  
                    if($crm_lang_en)
                   {
                       $crm_lang=CrmLang::where('parent_id',$crm_lang_en->id)->where('lang',$lang->lang)->first();
                     
                       if($crm_lang)
                       {
                           $new_l = new Lang();
                           $new_l->col_name=$col;
                           $new_l->lang=$lang->lang;
                           $new_l->text=$crm_lang->value;
                           $item->langs()->save($new_l);
                       }
                   }
                }
                else
                {
                    $col_lang=$col.'_'.$lang->lang;
                    if (!blank($request->$col_lang)) {
                        $new_l = new Lang();
                        $new_l->col_name=$col;
                        $new_l->lang=$lang->lang;
                        $new_l->text=$request->$col_lang;
                        $item->langs()->save($new_l);
                    }
                }
            }
        }
    }
}
if (!function_exists('read_lang')) {
    function read_lang($item,$col_name,$lang=null)
    {
        $lang=$lang==null?lang():$lang;
        $lang_def=LangSet::where('lang',$lang)->first();

        if($lang_def->status=='default')
        {
            $text=$item->$col_name;
        }
        else
        {
            $lang_item=$item->langs->where('lang',$lang_def->lang)->where('col_name',$col_name)->first();
            if($lang_item)
                $text=$lang_item->text;
            else
                $text=null;
        }

       return $text;
    }
}
if (!function_exists('read_lang_word')) {
    function read_lang_word($out,$in)
    {
        $item=SiteWord::where('place_out',$out)->where('place_in',$in)->first();
     
        if(!$item)
        {
            return null;
        }
        $col_name='word';
        $lang=app()->getLocale();
        $lang_def=LangSet::where('lang',$lang)->first();
    
        if($lang_def->status=='default')
        {
            $text=$item->$col_name;
        }
        else
        {
            $lang_item=$item->langs->where('lang',$lang_def->lang)->where('col_name',$col_name)->first();
          
            if($lang_item)
                $text=$lang_item->text;
            else
                $text=null;
        }

        return $text;
    }
}
if (!function_exists('status_check')) {
    function status_check($item)
    {
        $status=false;
        $lang=lang();
        $lang_def=LangSet::where('lang',$lang)->first();

        if($lang_def->status=='default')
           $status=$item->status=='active'?true:false;
        else
        {
            $lang_item=$item->langs->where('lang',$lang_def->lang)->where('col_name','status')->first();
            if($lang_item)
                $status=$lang_item->text=='active'?true:false;
        }

       return $status;
    }
}
if (!function_exists('num_to_en')) {
    function num_to_en($data)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $output= str_replace($persian, $english, $data);
        return $output;
    }
}
if (!function_exists('type_file')) {
    function type_file($item)
    {
        $type = explode('.', $item);
        $end = end($type);
        return $end;
    }
}
if (!function_exists('explode_last')) {
    function explode_last($item,$joda)
    {
        $type = explode($joda, $item);
        $end = end($type);
        return $end;
    }
}
if (!function_exists('phone_check')) {
    function phone_check($item)
    {
        $number = '';
        $number .= substr($item, 0, 3);
        $number .= '-';
        $number .= substr($item, 3);
        return $number;
    }
}
if (!function_exists('status')) {
    function status($item)
    {
        switch ($item) {
            case 'active':
                {
                    return '<span class="badge badge-success">فعال</span>';
                    break;
                }
            case 'pending':
                {
                    return '<span class="badge badge-warning">درحال بررسی</span>';
                    break;
                }
            case 'blocked':
                {
                    return '<span class="badge badge-danger">مسدود</span>';
                    break;
                }
            case 'cancel':
                {
                    return '<span class="badge badge-danger">کنسل</span>';
                    break;
                }
            case 'inactive':
                {
                    return '<span class="badge badge-danger">غیرفعال</span>';
                    break;
                }
        }
    }
}
if (!function_exists('file_store')) {
    function file_store($u_file, $u_path, $u_prefix)
    {
        $file = $u_file;
        $originalName = $u_file->getClientOriginalName();
        $destinationPath = $u_path;
        $extension = $file->getClientOriginalExtension();
        $fileName = $u_prefix . md5(time() . '-' . $originalName) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        $f_path = $destinationPath . "" . $fileName;
        return $f_path;
    }
}

if (!function_exists('my_gdate')) {
    function my_gdate($data)
    {
        $data=str_replace('-','/',$data);
        $data=explode('/',$data);
        if(count($data)>2)
        {
            require_once('jdf.php');
            $date = jalali_to_gregorian($data[0], $data[1], $data[2], '/');
            return $date;
        }
        return false;
    }
}
if (!function_exists('my_jdate')) {
    function my_jdate($date, $type)
    {
        $timestamp = (strtotime($date));
        require_once('jdf.php');
        $jalali_date = jdate($type, $timestamp);
        return $jalali_date;
    }
}

if (!function_exists('set_currency_type')) {
    function set_currency_type($item)
    {
        switch ($item) {
            case 'euro':
                {
                    return 'یورو';
                    break;
                }
            case 'us_dollar':
                {
                    return 'دلار آمریکا';
                    break;
                }
            case 'australian_dollar':
                {
                    return 'دلار استرالیا';
                    break;
                }
            case 'yuan':
                {
                    return 'یوان';
                    break;
                }
        }
    }
}
if (!function_exists('currency_type')) {
    function currency_type()
    {
        $grade = [
            ['value' => 'euro', 'name' => 'یورو'],
            ['value' => 'us_dollar', 'name' => 'دلار آمریکا'],
            ['value' => 'australian_dollar', 'name' => 'دلار استرالیا'],
            ['value' => 'yuan', 'name' => 'یوان'],
        ];
        return $grade;
    }
}

if (!function_exists('array_pluck')) {
    function array_pluck($items, $value, $title, $defult = null)
    {
        $r = [];
        if ($defult != null) {
            $r = [$defult[0] => $defult[1]];
        }

        $r += Arr::pluck($items, $value, $title);
        return $r;

    }
}
if (!function_exists('array_pluck2')) {
    function array_pluck2($items, $value, $value2, $title, $defult = null)
    {
        $r = [];
        if ($defult != null) {
            $r = [$defult[0] => $defult[1]];
        }

        $r += Arr::pluck($items, $value, $title);
        return $r;

    }
}

if (!function_exists('abort')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int $code
     * @param  string $message
     * @param  array $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort($code, $message = '', array $headers = [])
    {
        if ($code instanceof Response) {
            throw new HttpResponseException($code);
        } elseif ($code instanceof Responsable) {
            throw new HttpResponseException($code->toResponse(request()));
        }

        app()->abort($code, $message, $headers);
    }
}

if (!function_exists('abort_if')) {
    /**
     * Throw an HttpException with the given data if the given condition is true.
     *
     * @param  bool $boolean
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int $code
     * @param  string $message
     * @param  array $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort_if($boolean, $code, $message = '', array $headers = [])
    {
        if ($boolean) {
            abort($code, $message, $headers);
        }
    }
}

if (!function_exists('abort_unless')) {
    /**
     * Throw an HttpException with the given data unless the given condition is true.
     *
     * @param  bool $boolean
     * @param  \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable|int $code
     * @param  string $message
     * @param  array $headers
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    function abort_unless($boolean, $code, $message = '', array $headers = [])
    {
        if (!$boolean) {
            abort($code, $message, $headers);
        }
    }
}

if (!function_exists('action')) {
    /**
     * Generate the URL to a controller action.
     *
     * @param  string|array $name
     * @param  mixed $parameters
     * @param  bool $absolute
     * @return string
     */
    function action($name, $parameters = [], $absolute = true)
    {
        return app('url')->action($name, $parameters, $absolute);
    }
}

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null $abstract
     * @param  array $parameters
     * @return mixed|\Illuminate\Contracts\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string $path
     * @return string
     */
    function app_path($path = '')
    {
        return app()->path($path);
    }
}

if (!function_exists('asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string $path
     * @param  bool|null $secure
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}

if (!function_exists('auth')) {
    /**
     * Get the available auth instance.
     *
     * @param  string|null $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    function auth($guard = null)
    {
        if (is_null($guard)) {
            return app(AuthFactory::class);
        }

        return app(AuthFactory::class)->guard($guard);
    }
}

if (!function_exists('back')) {
    /**
     * Create a new redirect response to the previous location.
     *
     * @param  int $status
     * @param  array $headers
     * @param  mixed $fallback
     * @return \Illuminate\Http\RedirectResponse
     */
    function back($status = 302, $headers = [], $fallback = false)
    {
        return app('redirect')->back($status, $headers, $fallback);
    }
}

if (!function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->basePath($path);
    }
}

if (!function_exists('bcrypt')) {
    /**
     * Hash the given value against the bcrypt algorithm.
     *
     * @param  string $value
     * @param  array $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->driver('bcrypt')->make($value, $options);
    }
}

if (!function_exists('broadcast')) {
    /**
     * Begin broadcasting an event.
     *
     * @param  mixed|null $event
     * @return \Illuminate\Broadcasting\PendingBroadcast
     */
    function broadcast($event = null)
    {
        return app(BroadcastFactory::class)->event($event);
    }
}

if (!function_exists('cache')) {
    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     * @return mixed|\Illuminate\Cache\CacheManager
     *
     * @throws \Exception
     */
    function cache()
    {
        $arguments = func_get_args();

        if (empty($arguments)) {
            return app('cache');
        }

        if (is_string($arguments[0])) {
            return app('cache')->get(...$arguments);
        }

        if (!is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the cache, you must pass an array of key / value pairs.'
            );
        }

        return app('cache')->put(key($arguments[0]), reset($arguments[0]), $arguments[1] ?? null);
    }
}

if (!function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null $key
     * @param  mixed $default
     * @return mixed|\Illuminate\Config\Repository
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            return app('config')->set($key);
        }

        return app('config')->get($key, $default);
    }
}

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->configPath($path);
    }
}

if (!function_exists('cookie')) {
    /**
     * Create a new cookie instance.
     *
     * @param  string|null $name
     * @param  string|null $value
     * @param  int $minutes
     * @param  string|null $path
     * @param  string|null $domain
     * @param  bool|null $secure
     * @param  bool $httpOnly
     * @param  bool $raw
     * @param  string|null $sameSite
     * @return \Illuminate\Cookie\CookieJar|\Symfony\Component\HttpFoundation\Cookie
     */
    function cookie($name = null, $value = null, $minutes = 0, $path = null, $domain = null, $secure = null, $httpOnly = true, $raw = false, $sameSite = null)
    {
        $cookie = app(CookieFactory::class);

        if (is_null($name)) {
            return $cookie;
        }

        return $cookie->make($name, $value, $minutes, $path, $domain, $secure, $httpOnly, $raw, $sameSite);
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function csrf_field()
    {
        return new HtmlString('<input type="hidden" name="_token" value="' . csrf_token() . '">');
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Get the CSRF token value.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    function csrf_token()
    {
        $session = app('session');

        if (isset($session)) {
            return $session->token();
        }

        throw new RuntimeException('Application session store not set.');
    }
}

if (!function_exists('database_path')) {
    /**
     * Get the database path.
     *
     * @param  string $path
     * @return string
     */
    function database_path($path = '')
    {
        return app()->databasePath($path);
    }
}

if (!function_exists('decrypt')) {
    /**
     * Decrypt the given value.
     *
     * @param  string $value
     * @param  bool $unserialize
     * @return mixed
     */
    function decrypt($value, $unserialize = true)
    {
        return app('encrypter')->decrypt($value, $unserialize);
    }
}

if (!function_exists('dispatch')) {
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed $job
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    function dispatch($job)
    {
        return $job instanceof Closure
            ? new PendingClosureDispatch(CallQueuedClosure::create($job))
            : new PendingDispatch($job);
    }
}

if (!function_exists('dispatch_sync')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * Queueable jobs will be dispatched to the "sync" queue.
     *
     * @param  mixed $job
     * @param  mixed $handler
     * @return mixed
     */
    function dispatch_sync($job, $handler = null)
    {
        return app(Dispatcher::class)->dispatchSync($job, $handler);
    }
}

if (!function_exists('dispatch_now')) {
    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed $job
     * @param  mixed $handler
     * @return mixed
     *
     * @deprecated Will be removed in a future Laravel version.
     */
    function dispatch_now($job, $handler = null)
    {
        return app(Dispatcher::class)->dispatchNow($job, $handler);
    }
}

if (!function_exists('encrypt')) {
    /**
     * Encrypt the given value.
     *
     * @param  mixed $value
     * @param  bool $serialize
     * @return string
     */
    function encrypt($value, $serialize = true)
    {
        return app('encrypter')->encrypt($value, $serialize);
    }
}

if (!function_exists('event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param  string|object $event
     * @param  mixed $payload
     * @param  bool $halt
     * @return array|null
     */
    function event(...$args)
    {
        return app('events')->dispatch(...$args);
    }
}

if (!function_exists('info')) {
    /**
     * Write some information to the log.
     *
     * @param  string $message
     * @param  array $context
     * @return void
     */
    function info($message, $context = [])
    {
        app('log')->info($message, $context);
    }
}

if (!function_exists('logger')) {
    /**
     * Log a debug message to the logs.
     *
     * @param  string|null $message
     * @param  array $context
     * @return \Illuminate\Log\LogManager|null
     */
    function logger($message = null, array $context = [])
    {
        if (is_null($message)) {
            return app('log');
        }

        return app('log')->debug($message, $context);
    }
}

if (!function_exists('logs')) {
    /**
     * Get a log driver instance.
     *
     * @param  string|null $driver
     * @return \Illuminate\Log\LogManager|\Psr\Log\LoggerInterface
     */
    function logs($driver = null)
    {
        return $driver ? app('log')->driver($driver) : app('log');
    }
}

if (!function_exists('method_field')) {
    /**
     * Generate a form field to spoof the HTTP verb used by forms.
     *
     * @param  string $method
     * @return \Illuminate\Support\HtmlString
     */
    function method_field($method)
    {
        return new HtmlString('<input type="hidden" name="_method" value="' . $method . '">');
    }
}

if (!function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string $path
     * @param  string $manifestDirectory
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    function mix($path, $manifestDirectory = '')
    {
        return app(Mix::class)(...func_get_args());
    }
}

if (!function_exists('now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function now($tz = null)
    {
        return Date::now($tz);
    }
}

if (!function_exists('old')) {
    /**
     * Retrieve an old input item.
     *
     * @param  string|null $key
     * @param  mixed $default
     * @return mixed
     */
    function old($key = null, $default = null)
    {
        return app('request')->old($key, $default);
    }
}

if (!function_exists('policy')) {
    /**
     * Get a policy instance for a given class.
     *
     * @param  object|string $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    function policy($class)
    {
        return app(Gate::class)->getPolicyFor($class);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
    function public_path($path = '')
    {
        return app()->make('path.public') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (!function_exists('redirect')) {
    /**
     * Get an instance of the redirector.
     *
     * @param  string|null $to
     * @param  int $status
     * @param  array $headers
     * @param  bool|null $secure
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return app('redirect');
        }

        return app('redirect')->to($to, $status, $headers, $secure);
    }
}

if (!function_exists('report')) {
    /**
     * Report an exception.
     *
     * @param  \Throwable|string $exception
     * @return void
     */
    function report($exception)
    {
        if (is_string($exception)) {
            $exception = new Exception($exception);
        }

        app(ExceptionHandler::class)->report($exception);
    }
}

if (!function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  array|string|null $key
     * @param  mixed $default
     * @return \Illuminate\Http\Request|string|array|null
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        if (is_array($key)) {
            return app('request')->only($key);
        }

        $value = app('request')->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('rescue')) {
    /**
     * Catch a potential exception and return a default value.
     *
     * @param  callable $callback
     * @param  mixed $rescue
     * @param  bool $report
     * @return mixed
     */
    function rescue(callable $callback, $rescue = null, $report = true)
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            if ($report) {
                report($e);
            }

            return value($rescue, $e);
        }
    }
}

if (!function_exists('resolve')) {
    /**
     * Resolve a service from the container.
     *
     * @param  string $name
     * @param  array $parameters
     * @return mixed
     */
    function resolve($name, array $parameters = [])
    {
        return app($name, $parameters);
    }
}

if (!function_exists('resource_path')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string $path
     * @return string
     */
    function resource_path($path = '')
    {
        return app()->resourcePath($path);
    }
}

if (!function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     * @param  \Illuminate\Contracts\View\View|string|array|null $content
     * @param  int $status
     * @param  array $headers
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    function response($content = '', $status = 200, array $headers = [])
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content, $status, $headers);
    }
}

if (!function_exists('route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string $name
     * @param  mixed $parameters
     * @param  bool $absolute
     * @return string
     */
    function route($name, $parameters = [], $absolute = true)
    {
        return app('url')->route($name, $parameters, $absolute);
    }
}

if (!function_exists('secure_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string $path
     * @return string
     */
    function secure_asset($path)
    {
        return asset($path, true);
    }
}

if (!function_exists('secure_url')) {
    /**
     * Generate a HTTPS url for the application.
     *
     * @param  string $path
     * @param  mixed $parameters
     * @return string
     */
    function secure_url($path, $parameters = [])
    {
        return url($path, $parameters, true);
    }
}

if (!function_exists('session')) {
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null $key
     * @param  mixed $default
     * @return mixed|\Illuminate\Session\Store|\Illuminate\Session\SessionManager
     */
    function session($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('session');
        }

        if (is_array($key)) {
            return app('session')->put($key);
        }

        return app('session')->get($key, $default);
    }
}

if (!function_exists('storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string $path
     * @return string
     */
    function storage_path($path = '')
    {
        return app('path.storage') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('today')) {
    /**
     * Create a new Carbon instance for the current date.
     *
     * @param  \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function today($tz = null)
    {
        return Date::today($tz);
    }
}

if (!function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string|null $key
     * @param  array $replace
     * @param  string|null $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return app('translator');
        }

        return app('translator')->get($key, $replace, $locale);
    }
}

if (!function_exists('trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string $key
     * @param  \Countable|int|array $number
     * @param  array $replace
     * @param  string|null $locale
     * @return string
     */
    function trans_choice($key, $number, array $replace = [], $locale = null)
    {
        return app('translator')->choice($key, $number, $replace, $locale);
    }
}

if (!function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string|null $key
     * @param  array $replace
     * @param  string|null $locale
     * @return string|array|null
     */
    function __($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return $key;
        }

        return trans($key, $replace, $locale);
    }
}

if (!function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string|null $path
     * @param  mixed $parameters
     * @param  bool|null $secure
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return app(UrlGenerator::class);
        }

        return app(UrlGenerator::class)->to($path, $parameters, $secure);
    }
}

if (!function_exists('validator')) {
    /**
     * Create a new Validator instance.
     *
     * @param  array $data
     * @param  array $rules
     * @param  array $messages
     * @param  array $customAttributes
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Contracts\Validation\Factory
     */
    function validator(array $data = [], array $rules = [], array $messages = [], array $customAttributes = [])
    {
        $factory = app(ValidationFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($data, $rules, $messages, $customAttributes);
    }
}

if (!function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array $data
     * @param  array $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }

    if (!function_exists('my_date')) {
        function my_date($date)
        {
            $date = explode('-', $date);
            require_once('jdf.php');
            $date = jalali_to_gregorian($date[0], $date[1], $date[2], '-');
            return $date;
        }
    }

    if (!function_exists('my_jdate')) {
        function my_jdate($date, $type)
        {
            $timestamp = (strtotime($date));
            require_once('jdf.php');
            $jalali_date = jdate($type, $timestamp);
            return $jalali_date;
        }
    }
    if (!function_exists('set_address_file')) {
        function set_address_file($file, $opportunity, $menu_name)
        {
            if ($opportunity->type->set_f == 'yes') {
                $opp_type_code = 'F' . $opportunity->type->folder_code;
            } else {
                $opp_type_code = $opportunity->type->folder_code;

            }
            $date = explode('/', $file->request_date);
            $date = $date[0] . $date[1] . $date[2];
            if ($file->type_relation != 'other') {
                $file_type = $file->for . ' To ' . $file->to;
            } else {
                $file_type = $file->folder_name;
            }

            $address = 'Files/' . $menu_name . '/' . $opportunity->year . '/' . $opp_type_code . '/' . $opportunity->project_code . '(' . $opportunity->folder_name . ')/' . $file_type . '/' . $date . '/' . $file->id . '/';
            return $address;
        }
    }
}
