{{--{{dd($propertiesin)}}--}}
{{--{{dd($category,)}}--}}
{{--{{dd($citys , $category)}}--}}
{{--{{dd(json_decode($category->properties_in))}}--}}
{{--{{dd($cities)}}--}}
@extends('layouts.admin',['req'=>true,'file_upload'=>true])

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/js/leaflet/leaflet.css') }}">
@endsection

@section('content')
    <div class="row mt-5" style="font-size: 14px">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="card-title">
                        {{$title}}
                    </h4>
                </div>

                <div class="card-body">

                    {{Form::open(array('route' => array('admin.villa-category-update' , $category->id ), 'method' => 'PATCH','files'=>true)) }}
                    <div class="row">
                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>All information</h2>
                        </div>
                        <input type="hidden" name="type" value="villa">

                        <div class="col-xl-12 col-md-12 col-lg-12">
                            <div class="tab-menu-heading hremp-tabs p-0 ">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li class="mr-4"><a href="#fa" class="active" data-toggle="tab">Persian</a>
                                        </li>
                                        <li class="mr-4"><a href="#en" data-toggle="tab">English</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="fa">
                                        <div class="card-body">
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            {{Form::label('name_fa', '    نام پروژه * ')}}
                                                            {{Form::text('name_fa', $category->name_fa, array('class' => 'form-control','required'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {{ Form::label('status_fa', 'وضعیت') }}
                                                            {{ Form::select('status_fa', array('active' => 'فعال', 'pending' => 'پیش نمایش'), $category->status_fa, array('class' => 'form-control')) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            {{Form::label('city_name', '   شهر')}}
                                                            {{Form::text('city_name', $category->city_name, array('class' => 'form-control'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            {{Form::label('address_fa', ' آدرس  *')}}
                                                            {{Form::text('address_fa', $category->address_fa, array('class' => 'form-control'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            {{Form::label('brief_fa ', ' توضیحات کوتاه   *')}}
                                                            {{Form::textarea('brief_fa', $category->brief_fa, array('class' => 'form-control','rows'=>3))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            {{Form::label('description_fa ', '   توضیحات  *')}}
                                                            {{Form::textarea('description_fa', $category->description_fa, array('class' => 'form-control textarea'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12" dir="ltr">
                                                        <div class="form-group">
                                                            {{Form::label('p_option_fa', 'گزینه های قیمت گذاری')}}
                                                            {{Form::textarea('p_option_fa', $category->p_option_fa, array('class' => 'form-control textarea'))}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="en">
                                        <div class="card-body" dir="ltr">
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('name_en', '   project name *')}}
                                                            {{Form::text('name_en', $category->name_en, array('class' => 'form-control','dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{ Form::label('status_en', 'status') }}
                                                            {{ Form::select('status_en', array('active' => 'active;', 'pending' => 'preview'),  $category->status_en, array('class' => 'form-control','dir' => 'ltr')) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('city_name_en', '   city')}}
                                                            {{Form::text('city_name_en', $category->city_name_en, array('class' => 'form-control','dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('address_en', '  address  *')}}
                                                            {{Form::text('address_en', $category->address_en, array('class' => 'form-control','dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('brief_en ', 'short description  *')}}
                                                            {{Form::textarea('brief_en',$category->brief_en, array('class' => 'form-control','dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('description_en', 'description *')}}
                                                            {{Form::textarea('description_en', $category->description_en, array('class' => 'form-control textarea','dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-12" dir="ltr">
                                                        <div class="form-group" style="text-align: left;">
                                                            {{Form::label('p_option_en', 'Pricing Options')}}
                                                            {{Form::textarea('p_option_en', $category->p_option_en, array('class' => 'form-control textarea' ,'dir' => 'ltr'))}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('slug', '* (slug)نامک ')}}
                                {{Form::text('slug', $category->slug, array('class' => 'form-control','required'))}}
                            </div>
                        </div>



                         <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>جزئیات بالای صفحه</h2>
                        </div>
{{--                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>(city)شهر</label>--}}
{{--                                <input type="text" name="city_id" class="form-control">--}}
{{--                                <select name="city_id" id="city_id" class="form-control form-control-lg city">--}}
{{--                                    @foreach($cities as $city)--}}
{{--                                        <option value="{{$city->id}}"> {{$city->name}} </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}


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
                                {{Form::label('price', '  (price)قیمت ')}}
                                {{Form::text('price', $category->price, array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('priceF', 'قیمت عددی')}}
                                {{Form::number('priceF', $category->priceF, array('class' => 'form-control price_f'))}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('discount', 'درصد تخفیف روی پروژه')}}
                                {{Form::number('discount', $category->discount, array('class' => 'form-control discount'))}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('discount', 'مبلغ تخفیف')}}
                                {{Form::number('discount_price', $category->discount_price, array('class' => 'form-control discount_price'))}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('show_customer_club', 'نمایش در افرها')}}
                                <select class="form-control" name="show_customer_club">
                                    <option value=""></option>
                                    <option value="yes">بلی</option>
                                    <option value="no">خیر</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('ref', 'Ref')}}
                                {{Form::text('ref', $category->ref, array('class' => 'form-control'))}}
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
                                        {{Form::number('feature_id_'.$ff->id, $category->feature_set($ff->id,$category->id), array('class' => 'form-control'))}}
                                    </div>
                                </div>

                            @elseif($ff->type=='text')
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title_fa." - فارسی")}}
                                        {{Form::text('feature_id_'.$ff->id, $category->feature_set($ff->id,$category->id), array('class' => 'form-control'))}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_en_id_'.$ff->id, $ff->title_fa." - انگلیسی")}}
                                        {{Form::text('feature_en_id_'.$ff->id, $category->feature_set_en($ff->id,$category->id), array('class' => 'form-control'))}}
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-4 col-md-3 col-sm-7 col-8">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title_fa)}}
                                        {{Form::select('feature_id_'.$ff->id, ['no'=>'خیر','yes'=>'بلی'], $category->feature_set($ff->id,$category->id) , array('class' => 'form-control'))}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
{{--                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('pot', 'Plot')}}--}}
{{--                                {{Form::text('pot', $category->pot, array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('constructed_area', 'constructed area')}}--}}
{{--                                {{Form::text('constructed_area', $category->constructed_area, array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('bedroom', 'bedroom')}}--}}
{{--                                {{Form::text('bedroom', $category->bedroom, array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('bathrooms', 'bathrooms')}}--}}
{{--                                {{Form::text('bathrooms', $category->bathrooms, array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('parking', 'parking')}}--}}
{{--                                {{Form::select('parking', ['no'=>'no','yes'=>'yes'], $category->parking , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('auto_lighting', 'Auto lighting')}}--}}
{{--                                {{Form::select('auto_lighting', ['no'=>'no','yes'=>'yes'], $category->auto_lighting , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('teras', 'Teras')}}--}}
{{--                                {{Form::select('teras', ['no'=>'no','yes'=>'yes'], $category->teras , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('pool', 'Pool')}}--}}
{{--                                {{Form::select('pool', ['no'=>'no','yes'=>'yes'], $category->pool , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('unit', 'Unit of project')}}--}}
{{--                               {{Form::text('unit',  $category->unit , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('toilet', 'Toilet')}}--}}
{{--                                {{Form::select('toilet', ['no'=>'no','yes'=>'yes'] , $category->potoiletol , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('livingroom', 'Living room')}}--}}
{{--                                {{Form::select('livingroom', ['no'=>'no','yes'=>'yes'] , $category->livingroom , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('diningroom', 'Dining room')}}--}}
{{--                                {{Form::select('diningroom', ['no'=>'no','yes'=>'yes'] , $category->diningroom , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('yearofrenovation', 'Year of renovation')}}--}}
{{--                                {{Form::text('yearofrenovation'  , $category->yearofrenovation , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('view', 'View')}}--}}
{{--                                {{Form::text('view',  $category->view , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('heating', 'Heating')}}--}}
{{--                                {{Form::text('heating', $category->heating , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('aircondition', 'Air condition')}}--}}
{{--                                {{Form::select('aircondition', ['no'=>'no','yes'=>'yes'] , $category->aircondition , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('loundryroom', 'Loundry room')}}--}}
{{--                                {{Form::select('loundryroom', ['no'=>'no','yes'=>'yes'] , $category->loundryroom , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('skitchen', 'Summer kitchen')}}--}}
{{--                                {{Form::select('skitchen', ['no'=>'no','yes'=>'yes'] , $category->skitchen , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('storageroom', 'Storage room')}}--}}
{{--                                {{Form::select('storageroom', ['no'=>'no','yes'=>'yes'] , $category->storageroom , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('barbecue', 'Barbecue')}}--}}
{{--                                {{Form::select('barbecue', ['no'=>'no','yes'=>'yes'], $category->barbecue , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('fireplace', 'Fireplace')}}--}}
{{--                                {{Form::select('fireplace', ['no'=>'no','yes'=>'yes'] , $category->fireplace , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('orientation', 'Orientation')}}--}}
{{--                                {{Form::text('orientation', $category->orientation , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('terraintype', 'Terrain type')}}--}}
{{--                                {{Form::text('terraintype', $category->terraintype , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('dis_sea', 'Distance to sea')}}--}}
{{--                                {{Form::text('dis_sea', $category->dis_sea , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('dis_center', 'Distance to center')}}--}}
{{--                                {{Form::text('dis_center', $category->dis_center , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-md-3 col-sm-7 col-8">--}}
{{--                            <div class="form-group">--}}
{{--                                {{Form::label('restaurant', 'Restaurant')}}--}}
{{--                                {{Form::text('restaurant',  $category->restaurant , array('class' => 'form-control'))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-12"></div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(for)برای</label>
                                <select name="rent" class="form-control form-control-lg">
                                    <option value="0" {{ $category->rent == '0' ? 'selected' : '' }}>(sell)فروش</option>
                                    <option value="1" {{$category->rent == '1' ? 'selected' :''}}>(rent)اجاره</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Status of project</label>
                                <select name="project_status" class="form-control form-control-lg">
                                    <option value="0" {{ $category->project_status == '0' ? 'selected' : '' }}>finished</option>
                                    <option value="1" {{ $category->project_status == '1' ? 'selected' : '' }}>Under Construction</option>
                                    
                                </select>
                            </div>
                        </div>

                        



                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2> (location information)اطلاعات مکانی</h2>
                        </div>
{{--                        <div class="col-12 mt-3 px-3 bg-blue-lightest py-4 mb-8">--}}
{{--                            --}}
{{--                            <div id="map" class="col-12 mb-6 map min-h-400px">--}}

{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="row col-md-12 col-lg-12 col-12 mb-6">--}}
{{--                                    <label for="addr" class="form-label">Address</label>--}}
{{--                                    <div class="col-lg-12 col-md-12 col-sm-12 align-self-center">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <button type="button" class="btn btn-primary" onclick="addr_search();" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">Search</button>--}}
{{--                                            </div>--}}
{{--                                            <input type="text" id="addr" name="address"  class="form-control form-control-solid" data-kt-autosize="true">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mt-3" id="address-result"></div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 mb-6">--}}
{{--                                    <label for="lat" class="form-label">Latitude</label>--}}
{{--                                    <input class="form-control form-control form-control-solid" id="lat"  name="latitude"  value="{{ $category->latitude }}" data-kt-autosize="true">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 mb-6">--}}
{{--                                    <label for="lon" class="form-label">Longitude</label>--}}
{{--                                    <input class="form-control form-control form-control-solid" id="lon"  name="longitude"  value="{{ $category->longitude }}" data-kt-autosize="true">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        {!! $category->iframe_map !!}

                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('iframe_map', ' (map)نقشه ')}}
                                {{Form::textarea('iframe_map',$category->iframe_map,array('class' => 'form-control','dir' => 'ltr','rows'=>3 , 'required'))}}
                            </div>
                        </div>


                {{--        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="demo-example modal-example w-100">
                                <label for="modal-example"> &#1575;&#1605;&#1705;&#1575;&#1606;&#1575;&#1578;</label>
                                <select id="modal-example1" name="properties_in[]'" multiple>
                                    @if(count($propertiesin) > 0)
                                    @foreach($propertiesin as $row)
                                        @if(isset($category->properties_in))
                                        <option value="{{$row->id}}"  @if($category->properties_in != 'null') {{in_array($row->id,json_decode($category->properties_in)) ? 'selected' : ''}} @endif >{{$row->name_fa}}</option>
                                        @endif
                                    @endforeach
--}}{{--
                                        <option value="{{$row->id}}" >{{$row->name_fa}}</option>
--}}{{--
                                    @endif
                                </select>
                            </div>
                        </div>
--}}


              {{--          <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="demo-example modal-example w-100">
                                <label for="modal-example"> &#1575;&#1605;&#1705;&#1575;&#1606;&#1575;&#1578; &#1585;&#1601;&#1575;&#1607;&#1740;</label>
                                <select id="modal-example2" name="properties_out[]" multiple>
                                    @foreach($propertiesout as $row)
                                        @if(isset($category->properties_out)  && json_decode($category->properties_out) != [] && json_decode($category->properties_out) != null)
                                        <option value="{{$row->id}}"  {{in_array($row->id,json_decode($category->properties_out)) ? 'selected' : ''}} >{{$row->name}}</option>
                                        @endif
                                            <option value="{{$row->id}}"   >{{$row->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
--}}


                     {{--   <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="demo-example modal-example ">
                                <label for="modal-example">  &#1583;&#1587;&#1578;&#1585;&#1587;&#1740; &#1607;&#1575;</label>
                                <select id="modal-example3" name="properties_access[]" multiple>
                                    @if(count($propertiesaccess) > 0)
                                    @foreach($propertiesaccess as $row)
                                        @if(json_decode($category->properties_access) !== null)
                                        <option value="{{$row->id}}" {{in_array($row->id,json_decode($category->properties_access)) ? 'selected' : ''}}>{{$row->name_fa}}</option>
                                        @endif
                                            <option value="{{$row->id}}" >{{$row->name_fa}}</option>

                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>--}}


                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                {{Form::label('pic', ' (featuring image)تصویر شاخص ')}}
                                {{Form::file('pic', array('class' => 'dropify' ,'data-default-file'=>is_file($category->pic)?url($category->pic):null))}}
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="form-group">
                                {{Form::label('pic_share', 'تصویر اشتراک ')}}
                                <input type="file" name="pic_share" id="" class="dropify" data-default-file="{{is_file($category->pic_share)?url($category->pic_share):null}}" accept=".jpg">
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 1Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر عرض 200 پیکسل در ارتفاع 200 پیکسل می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید JPG,JPEG باشد</small></p>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                {{Form::label('home_pic', ' (home page image)تصویر صفحه اصلی ')}}
                                {{Form::file('home_pic', array('class' => 'dropify' ,'data-default-file'=>$category->home_pic ? url($category->home_pic->path):null))}}
                            </div>
                        </div>

                    <div class="col-12 d-flex mt-3 px-3 bg-blue-lightest py-4">
                         <div class="form-check">
                             <input class="form-check-input" type="radio"  name="show_in_index" id="show_in_index1" value="no" {{$category->show_in_index == 'no' ? 'checked' : ''}}>
                            <label class="form-check-label mr-4" for="show_in_index1" >
                            عدم نمایش در صفحه اصلی(No display on the main page)
                            </label>
                        </div>
                         <div class="form-check">
                             <input class="form-check-input" type="radio"  name="show_in_index" id="show_in_index2" value="yes" {{$category->show_in_index == 'yes' ? 'checked' : ''}}>
                            <label class="form-check-label mr-4" for="show_in_index2" >
                              نمایش در صفحه اصلی(display on the main page)
                            </label>
                        </div>
                </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('gallery', ' (Album)گالری ')}}
                                {{Form::file('gallery[]', array('class' => 'dropify','multiple'))}}
                            </div>
                            <div class="row mb-5">
                                @foreach($category->photos as $row)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <a href="{{route('admin.villa-category-photo-destroy',[$row->id])}}"> <div class="gallery-delete">x</div></a>
                                        <img src="{{url($row->path)}}"  class="img-thumbnail w-100" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>


{{--                        <div class="col-12 text-center py-4  my-5  text-primary">--}}
{{--                            <h2> اضافه کردن لینک</h2>--}}
{{--                        </div>--}}
                      {{--  <div class="col-12">
                            <div class="form-group">
                                {{Form::label('video_link1', '   &#1604;&#1740;&#1606;&#1705; &#1605;&#1587;&#1578;&#1602;&#1740;&#1605; &#1608;&#1583;&#1740;&#1608;1 ')}}
                                {{Form::text('video_link1', $category->video_link1, array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('video_link2', '      &#1604;&#1740;&#1606;&#1705; &#1605;&#1587;&#1578;&#1602;&#1740;&#1605; &#1608;&#1583;&#1740;&#1608; 2 *')}}
                                {{Form::text('video_link2', $category->video_link2, array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('bird_youtub_link', '    &#1604;&#1740;&#1606;&#1705; &#1740;&#1608;&#1578;&#1740;&#1608;&#1576; &#1583;&#1740;&#1583; &#1662;&#1585;&#1606;&#1583;&#1607; ')}}
                                {{Form::text('bird_youtub_link', $category->bird_youtub_link, array('class' => 'form-control',))}}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('youtub_link_1', '    &#1604;&#1740;&#1606;&#1705; &#1740;&#1608;&#1578;&#1740;&#1608;&#1576;  1')}}
                                {{Form::text('youtub_link_1', $category->youtub_link_1, array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('youtub_link_2', '      &#1604;&#1740;&#1606;&#1705; &#1740;&#1608;&#1578;&#1740;&#1608;&#1576; 2 ')}}
                                {{Form::text('youtub_link_2', $category->youtub_link_2, array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('google_driver_1', '    &#1608;&#1740;&#1583;&#1574;&#1608; &#1711;&#1608;&#1711;&#1604; &#1583;&#1585;&#1575;&#1740;&#1608; 1')}}
                                {{Form::text('google_driver_1', $category->google_driver_1, array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('google_driver_2', '    &#1608;&#1740;&#1583;&#1574;&#1608; &#1711;&#1608;&#1711;&#1604; &#1583;&#1585;&#1575;&#1740;&#1608; 2 ')}}
                                {{Form::text('google_driver_2', $category->google_driver_2, array('class' => 'form-control'))}}
                            </div>
                        </div>--}}
                        {{--<div class="col-12">
                            <div class="form-group">
                                {{Form::label('map', '   &#1604;&#1740;&#1606;&#1705; &#1606;&#1602;&#1588;&#1607; *')}}
                                {{Form::text('map', $category->map, array('class' => 'form-control'))}}
                            </div>
                        </div>--}}

                        <div class="col-12 py-5">توضیحات متا</div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('page_name_meta', 'آدرس') }}
                            <input type="text" class="form-control" value="{{old('page_name_meta') ?? $category->meta ? $category->meta->name_page : ''}}" name="page_name_meta">
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('page_title_meta', 'عنوان') }}
                            <input type="text" class="form-control" name="page_title_meta"  value="{{old('page_title_meta') ??  $category->meta ? $category->meta->title_page : ''}}">
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('description_meta', 'توضیحات') }}
                            <textarea class="form-control" name="description_meta">{{old('description_meta') ?? $category->meta ? $category->meta->description : ''}}</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('keyword_meta', 'کلمات کلیدی') }}
                            <input type="text" class="form-control" name="keyword_meta" value="{{old('keyword_meta')  ??  $category->meta ? $category->meta->keyword : ''}}" />
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('priority_meta', 'رتبه بندی') }}
                            <input type="text" class="form-control" name="priority_meta" value="{{old('priority') ?? $category->meta ? $category->meta->priority : '' }}" />
                        </div>
                        <div class="col-md-12 form-group">
                            {{ Form::label('schima', 'اسکیما') }}
                            <input type="text" class="form-control" name="schima" value="{{old('schima') ?? $category->meta ?  $category->meta->schima : '' }}" value="{{old('schima')}}" />
                        </div>
                        <div class="col-md-12 text-left">
                            <hr/>
                            {{Form::submit('ذخیره',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمعن هستید ؟')"))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection
@push('in_tag_script')

    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/css/example-styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/css/demo-styles.css')}}">
    <script type="text/javascript" src="{{url('assets/admin/js/jquery.multi-select.js')}}"></script>



    <script src="{{ asset('assets/admin/js/leaflet/leaflet.js') }}"></script>

    <script src="{{ url('assets/admin/editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('assets/admin/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script type="text/javascript">
        {{--        select--}}
        $('.discount').on('change',function(){
            let discount = $('.discount').val();
            let price = $('.price_f').val();

            let unit = parseInt(price) / 100;
            let new_price = parseInt(discount) * unit
            $('.discount_price').val(new_price);

        })
        $(function(){

            $('#modal-example1').multiSelect({
                'modalHTML': '<div class="multi-select-modal">'
            });
            $('#modal-example2').multiSelect({
                'modalHTML': '<div class="multi-select-modal">'
            });
            $('#modal-example3').multiSelect({
                'modalHTML': '<div class="multi-select-modal">'
            });
        });
        //select
        var textareaOptions = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa'
        };
        $('.textarea').ckeditor(textareaOptions);
    </script>



        <script>
            $('.city').on('change',function(){
                let city = $('#city_id').val();
                $.post("{{route('admin.findCity')}}",{
                    _token: "{{ csrf_token() }}",
                    city_id : city,
                }).done(response => {
                    let local_id = $('#local_id');
                    local_id.empty();
                    $.each(response.locals , function(key,item){
                        local_id.append($("<option></option>")
                        .attr("value",item.id).text(item.name));
                    })
                }).fail(error =>{
                    console.log(error)
                })

            })



        </script>
         <script>
         // New York
        let startlat = {{ $category->latitude ?? 40.75637123 }};
        let startlon = {{ $category->longitude ?? -73.98545321 }};
        let lastlat;
        let lastlon;

        let options = {
            center: [startlat, startlon],
            zoom: 9,
            scrollWheelZoom: 'center'
        }

        let latInput = $('#lat');
        let lonInput = $('#lon');
        let addrInput = $('#addr');
        let addrResult = $('#address-result');

        latInput.val(startlat);
        lonInput.val(startlon);

        let map = L.map('map', options);
        // let nzoom = 16;

        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'OSM',
            subdomains: ['a', 'b', 'c']
        }).addTo(map);

        let myMarker = L.marker([startlat, startlon], {
            title: "Coordinates",
            alt: "Coordinates",
            draggable: true
        }).addTo(map).on('dragend', function() {
            let lat = myMarker.getLatLng().lat.toFixed(8);
            let lon = myMarker.getLatLng().lng.toFixed(8);
            map.setView([lat, lon])
            // let czoom = map.getZoom();
            // if (czoom < 18) { nzoom = czoom + 2; }
            // if (nzoom > 18) { nzoom = 18; }
            // if (czoom != 18) { map.setView([lat, lon], nzoom); } else { map.setView([lat, lon]); }
        });
        (function() {
            @if(! $category->latitude || ! $category->longitude)
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                getLocationFromIp();
                console.log("Geolocation is not supported by this browser.");
            }
            @endif

            function showPosition(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                editMapAndValue(lat, lon);
                map.setView([lat, lon], 16);
            }

            function getLocationFromIp() {
                $.ajax({
                    type: "GET",
                    url: `https://ipapi.co/{{ request()->ip() }}/json`,
                    success: function(data) {
                        console.log(data)
                        if (!data.error)
                            map.setView([data.latitude, data.longitude]);
                    },
                    error: function(jqXhr, textStatus, errorMessage) {
                        // for (let error in jqXhr.responseJSON.errors) {
                        //     console.log(jqXhr.responseJSON.errors[error][0])
                        // }
                        console.log(jqXhr.responseJSON)
                    }
                });
            }

            function showError(error) {
                getLocationFromIp();
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        console.log("User denied the request for Geolocation.")
                        break;
                    case error.POSITION_UNAVAILABLE:
                        console.log("Location information is unavailable.")
                        break;
                    case error.TIMEOUT:
                        console.log("The request to get user location timed out.")
                        break;
                    case error.UNKNOWN_ERROR:
                        console.log("An unknown error occurred.")
                        break;
                }
            }

            function editMapAndValue(lat, lon) {
                latInput.val(lat);
                lonInput.val(lon);
                myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
                if (lastlat != lat || lastlon != lon) {
                    console.log('loading')
                    $.ajax({
                        type: "GET",
                        url: `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`,
                        success: function(data) {
                            console.log(data)
                            console.log('loading finished');
                            console.log('country: ' + data.address.country);
                            console.log('city: ' + data.address.city);
                            console.log('county: ' + data.address.county);
                            console.log('town: ' + data.address.town);
                            console.log('road: ' + data.address.road);
                            addrInput.val(reverseString(data.display_name));
                        },
                        error: function(jqXhr, textStatus, errorMessage) {
                            console.log('loading finished');
                            for (let error in jqXhr.responseJSON.errors) {
                                console.log(jqXhr.responseJSON.errors[error][0])
                            }
                        }
                    });
                    lastlat = lat;
                    lastlon = lon;
                }
            }

            map.on("moveend", function(event) {
                latInput.val(map.getCenter().lat);
                lonInput.val(map.getCenter().lng);
                let lat = map.getCenter().lat;
                let lon = map.getCenter().lng;
                editMapAndValue(lat, lon);
            })

            map.on("zoomend", function(event) {
                lastlat = map.getCenter().lat;
                lastlon = map.getCenter().lng;
            })

            map.on("move", function(event) {
                latInput.val(map.getCenter().lat);
                lonInput.val(map.getCenter().lng);
                myMarker.setLatLng(map.getCenter())
            })

            map.on('click', function(event) {
                let lat = (event.latlng.lat);
                let lon = (event.latlng.lng);
                let newLatLng = new L.LatLng(lat, lon);
                myMarker.closePopup();
                map.setView(newLatLng);
                myMarker.setLatLng(newLatLng);
            });

            const format = (item) => {
                if (!item.id) {
                    return item.text;
                }

                let icon = `fab ${item.element.getAttribute('data-kt-select2-icon')} ${item.element.getAttribute('data-kt-select2-color')} fs-1 me-2`;
                let tag = $("<i>", {
                    class: `${icon}`
                });
                let span = $("<span>", {
                    class: "d-flex align-items-center",
                    text: " " + item.text
                });
                span.prepend(tag);
                return span;
            }

            // Init Select2 --- more info: https://select2.org/
            $('#social').select2({
                templateResult: function (item) {
                    return format(item);
                }
            });
        })();

        function reverseString(text) {
            let address_array = text.split(",");
            address_array = address_array.reverse();
            return address_array.toString();
        }

        function chooseAddr(lat1, lng1, address) {
            lastlat = lat1;
            lastlon = lng1;
            addrInput.val(address);
            addrResult.html('');
            myMarker.closePopup();
            map.setView([lat1, lng1], 18);
            myMarker.setLatLng([lat1, lng1]);
            let lat = lat1.toFixed(8);
            let lon = lng1.toFixed(8);
            latInput.val(lat);
            lonInput.val(lon);
            myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
        }

        function myFunction(arr) {
            let out = "<br />";
            let i;

            if (arr.length > 0) {
                for (i = 0; i < arr.length; i++) {
                    out += "<div class='p-3 text-gray-700 bg-light-info bg-hover-info text-hover-white col-12 cursor-pointer' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ", `" + reverseString(arr[i].display_name) + "`);return false;'>" + reverseString(arr[i].display_name) + "</div>";
                }
                addrResult.html(out);
            }
            else {
                addrResult.html("Sorry, no results...");
            }
        }

       function addr_search() {
            $.ajax({
                type: "GET",
                url: "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addrInput.val(),
                success: function(data) {
                    console.log(data)
                    myFunction(data);
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    for (let error in jqXhr.responseJSON.errors) {
                        console.log(jqXhr.responseJSON.errors[error][0])
                    }
                }
            });
        }




    </script>



@endpush