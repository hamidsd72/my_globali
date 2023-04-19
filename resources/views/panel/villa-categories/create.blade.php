@extends('panel.layouts.front',['req'=>true,'editor'=>true,'file_upload'=>true])
@section('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link href="{{url('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <style>
        .t_error {
            border-color: red !important;
        }
    </style>
@endsection
@section('body')
    <div class="row pt-5 justify-content-center" style="font-size: 14px">
        <div class="col-xl-9 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-header  border-0">
                    <h4 class="card-title">
                        Upload project
                    </h4>
                </div>

                <div class="card-body ">

                    {{Form::open(array('route' => array('panel.project-store',[app()->getLocale()]), 'method' => 'POST','files'=>true)) }}
                    <div class="row lorem_box lorem_box_1">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('name', 'name *')}}
                                {{Form::text('name', null, array('class' => 'form-control','required'))}}
                                <p class="text-danger m-0 r_error d-none">required</p>
                            </div>
                        </div>
                        <input hidden name="status" value="pending">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('slug', 'slug *')}}
                                {{Form::text('slug', null, array('class' => 'form-control','required'))}}
                                <p class="text-danger m-0 r_error d-none">required</p>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                {{Form::label('address', ' address  *')}}
                                {{Form::text('address','', array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('brief ', 'Short description  *')}}
                                {{Form::textarea('brief','', array('class' => 'form-control','rows'=>3))}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('text', 'description  *')}}
                                {{Form::textarea('text','', array('class' => 'form-control textarea_ltr'))}}
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('area (m2)')}}
                                {{Form::number('area', null, array('class' => 'form-control'))}}
                            </div>
                        </div>
                        @foreach($feature as $ff)

                            @if($ff->type=='text')
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title)}}
                                        {{Form::text('feature_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="col-md-12 text-left">
                            <hr/>
                            <div class="row">
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_next_1" onclick="next_step(1)">Next</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="row lorem_box lorem_box_2 d-none">

                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>All information</h2>
                        </div>
                        <input type="hidden" name="type" value="villa">


                        <div class="col-lg-6">
                            <div class="form-group">
                                {{Form::label('country_id', 'country')}}
                                <select name="country_id" id="country_select" class="form-control select2 custom-select">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('city_id', 'city')}}
                                <select name="city_id" id="city_select" class="form-control select2 custom-select">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('local_id', 'zone')}}
                                <select name="local_id" id="local_id" class="form-control select2 custom-select">
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                {{Form::label('category_id', 'category')}}
                                <select name="category_id" id="category_id" class="form-control select2 custom-select">
                                    @foreach($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                        {{--<div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(type)نوع ملک</label>
                                <select name="type_id" class="form-control form-control-lg">
                                    @foreach($types as $key=>$type)
                                        <option value="{{$key}}"> {{$type}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                {{Form::label('price', '(price $)')}}
                                {{Form::number('price', null, array('class' => 'form-control'))}}
                            </div>
                        </div>

                      {{--  <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>(for)برای</label>
                                <select name="rent" class="form-control form-control-lg">
                                    <option value="0">(sell)فروش</option>
                                    <option value="1">(rent)اجاره</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>نمایش در Offers</label>
                                <select name="offers" class="form-control form-control-lg">
                                    <option value="active">فعال</option>
                                    <option value="pending">غیر فعال</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-12 text-left">
                            <hr/>
                            <div class="row">
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_perv_1" onclick="next_step(0)">Preview</a></div>
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_next_1" onclick="next_step(2)">Next</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="row lorem_box lorem_box_3 d-none">

                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>Features list</h2>
                        </div>
                        @foreach($feature as $ff)

                            @if($ff->type=='number')
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="form-group">
                                    {{Form::label('feature_id_'.$ff->id, $ff->title)}}
                                    {{Form::number('feature_id_'.$ff->id, null, array('class' => 'form-control', 'onkeypress'=>"return isNumber(event)"))}}
                                </div>
                            </div>

                          {{--  @elseif($ff->type=='text')
                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title." - فارسی")}}
                                        {{Form::text('feature_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="form-group">
                                        {{Form::label('feature_en_id_'.$ff->id, $ff->title." - انگلیسی")}}
                                        {{Form::text('feature_en_id_'.$ff->id, null, array('class' => 'form-control'))}}
                                    </div>
                                </div> --}}
                            @elseif($ff->type=='select')
                                <div class="col-lg-4 col-md-3 col-sm-7 col-8">
                                    <div class="form-group">
                                        {{Form::label('feature_id_'.$ff->id, $ff->title)}}
                                        {{Form::select('feature_id_'.$ff->id, ['no'=>'no','yes'=>'yes'], null , array('class' => 'form-control'))}}
                                    </div>
                                </div>
                            @endif
                        @endforeach


                        <div class="col-12 text-center py-4 my-5 text-primary">
                            <h2>(location information)</h2>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('iframe_map', ' (iframe map)')}}
                                {{Form::textarea('iframe_map', null,array('class' => 'form-control ','dir' => 'ltr','rows'=>3 ))}}
                            </div>
                        </div>

                        <div class="col-md-12 text-left">
                            <hr/>
                            <div class="row">
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_perv_1" onclick="next_step(1)">Preview</a></div>
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_next_1" onclick="next_step(3)">Next</a></div>
                            </div>
                        </div>

                    </div>
                    <div class="row lorem_box lorem_box_4 d-none">

                        <div class="col-md-12 my-4">
                            <div class="form-group">
                                {{Form::label('pic', 'featuring image')}}
                                {{Form::file('pic', array('class' => 'dropify' , 'required'))}}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('gallery', '(Album)')}}
                                {{Form::file('gallery[]', array('class' => 'dropify' , 'multiple' ))}}
                            </div>
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
                            <div class="row">
                                <div class="col-auto"><a href="#" class="btn btn-primary lorem_perv_1" onclick="next_step(2)">Preview</a></div>
                                <div class="col-auto">{{Form::submit('(Save)',array('class'=>'btn btn-primary','onclick'=>"return confirm('Are you sure to submit the form?')"))}}</div>
                            </div>
                        </div>
                            
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="{{url('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(".select2").select2({minimumResultsForSearch: "", placeholder: "Search", width: "100%"});
        $('.dropify').dropify();
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function next_step(step) {
            if (loremFucos(step)) {
                document.querySelectorAll('.lorem_box').forEach(element => {
                    element.classList.add('d-none');
                });
                document.querySelector(`.lorem_box_${step+1}`).classList.remove('d-none');
            }
        }
        function loremFucos(step) {
            console.log(step);
            if (step===1) {
                var inp_name    = document.querySelector('#name');
                var inp_slug    = document.querySelector('#slug');
                inp_name.classList.add('t_error');
                inp_slug.classList.add('t_error');
                document.querySelectorAll('.r_error').forEach(element => {
                    element.classList.add('d-none');
                });
                console.log(step);
                if( (inp_name.value).length > 0 && (inp_slug.value).length > 0 ) {
                    document.querySelectorAll('.r_error').forEach(element => {
                        element.classList.remove('d-none');
                    });
                    inp_name.classList.remove('t_error');
                    inp_slug.classList.remove('t_error');
                    console.log(step);
                    return true;
                }
                return false;
            }
            return true;
        }
        
    </script>

@endsection