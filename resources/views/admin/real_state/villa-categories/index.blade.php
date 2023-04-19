@extends('layouts.admin',['tbl'=>true])

@section('content')
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="w-100">
                        {{$title}}
                        <a href="{{route('admin.villa-category-create')}}" class="btn btn-primary float-left">افزودن</a>
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom " id="tbl_1">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">ردیف</th>
                                <th class="border-bottom-0">عنوان</th>

                                <th class="border-bottom-0"> عکس</th>
                                <th class="border-bottom-0">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name_fa}}
                                        @if($row->show_in_index == 'yes')
                                            <br>
                                            <span class="badge badge-info">نمایش در صفحه اصلی</span>
                                        @endif
                                    </td>
                                   
                                    <td><img src="{{asset($row->pic)}}" class="img img-thumbnail" alt=""></td>
                                    <td>
                                        <div class="d-flex">
{{--                                            <a href="" class="btn btn-sm btn-primary">--}}
{{--                                                <i class="feather   text-success"--}}
{{--                                                   data-toggle="tooltip" data-placement="top"--}}
{{--                                                   title="واحد"></i>--}}
{{--                                                واحد--}}
{{--                                            </a>--}}
                                            <a href="{{route('admin.villa-category-edit',$row->id)}}" class="action-btns1">
                                                <i class="feather feather-edit-2  text-success"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="ویرایش"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.villa-category-destroy', $row->id] ]) !!}
                                            <button class="action-btns1" data-toggle="tooltip"
                                                    data-placement="top" title="حذف"
                                                    onclick="return confirm('برای حذف مطمئن هستید؟')">
                                                <i class="feather feather-trash-2 text-danger"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>


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
