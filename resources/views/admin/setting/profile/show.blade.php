@extends('layouts.admin',['file_upload'=>true])

@section('content')
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-lg-12">
                        <div class="tab-menu-heading hremp-tabs p-0 ">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class="mr-4"><a href="#tab1" class="active" data-toggle="tab">پروفایل </a>
                                    </li>
                                    @can('profile_edit')
                                    <li class="mr-4"><a href="#tab2" data-toggle="tab">ویرایش پروفایل </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="card-body">
                                        <div class="form-group ">
                                            <div class="row">
                                                @if($item->employee && $item->employee->pic)
                                                    <div class="col-md-12 text-center mb-5">
                                                        <img src="{{url($item->employee->pic)}}" style="height: 150px;object-fit: contain"
                                                             alt="{{$item->name}}">
                                                    </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <p>
                                                        <strong>نام  : </strong>
                                                        <span>{{$item->name?$item->name:'ثبت نشده'}}</span>
                                                    </p>
                                                    <hr/>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>
                                                        <strong>نام کاربری : </strong>
                                                        <span>{{$item->username?$item->username:'ثبت نشده'}}</span>
                                                    </p>
                                                    <hr/>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>
                                                        <strong>وضعیت پنل : </strong>
                                                        <span>{!! status($item->status) !!}
                                                            @if($item->status=='blocked' && $item->info_blocked)
                                                                ({{$item->info_blocked}})
                                                            @endif
                                                        </span>
                                                    </p>
                                                    <hr/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @can('profile_edit')
                                <div class="tab-pane" id="tab2">
                                    <div class="card-body">
                                        {{ Form::model($item,array('route' => array('admin.profile.update',$item->id), 'method' => 'PATCH','id'=>'form_req','files'=>true)) }}
                                        {{Form::hidden('id', $item->id)}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('username', 'نام کاربری *')}}
                                                    {{Form::text('username', null, array('class' => 'form-control d-ltr text-left','required','readonly'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('password', 'رمز عبور')}}
                                                    {{Form::password('password', array('class' => 'form-control d-ltr text-left'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('password_confirmation', 'تکرار رمز عبور')}}
                                                    {{Form::password('password_confirmation', array('class' => 'form-control d-ltr text-left  '))}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('photo', 'تصویر ')}}
                                                    {{Form::file('photo', array('class' => 'dropify','data-height'=>'180','accept' => '.jpg,.jpeg,.png','data-default-file'=>$item->photo && is_file($item->photo->path)?url($item->photo->path):null))}}
                                                </div>
                                                <p class="text-danger">_<small>حداکثر حجم تصویر 2Mb می باشد</small></p>
                                                <p class="text-danger">_<small>بهترین سایز تصویر عرض 120 پیکسل در ارتفاع 150 پیکسل می باشد</small></p>
                                                <p class="text-danger">_<small>فرمت تصویر فقط باید PNG,JPG,JPEG باشد</small></p>
                                            </div>
                                            <div class="col-md-12 text-left">
                                                <hr/>
                                                {{Form::submit('ویرایش',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمئن هستید؟')"))}}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row-->
            </div>
        </div>
    </div>
@endsection()


