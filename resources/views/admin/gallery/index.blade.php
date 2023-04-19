@extends('layouts.admin',['tbl'=>true])

@section('content')
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="w-100">
                        {{$title}}
                        @can('gallery_create')
                        <a href="{{route('admin.gallery.create')}}" class="btn btn-primary float-left">افزودن</a>
                        @endcan
                    </h4>
                </div>

                <div class="card-body">
                    <div class="col-12 text-center alert alert-info">
                        تعداد نمایش در صفحه اصلی 6 مورد می باشد که برای صفحه اصلی فعال شده اند(بر اساس ستون سورت 6 مورد اول)
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="tbl_1">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">ردیف</th>
                                <th class="border-bottom-0">عنوان</th>
                                @can('gallery_status')
                                <th class="border-bottom-0">صفحه اصلی</th>
                                @endcan
                                 @can('gallery_sort')
                                <th class="border-bottom-0">مرتب سازی</th>
                                @endcan
                                @canany(['gallery_edit','gallery_delete'])
                                <th class="border-bottom-0">عملیات</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <p @if(mb_strlen($item->title)>30) data-toggle="tooltip"
                                           data-placement="top" title="{{$item->title}}" @endif>
                                            {{mb_substr($item->title,0,30)}} {{mb_strlen($item->title)>30?'...':''}}
                                        </p>

                                    </td>
                                     @can('gallery_status')
                                    <td>
                                        @if($item->status_home=='active')
                                            <span class="text-success ml-2">انتشار</span>
                                            <a href="{{route('admin.gallery.status',[$item->id,'status_home','pending'])}}">
                                                <i class="fa fa-close text-danger"></i>
                                            </a>
                                        @else
                                            <span class="text-danger ml-2">عدم انتشار</span>
                                            <a href="{{route('admin.gallery.status',[$item->id,'status_home','active'])}}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                        @endif
                                    </td>
                                    @endcan
                                    @can('gallery_sort')
                                    <td>
                                        <form action="{{route('admin.gallery.sort',$item->id)}}" method="post">
                                            @csrf
                                            <input type="number" name="sort" value="{{$item->sort}}"
                                                   class="form-control w-50px text-center"
                                                   onchange="return this.form.submit()">
                                        </form>
                                    </td>
                                    @endcan
                                     @canany(['gallery_edit','gallery_delete'])
                                    <td>
                                        <div class="d-flex">
                                                @can('gallery_edit')
                                            <a href="{{route('admin.gallery.edit',$item->id)}}"
                                               class="action-btns1">
                                                <i class="feather feather-edit-2  text-success"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="ویرایش"></i>
                                            </a>
                                            @endcan
                                                @can('gallery_delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.gallery.destroy', $item->id] ]) !!}
                                            <button class="action-btns1" data-toggle="tooltip"
                                                    data-placement="top" title="حذف"
                                                    onclick="return confirm('برای حذف مطمئن هستید؟')">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </button>
                                            {!! Form::close() !!}
                                            @endcan
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
