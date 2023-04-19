<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title>{{$setting->title}}</title>
    <meta name="base_url" content="{{url('')}}">
    <!--Favicon -->
    <link rel="icon" href="{{$setting->icon && $setting->icon->path?url($setting->icon->path):''}}" type="image/x-icon"/>
    @include('layouts.style.styles')
    <style>
        .redu50 {
            border-radius: 50px;
        }
        .form-control {
            border-color: #dce0e0 !important;
            border-width: 2px 2px 2px 2px !important;
            min-height: 40px !important;
        }
        .register_multi_type_box {
            border-radius: 13px 13px 0px 0px;
        }
        .register .card {
            border-radius: 0px 0px 13px 13px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/plugins/selectize/css.css')}}">
    @if(isset($tbl))
        @include('layouts.style.tbl')
    @endif
    @if(isset($file_upload))
        <link href="{{URL::asset('assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    @endif
    @if(isset($date_picker))
        <link href="{{URL::asset('assets/plugins/date-picker/persian-datepicker.css')}}" rel="stylesheet"/>
    @endif
    @if(isset($progress))
        <link href="{{URL::asset('assets/plugins/progress/normalize.css')}}" rel="stylesheet"/>
        <link href="{{URL::asset('assets/plugins/progress/asPieProgress.css')}}" rel="stylesheet"/>
    @endif
</head>

<body class="app sidebar-mini" id="index1">

<!---Global-loader-->
<div id="global-loader">
    <img src="{{URL::asset('assets/images/svgs/loader.svg')}}" alt="loader">
</div>
<div id="global-loader-form" style="display: none">
    <img src="{{URL::asset('assets/images/svgs/loader.svg')}}" alt="loader">
    <p class="text-center">در حال بارگذاری اطلاعات ...</p>
</div>
<div class="page">
    <div class="page-main">
        @if(Auth::check())
            @include('layouts.menu.hr-sidebar')
        @endif

        <div class="app-content main-content">
            <div class="side-app">
                @if(Auth::check())
                    @include('layouts.header.app-header')
                @endif
                @yield('content')
                @if(isset($url_back))
                    <a href="{{$url_back}}" class="btn btn-danger back_btn_all ml-1"
                       onclick="return confirm('برای بازگشت مطمئن هستید؟')"  data-toggle="tooltip"
                       data-placement="top" title="بازگشت"><span class="feather feather-chevrons-right"></span> </a>
                @endif
            </div>
        </div><!-- end app-content-->
    </div>

    @include('layouts.footer.footer')


</div>

@include('layouts.script.scripts')
<script type="text/javascript" src="{{URL::asset('assets/plugins/selectize/js.js')}}"></script>
@if(isset($tbl))
    @include('layouts.script.tbl')
@endif
@if(isset($req))
    @include('layouts.script.req')
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Custom js-->
@if(isset($req))
    @include('layouts.script.req')
@endif
@if(isset($date_picker))
    @include('layouts.script.date_picker')

    <script>
        $(document).ready(function () {
            $(".persian-datepicker").pDatepicker({
                // observer: true,
                defaultDate: true,
                format: 'YYYY/MM/DD',
                locale: 'en',
                // altField: '.observer-example-alt'
            });
        });
        if ($('.date_p')[0]) {
            $('.date_p').persianDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                initialValueType: 'gregorian',
                initialValue: true,
            });
        }
        if ($('.date_p1')[0]) {
            $('.date_p1').persianDatepicker({
                observer: true,
                format: 'YYYY/MM/DD',
                initialValue: false,
                calendar:{
                    persian: {
                        locale: 'en'
                    }
                },
                calendarType: 'gregorian',
            });
        }
    </script>

@endif
@if(isset($price_k))
    <script src="https://cdn.jsdelivr.net/gh/mahmoud-eskandari/NumToPersian/dist/num2persian-min.js"></script>
@endif
@if(isset($editor))
    <script src="{{ url('assets/editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('assets/editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script type="text/javascript">
        var textareaRtl = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa',

        };
        $('.textarea_rtl').ckeditor(textareaRtl);

        var textareaLtr = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'en',

        };
        $('.textarea_ltr').ckeditor(textareaLtr);

    </script>
@endif
@if(isset($file_upload))
    @include('layouts.script.file_upload')
@endif
@if(isset($progress))
    <script src="{{URL::asset('assets/plugins/progress/jquery-asPieProgress.js')}}"></script>
   <script>
       jQuery(function($) {
           $('.pie_progress').asPieProgress({
               namespace: 'pie_progress'
           });
       })
       $(document).ready(function () {
           $('.pie_progress').asPieProgress('start');
       })
   </script>
@endif
<script src="{{URL::asset('assets/js/custom.js')}}"></script>
<script>
    $(".key_word").selectize({
        delimiter: ",,",
        plugins: {
            remove_button: {
                label: "×"
            }
        },
        persist: false,
        createOnBlur: true,
        create: true
    });
    $(".contact_multi").selectize({
        delimiter: ",",
        plugins: {
            remove_button: {
                label: "×"
            }
        },
        persist: false,
        createOnBlur: true,
        create: true,
        copyClassesToDropdown:false
    });
    @if(isset($req))
    $("#form_req").validate({
        submitHandler: function (form) {
            if($('.textarea_rtl')[0] || $('.textarea_ltr')[0])
            {
                for (var i in CKEDITOR.instances) {
                    CKEDITOR.instances[i].updateElement();
                }
            }

            $('#global-loader-form').css('display', 'block');
            form.submit();
        }
    });
    @endif
    @if(session()->has('err_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            text: "{{ session('err_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if(session()->has('flash_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "موفق",
            text: "{{ session('flash_message') }}",
            icon: "success",
            timer: 6000,
            timerProgressBar: true,
        })
    })
    ;@endif
    @if (count($errors) > 0)
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            icon: "warning",
            html:
            @foreach ($errors->all() as $key => $error)
                '<p class="text-right mt-2 ml-5" dir="rtl"> {{$key+1}} : ' +
            '{{ $error }}' +
            '</p>' +
            @endforeach
                '<p class="text-right mt-2 ml-5" dir="rtl">' +
            '</p>',
            timer: @if(count($errors)>3)parseInt('{{count($errors)}}') * 1500 @else 6000 @endif,
            timerProgressBar: true,
        })
    });
    @endif
</script>

<script>
    // انواع ثبت نام 
    function signUpMod(mod) {
        let sign_up_mod         = document.querySelectorAll('.sign_up_mod');
        let selected_element    = document.querySelector(`.${mod}`);
        
        if (sign_up_mod.length) {
            
            sign_up_mod.forEach( selector => {
                selector.classList.remove('text-success');
                selector.classList.remove('bg-white');
                selector.classList.add('text-white');
            });
            
            selected_element.classList.remove('text-white');
            selected_element.classList.add('text-success');
            selected_element.classList.add('bg-white');
            
            document.querySelector('.append_box_one').classList.add('d-none');
            document.querySelector('.append_box_two').classList.add('d-none');
            document.querySelector('.append_box_tree').classList.add('d-none');
            document.querySelector('#register_type').value = 'customer';
            if (mod==='two') {
                document.querySelector('.append_box_one').classList.remove('d-none');
                document.querySelector('.append_box_two').classList.remove('d-none');
                document.querySelector('#register_type').value = 'agent';
            } else if (mod==='tree') {
                document.querySelector('.append_box_one').classList.remove('d-none');
                document.querySelector('.append_box_tree').classList.remove('d-none');
                document.querySelector('#register_type').value = 'sales_office';
            }
        }

        // برای وقتی که ثبت نام خطا داشت
        let register_type   = document.querySelector('#register_type').value;
        if (register_type) {
            document.querySelector('.append_box_two').classList.add('d-none');
            document.querySelector('.append_box_tree').classList.add('d-none');
            if (register_type==='agent') {
                document.querySelector('.append_box_one').classList.remove('d-none');
                document.querySelector('.append_box_two').classList.remove('d-none');
            } else if (register_type==='sales_office') {
                document.querySelector('.append_box_one').classList.remove('d-none');
                document.querySelector('.append_box_tree').classList.remove('d-none');
            }
        }
    }
    
    // قبول قوانین
    function agreement_function() {
        if (document.querySelector('#agreement')) {
            document.querySelector('.register_active_btn').classList.remove('d-none');
            document.querySelector('.register_diactive_btn').classList.add('d-none');
            if (document.querySelector('#agreement').checked===true) {
                document.querySelector('.register_active_btn').classList.add('d-none');
                document.querySelector('.register_diactive_btn').classList.remove('d-none');
            }
        }
    }
    agreement_function()

    @if(isset($countries))
        let countries = @json($countries);
        country_list  = document.querySelector('#country_select');
        country_code  = document.querySelector('#country_code_select');
        countries.forEach(country => {
            var option          = document.createElement('option');
            if (country_list) {
                option.textContent  = `${country.emoji} ${country.name}`;
                option.value        = country.name;
                country_list.append(option);
            }
            if (country_code) {
                var option2         = document.createElement('option');
                option2.textContent = `${country.emoji} ${country.code} ${country.dial_code}`;
                option2.value       = country.dial_code;
                country_code.append(option2);
            }
        });
    @endif

</script>
@stack('in_tag_script')
@yield ('in_tag_script')

</body>
</html>