@extends('layouts.admin',['req'=>true,'date_picker'=>true,'file_upload'=>true])

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
                    {{ Form::model($item,array('route' => array('admin.setting.update',$item->id),'id'=>'form_req', 'method' => 'PATCH','files'=>true)) }}
                    {{Form::hidden('id', $item->id)}}
                    <div class="row">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-en-tab" data-toggle="tab" data-target="#nav-en" type="button" role="tab" aria-controls="nav-en" aria-selected="true">EN</button>
                                @foreach(tab_langs() as $lang)
                                    <button class="nav-link" id="nav-{{$lang->lang}}-tab" data-toggle="tab" data-target="#nav-{{$lang->lang}}" type="button" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false">{{$lang->lang}}</button>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content w-100" id="nav-tabContent">
                            <div class="tab-pane fade show active ltr_tab" id="nav-en" role="tabpanel" aria-labelledby="nav-en-tab">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{Form::label('title', ' عنوان *')}}
                                                {{Form::text('title', null, array('class' => 'form-control','required'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('description', ' توضیحات سئو')}}
                                                {{Form::text('description', null, array('class' => 'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('keywords', ' کلمات کلیدی')}}
                                                {{Form::text('keywords', null, array('class' => 'form-control'))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach(tab_langs() as $lang)
                                <div class="tab-pane fade {{$lang->align=='ltr'?'ltr_tab':''}}" id="nav-{{$lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$lang->lang}}-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {{Form::label('title_'.$lang->lang, ' عنوان')}}
                                                    {{Form::text('title_'.$lang->lang, read_lang($item,'title',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('description_'.$lang->lang, ' توضیحات سئو')}}
                                                    {{Form::text('description_'.$lang->lang, read_lang($item,'description',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('keywords_'.$lang->lang, ' کلمات کلیدی')}}
                                                    {{Form::text('keywords_'.$lang->lang, read_lang($item,'keywords',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('username', ' نام کاربری *')}}
                                {{Form::text('username', null, array('class' => 'form-control','required'))}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('accesskey', ' کلید دسترسی *')}}
                                {{Form::text('accesskey', null, array('class' => 'form-control','required'))}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('logo', 'تصویر لوگو ')}}
                                {{Form::file('logo', array('class' => 'dropify','data-height'=>'180','accept' => '.png','data-default-file'=>$item->logo && is_file($item->logo->path)?url($item->logo->path):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 1Mb می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید PNG باشد</small></p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('icon', 'تصویر فاوآیکون ')}}
                                {{Form::file('icon', array('class' => 'dropify','data-height'=>'180','accept' => '.png','data-default-file'=>$item->icon && is_file($item->icon->path)?url($item->icon->path):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 1Mb می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید PNG باشد</small></p>
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
    <script src="{{ url('assets/editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('assets/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script type="text/javascript">
        var textareaOptions = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa'
        };
        $('.textarea').ckeditor(textareaOptions);
    </script>
@endpush
