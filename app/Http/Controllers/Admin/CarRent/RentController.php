<?php

namespace App\Http\Controllers\Admin\CarRent;

use App\Models\CarRentList;
use App\Models\CarRentOptionList;
use App\Models\Car;
use App\Models\CarMessage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use settingbon\settingbon;

class RentController extends Controller
{
    public function controller_title($type)
    {
        switch ($type)
        {
            case 'index':
                return 'درخواست کرایه خودرو';
                break;
            case 'show':
                return 'مشاهده درخواست';
                break;
            case 'message':
                return 'فرم درخواست کرایه خودرو';
                break;
            case 'url_back':
                return route('admin.car.rent.index');
                break;
            default:
                return '';
                break;
        }
    }
    public function __construct()
    {
        $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api', ['only' => ['index']]);
        $this->middleware('permission:car_rent_col', ['only' => ['index_colleague']]);
        $this->middleware('permission:car_rent_message', ['only' => ['message']]);
        $this->middleware('permission:car_rent_list|car_rent_success|car_rent_success_rent|car_rent_danger|car_rent_api|car_rent_col', ['only' => ['show']]);
    }

    public function index($status,$status_record,$status_reserve='no')
    {
        $title=null;
        if($status=='all' && $status_record=='all' && $status_reserve=='all')
        {
            $items=CarRentList::orderByDesc('id');
                if(Auth::user()->can('car_rent_me'))
                {
                    if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                        $items=$items->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $items=$items->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $items=$items->whereIN('car_system_id',$car_id);
                    }
                }
            $items=$items->get();
            
        }
        else
        {
            $items=CarRentList::orderByDesc('id');
        if($status=='active')
            {
                $items=$items->where('car_type','company')->where('status',$status)->where('status_reserve',$status_reserve)->where('status_record',$status_record);
                
                $title=$status_reserve=='yes'?'موفق در اجاره':'موفق';
            }
        elseif($status=='all')
            {
                $items=$items->whereIN('status',['active','pending','blocked'])->where('status_record',$status_record);
                 $title='api';
            }
        else
            {
                $items=$items->where('car_type','company')->where('status','!=','active')->where('status_record',$status_record);
                 $title='ناموفق';
            }

        if(Auth::user()->can('car_rent_me'))
                {
                    if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                        $items=$items->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $items=$items->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $items=$items->whereIN('car_system_id',$car_id);
                    }
                }
        $items=$items->get();
        }

        return view('admin.car_rent.rent.index', compact('items','status','title'), ['title' => $this->controller_title('index').$title]);
    }
    public function index_colleague()
    {
        $items=CarRentList::orderByDesc('id')->where('car_type','colleague');
        if(Auth::user()->can('car_rent_me'))
                {
                    if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                        $items=$items->where('customer_system_id',auth()->id());
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                        $items=$items->where('user_api_id',auth()->id());
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car_id=Car::where('type','colleague')->where('colleague_id',auth()->id())->select('id')->get()->toArray();
                        $items=$items->whereIN('car_system_id',$car_id);
                    }
                }
        $items=$items->get();
        
        $title=' همکار ';
        $status='all';
        return view('admin.car_rent.rent.index', compact('items','status','title'), ['title' => $this->controller_title('index').$title]);
    }
    public function show($id)
    {
        $item=CarRentList::findOrFail($id);
        if(auth()->user()->can('car_rent_me'))
        {
             if(Auth::user()->hasRole('User') || Auth::user()->hasRole('UserAgent'))
                    {
                         if($item->customer_system_id!=auth()->id())
                        {
                            abort(404);
                        }
                    }
                    elseif(Auth::user()->hasRole('UserApi'))
                    {
                         if($item->user_api_id!=auth()->id())
                        {
                            abort(404);
                        }
                    }
                     elseif(Auth::user()->hasRole('Colleague'))
                    {
                        $car=Car::where('type','colleague')->where('colleague_id',auth()->id())->where('id',$item->car_system_id)->first();
                        if(!$car)
                        {
                             abort(404);
                        }
                    }
           
        }
      
        return view('admin.car_rent.rent.show', compact('item'), ['title' => $this->controller_title('show')]);
    }
    public function message()
    {
        $items=CarMessage::orderByDesc('id')->get();
        return view('admin.car_rent.message', compact('items'), ['title' => $this->controller_title('message')]);
    }


}
