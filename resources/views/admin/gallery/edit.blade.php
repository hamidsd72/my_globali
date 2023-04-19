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
                {{-- 
                    floor Location [Garden level,Ground level,(1-30),30 and above]
                    Number of floors[(1-30),30 and above]
                    Heating[Central,Underfloor heating,air conditioning]
                    Property type [
                        Commercial[Ofice,Shop]
                        residential[Apartment,Villa,Residance]
                        Land[Residential land,agricultural land]
                    ]

                    
                    
                    
                    Location [All city,Istanbul,بعدا شهرهای دیگه اضافه میشه]
                    --}}
                <div class="card-body">
                    {{ Form::model($item,array('route' => array('admin.gallery.update',$item->id), 'method' => 'PATCH','files'=>true)) }}
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
                                        <div class="col-md-12">
                                            {{Form::label('text', 'متن  *')}}
                                            <div class="form-group form-group-post">
                                                {{Form::textarea('text', null, array('class' => 'form-control textarea_ltr','required'))}}
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
                                            <div class="col-md-12">
                                                {{Form::label('text_'.$lang->lang, 'متن ')}}
                                                <div class="form-group form-group-post">
                                                    {{Form::textarea('text_'.$lang->lang, read_lang($item,'text',$lang->lang), array('class' => 'form-control textarea_'.$lang->align))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('pic', 'تصویر اصلی')}}
                                {{Form::file('pic', array('class' => 'dropify','data-height'=>'180','accept' => '.jpg,.jpeg','data-default-file'=>is_file($item->pic)?url($item->pic):null))}}
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم تصویر 4Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر در عرض و ارتفاع برابر می باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید JPG,JPEG باشد</small></p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    {{Form::label('photos', ' تصاویر')}}
                                    <div class="input-group mb-5 file-browser">
                                        <input type="text" class="form-control browse-file" placeholder="تصاویر خود را جهت آپلود انتخاب نمایید" readonly>
                                        <label class="input-group-append">
												<span class="btn btn-primary">
													انتخاب
                                                    {{Form::file('photos[]', array('class' => 'file-browserinput d-none','accept' => '.jpg,.png,.jpeg','multiple'))}}
												</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم هر تصویر 4Mb می باشد</small></p>
                            <p class="text-danger">_<small>بهترین سایز تصویر ارتفاع و عرض کوچکتر از 1400 پیکسل باشد</small></p>
                            <p class="text-danger">_<small>فرمت تصویر فقط باید PNG,JPG,JPEG باشد</small></p>
                        </div>
                        @if(count($item->gallery_p))
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="row">
                                        @foreach($item->gallery_p as $photo)
                                            <div class="col-md-3 col-sm-6">
                                                <div class="img_box_photos">
                                                    <img src="{{url($photo->file)}}" alt="{{$item->title}}">
                                                    <a href="{{route('admin.gallery.delete',$photo->id)}}"
                                                       onclick="return confirm('برای حذف مطمئن هستید؟')"
                                                       class="photo_destroy file_delete" data-toggle="tooltip" data-placement="top"
                                                       title="حذف">×</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    {{Form::label('films', ' ویدئوها')}}
                                    <div class="input-group mb-5 file-browser">
                                        <input type="text" class="form-control browse-file" placeholder="ویدئوهای خود را جهت آپلود انتخاب نمایید" readonly>
                                        <label class="input-group-append">
												<span class="btn btn-primary">
													انتخاب
                                                    {{Form::file('films[]', array('class' => 'file-browserinput d-none','accept' => '.mp4','multiple'))}}
												</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger">_<small>حداکثر حجم هر ویدئو 30Mb می باشد</small></p>
                            <p class="text-danger">_<small>فرمت ویدئو فقط باید mp4 باشد</small></p>
                        </div>
                        @if(count($item->gallery_v))
                                <div class="col-md-12">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($item->gallery_v as $key=>$film)
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="doc_box_documents">
                                                        <a href="{{url($film->file)}}"
                                                           target="_blank">
                                                            ویدئو شماره {{$key+1}}
                                                        </a>
                                                        <a href="{{route('admin.gallery.delete',$film->id)}}"
                                                           onclick="return confirm('برای حذف مطمئن هستید؟')"
                                                           class="document_destroy file_delete" data-toggle="tooltip"
                                                           data-placement="top" title="حذف">×</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        @endif
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
