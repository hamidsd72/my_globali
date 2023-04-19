<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{dir_set()}}" {{font_farsi()}}>
<head>
    <!--required meta tags-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!--twitter og-->
    <meta name="twitter:title" @if(trim($__env->yieldContent('title_seo'))) content="@yield('title_seo')" @else content="{{$titleSeo}}"  @endif/>
    <meta name="twitter:keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
    <meta name="twitter:description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
    <meta name="twitter:image" content="{{$fav_icon}}" />

    <!--facebook og-->
    <meta property="og:url" content="{{$urlPage}}" />
    <meta name="twitter:title" @if(trim($__env->yieldContent('title_seo'))) content="@yield('title_seo')" @else content="{{$titleSeo}}"  @endif/>
    <meta property="og:keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
    <meta property="og:description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
    <meta property="og:image" content="{{$fav_icon}}" />

    <!--meta-->
    <meta name="keywords" @if(trim($__env->yieldContent('keyword'))) content="@yield('keyword')" @else content="{{$keywordsSeo}}" @endif/>
    <meta name="description" @if(trim($__env->yieldContent('description'))) content="@yield('description')" @else content="{{$descriptionSeo}}" @endif/>
    <meta name="author" content="adib-it" />

    <meta name="base_url" content="{{url('')}}">

    <!--favicon icon-->
    <link rel="icon" href="{{$fav_icon}}" type="image/png" sizes="16x16" />

    <!--title-->
    <title>@if(trim($__env->yieldContent('title_seo'))) @yield('title_seo') @else {{$titleSeo}} @endif</title>

    <!--build:css-->
    <link rel="stylesheet" href="{{url('assets/front/css/main.css')}}" />
    <!-- endbuild -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "esgjhxoitd");
    </script>
    <!--custom css-->
    <link rel="stylesheet" href="{{url('assets/front/css/custom.css')}}" />
    @if(dir_set()=='rtl')
     <link rel="stylesheet" href="{{url('assets/front/css/rtl.css')}}" />
    @endif
    @if(font_farsi()=='yes')
     <style>
         h1,h2,h3,h4,h5,h6,p,strong,span,input,select,textarea,optgroup,button,li,a,small,label,td,th,div
         {
             font-family:IRANSans , sans-serif!important;
         }
    
         p,strong,span,input,select,textarea,optgroup,button,li,a,label,td,th,div
         {
             font-size:14px;
         }
     </style>
    @endif
    <style>
        .modal-body .at-search-box
        {
            padding: 0;
        }
        .modal-body .pt-mobile-15px
        {
            padding-top: 15px;
        }
        .modal-body .w-mobile-100
        {
            width: 100%;
        }
        .modal-body .ms-2
        {
            margin-left: 0!important;
        }
    </style>
    @yield ('styles')

<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11026977193"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11026977193');
    </script>
    <!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '879143183128080');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=879143183128080&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
                             <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <!-- CSS CDN -->
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    />
    <!-- datetimepicker jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
   </script>
</head>

<body>
    {{-- loading --}}
    <div class="ring-preloader w-100 h-100 position-fixed start-0 top-0 d-none-print">
        <!--<div class="lds-dual-ring"></div>-->
        <img src="{{url('assets/front/img/loading.gif')}}" width="175px" alt="loading">
    </div>

    <!--main content wrapper start-->
    <div class="main-wrapper">

        @include('layouts.includes_front.header')

        @include('layouts.includes_front.mobile_menu')

{{--        @include('layouts.includes_front.offcanvus_menu')--}}

        @include('layouts.includes_front.breadcrumb')
        
        @yield ('body')

        @include('layouts.includes_front.footer')

    </div>
    <!-- main content wrapper ends -->

    <!-- Modal -->
    <div class="modal fade d-none-print" id="at_product_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content product_modal shadow">
                <div class="close-btn-wrapper text-end">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="at_product_view">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="product_view_slider">
                                <div class="product_feature_img_slider swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="feature img" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="feature img" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="product_thumb_slider swiper mt-3">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="thumbnail" class="img-fluid">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{url('assets/front/img/home4/pd-1.jpg')}}" alt="thumbnail" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product_view_right mt-4 mt-md-0">
                                <ul class="product_review d-flex align-items-center">
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li class="review-total {{dir_set()=='ltr'?'ms-2':'me-2'}} text-primary fw-semibold"><a href="#">( 95 Reviews )</a></li>
                                </ul>
                                <h5 class="product_title mt-3">Aluminium Wheel AR-19 <br> Tire Parts</h5>
                                <p>Monotonectally simplify frictionless communities via clicks-and-mortar Interactively disseminate relationships. </p>
                                <ul class="key_features">
                                    <li>Speed: 750 RPM</li>
                                    <li>Power Source: Cordless-Electric</li>
                                    <li>Battery Cell Type: Lithium</li>
                                    <li>Voltage: 20 Volts</li>
                                    <li>Battery Capacity: 2 Ah</li>
                                </ul>
                                <div class="product_color_select mt-3">
                                    <span class="title text-secondary fw-semibold">Color</span>
                                    <ul class="d-flex align-items-center">
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle bg-white border border-1"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle black-color bg-secondary"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle red-color bg-primary"></span>
                                        </li>
                                        <li>
                                            <input type="radio" name="color">
                                            <span class="color_circle bg-warning"></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product_price mt-4">
                                    <del class="fw-semibold">$59.00</del>
                                    <span class="text-primary fw-semibold {{dir_set()=='ltr'?'ms-2':'me-2'}}">$29.00</span>
                                </div>
                                <div class="add_to_cart_product d-flex align-items-center mb-4 mt-3">
                                    <form class="d-inline-flex align-items-center">
                                        <button type="button" class="decrement btn-sm">-</button>
                                        <input type="text" value="01">
                                        <button type="button" class="increment btn-sm">+</button>
                                    </form>
                                    <a href="#" class="btn btn-secondary btn-sm"><span class="{{dir_set()=='ltr'?'me-1':'ms-1'}}"><i class="fa-solid fa-cart-plus"></i></span>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <!--scrolltop button-->
    <button class="theme-scrolltop-btn d-none-print"><i class="fa-regular fa-hand-pointer"></i></button>
    <!--scrolltop button end-->

    <!--build:js-->
    <script src="{{url('assets/front/js/vendors/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/appear.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/popper.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/easing.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/swiper.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/massonry.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/bootstrap-slider.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/magnific-popup.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/waypoints.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/counterup.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/isotop.pkgd.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/moment.min.js')}}"></script>
{{--    <script src="{{url('assets/front/js/vendors/date-picker.min.js')}}"></script>--}}
    <script src="{{url('assets/front/js/vendors/progressbar.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/slick.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/countdown.min.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/custom-scrollbar.js')}}"></script>
    <script src="{{url('assets/front/js/vendors/price-range.js')}}"></script>
    <script src="{{url('assets/front/js/app.js')}}"></script>
    <!--endbuild-->
        <!-- sweetalert2 js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if(session()->has('err_message'))
        $(document).ready(function () {
            Swal.fire({
                title:"{{read_lang_word('پیام','danger_msg')}}",
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
                title:"{{read_lang_word('پیام','success_msg')}}",
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
                title:"{{read_lang_word('پیام','danger_msg')}}",
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
        $(document).ready(function(){
            $("#exampleModal").modal('show');
        });
        document.getElementById("orderdatabtn").addEventListener("click", function() {
            $("#orderdatamodal").modal('show');
        });

        // if($("#pickadateandtimepickup")[0])
        // {
        //     $("#pickadateandtimepickup").flatpickr({
        //         enableTime: true,
        //         dateFormat: "Y-m-d H:i",
        //         disableMobile: "false"
        //     });
        // }
        // if($("#pickadateandtimereturn")[0])
        // {
        //     $("#pickadateandtimereturn").flatpickr({
        //         enableTime: true,
        //         dateFormat: "Y-m-d H:i",
        //         disableMobile: "false"
        //     });
        // }


    </script>
    @yield ('scripts')
    @if($contact_info->whatsapp_car)
    <div class="wat_sapp wat_sapp1 d-none-print">
    <a target="_blank" rel="noreferrer" href="https://api.whatsapp.com/send?phone={{$contact_info->whatsapp_car}}">
        <img class="social_img" src="{{url('assets/front/img/whatss.png')}}" alt="...">
    </a>
    </div>
    @endif

</body>
</html>
