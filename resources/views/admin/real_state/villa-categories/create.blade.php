@extends('layouts.admin',['req'=>true,'file_upload'=>true])
@section('styles')
@endsection
@section('content')
    <div class="row mt-5" style="font-size: 14px">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="card-title">
                        {{$title}} افزودن
                    </h4>
                </div>

                <div class="card-body ">

                    {{Form::open(array('route' => array('admin.villa-category-store'), 'method' => 'POST','files'=>true)) }}
                    <div class="row">
                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>All information</h2>
                        </div>
                        <input type="hidden" name="type" value="villa">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('name_fa', 'نام پروژه *')}}
                                {{Form::text('name_fa', '', array('class' => 'form-control','required'))}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('status_fa', 'وضعیت') }}
                                {{ Form::select('status_fa', array('active' => 'فعال', 'pending' => 'پیش نمایش'), null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{Form::label('country_name', '   کشور')}}
                                <select name="country_name" id="country_select" class="form-control select2-show-search custom-select" onchange="setCity(this.value)"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('city_name', '   شهر')}}
                                <select name="city_name" id="city_select" class="form-control select2-show-search custom-select"></select>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('address_fa', ' آدرس  *')}}
                                {{Form::text('address_fa','', array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('brief_fa ', ' توضیحات کوتاه  *')}}
                                {{Form::textarea('brief_fa','', array('class' => 'form-control','rows'=>3))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('description_fa ', '    توضیحات  *')}}
                                {{Form::textarea('description_fa','', array('class' => 'form-control textarea'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('p_option_fa ', ' گزینه های قیمت گذاری ')}}
                                {{Form::textarea('p_option_fa', '', array('class' => 'form-control textarea'))}}
                            </div>
                        </div>

                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>جزئیات بالای صفحه</h2>
                        </div>
                        {{-- <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(city)شهر</label>
                                <select name="city_id" id="city_id" class="form-control form-control-lg city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"> {{$city->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(type)نوع ملک</label>
                                <select name="type_id" class="form-control form-control-lg">
                                    @foreach($types as $key=>$type)
                                        <option value="{{$key}}"> {{$type}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('price', '    (price) قیمت ')}}
                                {{Form::number('price', null, array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('discount', 'درصد تخفیف روی پروژه')}}
                                {{Form::number('discount', null, array('class' => 'form-control discount'))}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('discount', 'مبلغ نهایی بعد با تخفیف')}}
                                {{Form::number('discount_price', null, array('class' => 'form-control discount_price'))}}
                            </div>
                        </div>
                        
                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>جزئیات عمومی</h2>
                        </div>
                        @foreach($feature as $ff)
                            @if($ff->type=='number')
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    {{Form::label('feature_id_'.$ff->id, $ff->title_fa)}}
                                    {{Form::number('feature_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                </div>
                            </div>

                            @elseif($ff->type=='text')
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title_fa." - فارسی")}}
                                        {{Form::text('feature_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_en_id_'.$ff->id, $ff->title_fa." - انگلیسی")}}
                                        {{Form::text('feature_en_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                    </div>
                                </div>

                            @else
                                <div class="col-lg-4 col-md-3 col-sm-7 col-8">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title_fa)}}
                                        {{Form::select('feature_id_'.$ff->id, ['no'=>'خیر','yes'=>'بلی'], null , array('class' => 'form-control'))}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-12"></div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(for)برای</label>
                                <select name="rent" class="form-control form-control-lg">
                                    <option value="0">(sell)فروش</option>
                                    <option value="1">(rent)اجاره</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Status of project</label>
                                <select name="project_status" class="form-control form-control-lg">
                                    <option value="0">finished</option>
                                    <option value="1">Under Construction</option>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2> (location information)اطلاعات مکانی</h2>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('iframe_map', ' (map)نقشه ')}}
                                {{Form::textarea('iframe_map', null,array('class' => 'form-control ','dir' => 'ltr','rows'=>3 , 'required'))}}
                            </div>
                        </div>
                        <div class="col-md-12 my-4">
                            <div class="form-group">
                                {{Form::label('pic', ' (featuring image)تصویر شاخص ')}}
                                {{Form::file('pic', array('class' => 'dropify' , 'required'))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 4Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر عرض 1100 پیکسل در ارتفاع 280 پیکسل می باشد</small></p>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('gallery', ' (Album)گالری ')}}
                                {{Form::file('gallery[]', array('class' => 'dropify' , 'multiple' ))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 4Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر عرض 1100 پیکسل در ارتفاع 280 پیکسل می باشد</small></p>
                        </div>

                        {{-- <div class="col-12 py-5">توضیحات متا</div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('page_name_meta', 'آدرس') }}
                            <input type="text" class="form-control" value="{{old('page_name_meta')}}" name="page_name_meta">
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('page_title_meta', 'عنوان') }}
                            <input type="text" class="form-control" name="page_title_meta"  value="{{old('page_title_meta')}}">
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('description_meta', 'توضیحات') }}
                            <textarea class="form-control" name="description_meta">{{old('description_meta')}}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('keyword_meta', 'کلمات کلیدی') }}
                            <input type="text" class="form-control" name="keyword_meta" value="{{old('keyword_meta')}}" />
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('priority_meta', 'رتبه بندی') }}
                            <input type="text" class="form-control" name="priority_meta" value="{{old('priority_meta')}}" />
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('schima', 'اسکیما') }}
                            <input type="text" class="form-control" name="schima" value="{{old('schima')}}" />
                        </div> --}}

                        <div class="col-md-12 text-left">
                            <hr/>
                            {{Form::submit('(Save)ذخیره',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمئن هستید؟')"))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('in_tag_script')
    <script >
        @if(isset($cities))
            let cities = @json($cities);
            city_list  = document.querySelector('#city_select');
            function setCity(countryName) {
                let cities_list = cities[countryName]
                console.log(cities_list, countryName)
                city_list.innerHTML = '';
                cities_list.forEach(city => {
                    var option          = document.createElement('option');
                    if (city_list) {
                        option.textContent  = city;
                        option.value        = city;
                        city_list.append(option);
                    }
                });
            }
            setCity('Afghanistan');
        @endif
    </script>
@endpush