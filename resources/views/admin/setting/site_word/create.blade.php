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
        <hr>

        <div class="card-body">
          {{ Form::open(array('route' => 'admin.site-word.store', 'method' => 'POST','id'=>'form_req','files'=>true)) }}
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
                    <div class="col-md-12">
                      <div class="form-group">
                        {{Form::label('word', 'متن * ')}}
                        {{Form::text('word',null, array('class' => 'form-control','required'))}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @foreach(tab_langs() as $lang)
                <div class="tab-pane fade {{$lang->align=='ltr'?'ltr_tab':''}}" id="nav-{{$lang->lang}}" role="tabpanel" aria-labelledby="nav-{{$lang->lang}}-tab">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          {{Form::label('word_'.$lang->lang, 'متن ')}}
                          {{Form::text('word_'.$lang->lang,null, array('class' => 'form-control'))}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('place_out', 'مکان اصلی  *')}}
                {{ Form::select('place_out', array_pluck(App\Models\SiteWord::place_oo(), 'title', 'id'), null, array('class' => 'form-control select2-show-search custom-select')) }}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {{Form::label('place_in', 'مکان داخلی * ')}}
                {{Form::text('place_in',null, array('class' => 'form-control','required'))}}
              </div>
            </div>
            <div class="col-md-12 text-left">
              <hr/>
              {{Form::submit('افزودن',array('class'=>'btn btn-primary','onclick'=>"return confirm('برای ارسال فرم مطمئن هستید؟')"))}}
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
@push('in_tag_script')

@endpush
