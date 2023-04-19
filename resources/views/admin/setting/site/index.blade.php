@extends('layouts.admin',['tbl'=>true])

@section('content')
<style>
    .box_sh
    {
        box-shadow:0 0 2px 0 #66666650;
        border-radius:3px;
    }
    .box_sh label
    {
        font-size: 12px;
    }
</style>
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="w-100">
                        {{$title}}
                    </h4>
                </div>

                <div class="card-body">
                    {{-- <div class="box_sh container-fluid p-3 mb-3">
                        <form class="row" action="{{route('admin.setting.percent',$items[0]->id)}}" method="post">
                            @csrf
                            <div class="col-12">
                                <h5>درصد تخفیف/درصد بیمه/لیر به تومان</h5>
                                <hr/>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>مقدار درصد تخفیف</label>
                                    <input type="number" class="form-control d-ltr text-left" name="percent" value="{{$items[0]->percent}}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>مقدار درصد بیمه</label>
                                    <input type="number" class="form-control d-ltr text-left" name="percent_bimeh" value="{{$items[0]->percent_bimeh}}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>مقدار درصد پیش پرداخت</label>
                                    <input type="number" class="form-control d-ltr text-left" name="prepayment" value="{{$items[0]->prepayment}}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>قیمت هر لیر به تومان</label>
                                    <input type="number" class="form-control d-ltr text-left" name="rial" value="{{$items[0]->rial}}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>هزینه تحویل خودرو(لیر)</label>
                                    <input type="number" class="form-control d-ltr text-left" name="delivery_car" value="{{$items[0]->delivery_car}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>ایمیل ارسالی</label>
                                    <input type="email" class="form-control d-ltr text-left" name="email" value="{{$items[0]->email}}">
                                </div>
                            </div>
                              <div class="col-md-12 pt-3 text-left">
                                <button type="submit" class="btn btn-info">ثبت</button>
                            </div>
                        </form>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="tbl_1">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">ردیف</th>
                                <th class="border-bottom-0">عنوان</th>
                                <th class="border-bottom-0">لوگو</th>
                                <th class="border-bottom-0">آیکون</th>
                                @can('setting_edit')
                                <th class="border-bottom-0">عملیات</th>
                                    @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        @if($item->logo && is_file($item->logo->path))
                                            <img src="{{url($item->logo->path)}}" height="100px">
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->icon && is_file($item->icon->path))
                                            <img src="{{url($item->icon->path)}}" height="100px">
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>
                                    @can('setting_edit')
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('admin.setting.edit',$item->id)}}"
                                               class="action-btns1">
                                                <i class="feather feather-edit-2  text-success"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="ویرایش"></i>
                                            </a>
                                        </div>
                                    </td>
                                        @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
