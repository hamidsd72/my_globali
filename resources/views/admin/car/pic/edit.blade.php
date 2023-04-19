@extends('layouts.admin',['req'=>true,'file_upload'=>true])

@section('content')
    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="card-title">
                        {{$title}}
                    </h4>
                </div>

                <div class="card-body">
                    {{ Form::model($item,array('route' => array('admin.car-pic.update',$item->id),'id'=>'form_req', 'method' => 'PATCH','files'=>true)) }}
                    {{Form::hidden('id', $item->id)}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{Form::label('brand', 'برند *')}}
                                <select name="brand" class="form-control select2-show-search brand-select" data-placeholder="انتخاب کنید" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($brands as $key=>$brand)
                                        <option value="{{$key}}" {{$item->brand==$key?'selected':''}}>{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 brand_set_car">
                            <div class="form-group">
                                {{Form::label('model', 'مدل خودرو *')}}
                                <select name="model" class="form-control select2-show-search model-select" data-placeholder="انتخاب کنید" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($models as $brand=>$b)
                                        @foreach($models[$brand] as $model=>$m)
                                            <option value="{{$model}}" {{$item->model==$model?'selected':''}} class="all_brand brand_{{$brand}}">{{$model}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 model_set_car">
                            <div class="form-group">
                                {{Form::label('year', 'سال تولید *')}}
                                <select name="year" class = "form-control select2-show-search year-select" data-placeholder="انتخاب کنید" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($years as $brand=>$b)
                                        @foreach($years[$brand] as $model=>$m)
                                            @foreach($years[$brand][$model] as $year=>$y)
                                                <option value="{{$year}}" {{$item->year==$year?'selected':''}}
                                                        class="all_brand_model brand_{{$brand}}_model_{{$model}}">{{$year}}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 model_set_car">
                            <div class="form-group">
                                {{Form::label('motor', 'حجم موتور *')}}
                                <select name="motor" class = "form-control select2-show-search motor-select" data-placeholder="انتخاب کنید" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($motors as $brand=>$b)
                                        @foreach($motors[$brand] as $model=>$m)
                                            @foreach($motors[$brand][$model] as $year=>$y)
                                                @foreach($motors[$brand][$model][$year] as $motor=>$y)
                                                    <option value="{{$motor}}" {{$item->motor==$motor?'selected':''}}
                                                            class="all_brand_model all_brand_model_year brand_{{$brand}}_model_{{$model}} brand_{{$brand}}_model_{{$model}}_year_{{$year}}">{{$motor}}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 model_set_car">
                            <div class="form-group">
                                {{Form::label('color', 'رنگ *')}}
                                <select name="color" class = "form-control select2-show-search color-select" data-placeholder="انتخاب کنید" required>
                                    <option value="">انتخاب کنید</option>
                                    @foreach($colors as $brand=>$b)
                                        @foreach($colors[$brand] as $model=>$m)
                                            @foreach($colors[$brand][$model] as $year=>$y)
                                                @foreach($colors[$brand][$model][$year] as $motor=>$y)
                                                    @foreach($colors[$brand][$model][$year][$motor] as $color=>$c)
                                                        <option value="{{$color}}" {{$item->color==$color?'selected':''}} class="all_brand_model all_brand_model_year_motor brand_{{$brand}}_model_{{$model}}  brand_{{$brand}}_model_{{$model}}_year_{{$year}} brand_{{$brand}}_model_{{$model}}_year_{{$year}}_motor_{{$motor}}">{{$color}}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('photo', 'تصویر ')}}
                                {{Form::file('photo', array('class' => 'dropify','data-height'=>'180','accept' => '.jpg,.jpeg,.png','data-default-file'=>$item->photo && is_file($item->photo->path)?url($item->photo->path):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 2Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر عرض 600 پیکسل در ارتفاع 400 پیکسل می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید PNG,JPG,JPEG باشد</small></p>
                        </div>

                        <div class="col-md-12 text-left">
                            <hr/>
                            {{Form::submit('ویرایش',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمئن هستید؟')"))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection
@push('in_tag_script')
    <script type="text/javascript">
        // car pic
        $('.brand-select').on('change',function (){
            var brand=$(this).val()
            $('.model-select').val('')
            if(brand==null || brand=='')
            {
                $('.brand_set_car').addClass('d-none')
            }
            else{
                $('.all_brand').prop("disabled", true);
                $('.brand_'+brand).prop("disabled", false);

                $('.model-select').trigger('change')
                $('.brand_set_car').removeClass('d-none')
            }
        })

        $('.model-select').on('change',function (){
            var brand=$('.brand-select').val()
            var model=$(this).val()
            $('.year-select').val('')
            $('.motor-select').val('')
            $('.color-select').val('')
            if(model==null || model=='')
            {
                $('.model_set_car').addClass('d-none')
            }
            else
            {
                $('.all_brand_model').prop("disabled", true);
                $('.brand_'+brand+'_model_'+model).prop("disabled", false);

                $('.year-select').trigger('change')
                $('.motor-select').trigger('change')
                $('.color-select').trigger('change')
                $('.model_set_car').removeClass('d-none')
            }
        })
        
    </script>
@endpush