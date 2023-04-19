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

                    {{Form::open(array('route' => array('admin.project-feature.update',$item->id), 'method' => 'PATCH','files'=>true)) }}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="fa-tab" data-toggle="tab" data-target="#fa" type="button" role="tab" aria-controls="fa" aria-selected="true">فارسی</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="en-tab" data-toggle="tab" data-target="#en" type="button" role="tab" aria-controls="en" aria-selected="false">English</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="ru-tab" data-toggle="tab" data-target="#ru" type="button" role="tab" aria-controls="ru" aria-selected="false">Russian</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="ar-tab" data-toggle="tab" data-target="#ar" type="button" role="tab" aria-controls="ar" aria-selected="false">عربی</button>
                        </li>
                    </ul>

                    <div class="row">
                        
                        <div class="tab-content col-12 bg-white" id="myTabContent">
                            <div class="tab-pane fade show active" id="fa" role="tabpanel" aria-labelledby="fa-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{Form::label('fa', ' عنوان فارسی *')}}
                                            {{Form::text('fa',$item->title_fa, array('class' => 'form-control','required'))}}
                                        </div>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="form-group">
                                            {{Form::label('fa-status', 'وضعیت *')}}
                                            <select name="fa-status" class="form-control">
                                                <option value="active" {{$item->status == 'active' ? 'selected' : '' }}>فعال</option>
                                                <option value="pending" {{$item->status == 'pending' ? 'selected' : '' }}>غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-left">
                                            {{Form::label('en', ' Title English *')}}
                                            {{Form::text('en',$item->title_en, array('class' => 'form-control text-left','dir'=>'ltr','required'))}}
                                        </div>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="form-group">
                                            {{Form::label('en-status', 'status *')}}
        
                                            <select name="en-status" class="form-control">
                                                <option value="active" {{$item->status == 'active' ? 'selected' : '' }}>active</option>
                                                <option value="pending" {{$item->status == 'pending' ? 'selected' : '' }}>deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="ru" role="tabpanel" aria-labelledby="ru-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group text-left">
                                            {{Form::label('ru', ' Заголовок Россия *')}}
                                            {{Form::text('ru',$item->title_en, array('class' => 'form-control text-left','dir'=>'ltr','required'))}}
                                        </div>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="form-group">
                                            {{Form::label('ru-status', 'Состояние *')}}
        
                                            <select name="ru-status" class="form-control">
                                                <option value="active" {{$item->status == 'active' ? 'selected' : '' }}>активный</option>
                                                <option value="pending" {{$item->status == 'pending' ? 'selected' : '' }}>Неактивный</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="ar" role="tabpanel" aria-labelledby="ar-tab">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{Form::label('ar', ' عنوان عربی *')}}
                                            {{Form::text('ar',$item->title_en, array('class' => 'form-control','required'))}}
                                        </div>
                                    </div>
    
                                    <div class="col-auto">
                                        <div class="form-group">
                                            {{Form::label('ar-status', 'حالة *')}}
        
                                            <select name="ar-status" class="form-control">
                                                <option value="active" {{$item->status == 'active' ? 'selected' : '' }}>نشيط</option>
                                                <option value="pending" {{$item->status == 'pending' ? 'selected' : '' }}>غير نشط</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group text-left">
                                {{Form::label('type', '* input type')}}
                                <select name="type" class="form-control form-control-lg" style="direction: ltr">
                                    <option value="select" {{$item->type == 'select' ? 'selected' : '' }}>yes / no</option>
                                    <option value="number"  {{$item->type == 'number' ? 'selected' : '' }}>numbers</option>
                                    <option value="text"  {{$item->type == 'text' ? 'selected' : '' }}>text</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group text-left">
                                {{Form::label('tab', '* categories(tabs)')}}
                                <select name="tab" class="form-control form-control-lg" style="direction: ltr">
                                    <option value="general" {{$item->tab == 'general' ? 'selected' : '' }}>General </option>
                                    <option value="equipment" {{$item->tab == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                    <option value="moref" {{$item->tab == 'moref' ? 'selected' : '' }}>More Features</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group text-left">
                                {{Form::label('filter', '* show in filters')}}

                                <select name="filter" class="form-control form-control-lg" style="direction: ltr">
                                    <option value="active" {{$item->filter == 'active' ? 'selected' : '' }}>active</option>
                                    <option value="pending" {{$item->filter == 'pending' ? 'selected' : '' }}>deactive</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12 text-left">
                            <hr/>
                            {{Form::submit('submit',array('class'=>'btn btn-primary','onclick'=>"return confirm('Are you sure to submit the form?')"))}}
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection
@push('in_tag_script')
    <script src="{{ url('assets/admin/editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('assets/admin/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
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
