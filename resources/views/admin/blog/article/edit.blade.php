@extends('layouts.admin',['req'=>true,'editor'=>true,'file_upload'=>true])

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
                    {{ Form::model($item,array('route' => array('admin.article.update',$item->id),'id'=>'form_req', 'method' => 'PATCH','files'=>true)) }}
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{Form::label('title', ' عنوان *')}}
                                                {{Form::text('title', null, array('class' => 'form-control','required'))}}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{Form::label('status', 'وضعیت  *')}}
                                                {{ Form::select('status', ['active'=>'انتشار','pending'=>'عدم انتشار'], null, array('class' => 'form-control select2-show-search custom-select','required')) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{Form::label('author', ' نویسنده *')}}
                                                {{Form::text('author', null, array('class' => 'form-control','required'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            {{Form::label('text', 'متن خبر *')}}
                                            <div class="form-group form-group-post">
                                                {{Form::textarea('text', null, array('class' => 'form-control textarea_ltr','required'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{Form::label('title_page', ' عنوان صفحه(سئو)')}}
                                                {{Form::text('title_page', null, array('class' => 'form-control'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('key_word', ' کلمات کلیدی(کلمات را وارد کنید و اینتر بزنید تا ثبت شود)')}}
                                                {{Form::text('key_word', null, array('class' => 'form-control key_word'))}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{Form::label('description', ' توضیحات(سئو)')}}
                                                {{Form::text('description', null, array('class' => 'form-control'))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach(tab_langs() as $lang)
                                <div class="tab-pane fade {{$lang->align=='ltr'?'ltr_tab':''}}" id="nav-{{$lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$lang->lang}}-tab">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{Form::label('title_'.$lang->lang, ' عنوان')}}
                                                    {{Form::text('title_'.$lang->lang, read_lang($item,'title',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{Form::label('status_'.$lang->lang, 'وضعیت  *')}}
                                                    {{ Form::select('status_'.$lang->lang, ['pending'=>'عدم انتشار','active'=>'انتشار'], read_lang($item,'status',$lang->lang), array('class' => 'form-control select2-show-search custom-select','required')) }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{Form::label('author_'.$lang->lang, ' نویسنده')}}
                                                    {{Form::text('author_'.$lang->lang, read_lang($item,'author',$lang->lang), array('class' => 'form-control',))}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                {{Form::label('text_'.$lang->lang, 'متن خبر')}}
                                                <div class="form-group form-group-post">
                                                    {{Form::textarea('text_'.$lang->lang, read_lang($item,'text',$lang->lang), array('class' => 'form-control textarea_'.$lang->align))}}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{Form::label('title_page_'.$lang->lang, ' عنوان صفحه(سئو)')}}
                                                    {{Form::text('title_page_'.$lang->lang, read_lang($item,'title_page',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('key_word_'.$lang->lang, ' کلمات کلیدی(کلمات را وارد کنید و اینتر بزنید تا ثبت شود)')}}
                                                    {{Form::text('key_word_'.$lang->lang, read_lang($item,'key_word',$lang->lang), array('class' => 'form-control key_word'))}}
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{Form::label('description_'.$lang->lang, ' توضیحات(سئو)')}}
                                                    {{Form::text('description_'.$lang->lang, read_lang($item,'description',$lang->lang), array('class' => 'form-control'))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('photo', 'تصویر * ')}}
                                {{Form::file('photo', array('class' => 'dropify','data-height'=>'180','accept' => '.jpg,.jpeg','data-default-file'=>$item->photo && is_file($item->photo->path)?url($item->photo->path):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 4MG می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر معادل عرض 300 پیکسل در ارتفاع 280 پیکسل می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید JPG,JPEG باشد</small></p>
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