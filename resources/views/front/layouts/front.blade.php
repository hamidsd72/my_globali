<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{url('assets/front/css/font.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/header.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/footer.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/css/responsive.css')}}">

    <style>
        @media (max-width: 640px) {.box-sm-minified {max-height: 280px;overflow: hidden;}.box-sm-minified-close {max-height: 100%;}}
        .go_to_top {position: fixed;bottom: 28px;right: 20px;z-index: 9999;}
        .go_to_top_btn {height: 52px;width: 52px;background: sandybrown;border-radius: 50px;}
        .menu-fix {height: 112px;padding-top: 12px;right: 0px;}
        #maine-menu1 ul li a {color: whitesmoke;}
    </style>
    @yield('styles')
</head>

<body>
<header class="header  @if (\Request::route()->getName() != "front.index") header-page @endif @if (\Request::route()->getName() == "login") header-single @endif">
    <div class="header_opacity"></div>
    <!-- pc menu -->
    <nav id="maine-menu1" class="maine-menu1 position-relative d-lg-block d-none ">
        <div class="container-xxl">
            <div class="d-flex justify-content-between align-items-center">
                <menu class="d-flex align-items-center">
                    <div>
                        <img src="{{url('assets/front/img/png/main_logo.png')}}" style="object-fit: cover;" alt="logo" width="100px" height="100px">
                    </div>
                    <ul class="d-flex mb-0 line_bottom">
                        <li class="p-3"><a href="{{url('/')}}" class="fw-bold">Home</a></li>
                        <li class="p-3"><a href="{{route('front.about.us')}}" class="fw-bold">about us</a></li>
                        <li class="p-3"><a href="{{route('front.blog.list')}}" class="fw-bold">Explore cities</a></li>
                        <li class="p-3"><a href="" class="fw-bold">Agencys</a></li>
                        <li class="p-3"><a href="{{route('front.faq')}}" class="fw-bold">FAQ</a></li>
                    </ul>
                </menu>
                <div class="d-flex align-items-center">
                    <a href="#">
                        <img src="{{url('assets/front/img/user.svg')}}" alt="" width="30px">
                    </a>
    
                    <a href="{{route('front.guest.register')}}" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Sign up</a>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- mobile menu -->
    <nav class="position-relative d-lg-none menu-fix">
        <div class="d-flex justify-content-between align-items-center px-3">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                </svg>
            </button>

            <div>
                <img src="{{url('assets/front/img/png/main_logo.png')}}" alt="logo" width="200px">
            </div>

            <div class="d-flex align-items-center">
                <a href="#">
                    <img src="{{url('assets/front/img/user.svg')}}" alt="" width="30px">
                </a>

                <!-- <a href="#" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Sign up</a>
                <a href="#" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Login</a> -->
            </div>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <menu class=" ">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item position-relative p-3">
                            <a href="#" class="text-dark d-block">Home</a>
                        </div>
                        <div class="accordion-item position-relative p-3">
                            <a href="#" class="text-dark d-block">About us</a>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-About_cities">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#About_cities" aria-expanded="false" aria-controls="About_cities">
                                    Explore cities
                                </button>
                            </h2>
                            <div id="About_cities" class="accordion-collapse collapse" aria-labelledby="flush-About_cities" data-bs-parent="#accordionFlushExample">
                                <ul class="d-flex flex-column mb-0 line_bottom">
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 1</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 2</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 3</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 4</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 5</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-Agencys">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Agencys" aria-expanded="false" aria-controls="Agencys">
                                    Agencys
                                </button>
                            </h2>
                            <div id="Agencys" class="accordion-collapse collapse" aria-labelledby="flush-Agencys" data-bs-parent="#accordionFlushExample">
                                <ul class="d-flex flex-column mb-0 line_bottom">
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 1</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 2</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 3</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 4</a></li>
                                    <li class="p-3"><a href="#" class="fw-bold text-dark d-block">item 5</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="accordion-item position-relative p-3">
                            <a href="#" class="text-dark d-block">FAQs</a>
                        </div>

                        <div class="accordion-item position-relative p-3">
                            <a href="#" class="text-dark d-block">Contact us</a>
                        </div>
                    </div>
                </menu>
            </div>
        </div>

    </nav>
    @if(\Request::route()->getName() == "front.index")
        <div class="w_center text-white mt-5 pt-5 pt-mobile" style="background: #0000002e;">
            <h1 class="semibold">Welcome To Globali</h1>
            <p class="text-center f-22 extrallight">
                Welcome to Globali, your go-to platform for all your real estate needs. We provide comprehensive real estate services, connecting property sales offices and experienced consultants with clients worldwide.
            </p>
        </div>
    @endif
    @yield('header')
</header>
{{--<header class="header @if (\Request::route()->getName() != "front.index") header-page @endif @if (\Request::route()->getName() == "front.project.show") header-single @endif">
    <div class="header_opacity"></div>
    <nav id="header-section" class="container-xxl px-lg-5 position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <menu class=" d-flex align-items-center">
                <div>
                    <img src="{{url('assets/front/img/png/main_logo.png')}}" width="200px" alt="logo">
                </div>
                <ul class="d-flex mb-0 line_bottom">
                    <li class="p-3"><a href="#" class="fw-bold">Home</a></li>
                    @if(Auth::user())
                        @if(Auth::user()->hasRole('User'))
                            <li class="p-3"><a href="{{route('front.project.list')}}" class="fw-bold">{{read_lang_word('منو','real_estate')}}</a></li>
                            <li class="p-3"><a href="#" class="fw-bold">{{read_lang_word('منو','favorite_projects')}}</a></li>
                            <li class="p-3"><a href="#" class="fw-bold">{{read_lang_word('منو','favorite_projects')}}</a></li>
                            <li class="p-3"><a href="#" class="fw-bold">{{read_lang_word('منو','explore_cities')}}</a></li>
                            <li class="p-3"><a href="#" class="fw-bold">{{read_lang_word('منو','offers')}}</a></li>
                            <li class="p-3"><a href="#" class="fw-bold">{{read_lang_word('منو','estate_news')}}</a></li>
                        @endif
                    @else
                        <li class="p-3"><a href="{{route('front.about.us')}}" class="fw-bold">about us</a></li>
                        <li class="p-3"><a href="{{route('front.blog.list')}}" class="fw-bold">About cities</a></li>
                        <li class="p-3"><a href="" class="fw-bold">Agencys</a></li>
                        <li class="p-3"><a href="{{route('front.faq')}}" class="fw-bold">FAQs</a></li>
                    @endif

                </ul>
            </menu>
            <div class="d-flex align-items-center">
                <a href="#">
                    <img src="{{url('assets/front/img/user.svg')}}" width="30px" alt="">
                </a>
                @if(!Auth::user())
                    <a href="{{route('front.guest.register')}}" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Sign up</a>
                    <a href="{{route('front.guest.sign_up')}}" class="px-4 py-2 rounded-3 btn_log rounend-2 semibold">Login</a>
                @endif

            </div>
        </div>
    </nav>

    <div id="header-mobile" class="header-mobile d-flex align-items-center">
        <div class="header-mobile-left">
            <button class="btn toggle-button-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-justify" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button><!-- toggle-button-left -->
        </div><!-- .header-mobile-left -->
        <div class="header-mobile-center flex-grow-1">
            <div class="logo logo-mobile">
                <a href="{{url('/')}}">
                    <img src="{{url('assets/front/img/png/main_logo.png')}}" alt="Mobile logo" width="127" height="60">
                </a>
            </div>
        </div>

        <div class="header-mobile-right">
            <button class="btn toggle-button-right">
                <i class="houzez-icon icon-single-neutral-circle ml-1"></i>
            </button><!-- toggle-button-right -->
        </div><!-- .header-mobile-right -->

    </div>
    @if(\Request::route()->getName() == "front.index")
        <div class="w_center text-white mt-5 pt-5">
            <h1 class="semibold">Welcome To Globali</h1>
            <p class="text-center f-22 extrallight">
                Lorem ipsum is placeholder text commonly used in the graphic,
                print, and publishing industries for previewing
            </p>
        </div>
    @endif--}}
{{--    @yield('header')
</header>--}}

<div class="nav-mobile">
    <div class="main-nav navbar slideout-menu slideout-menu-left" id="nav-mobile">
        <ul id="mobile-main-nav" class="navbar-nav mobile-navbar-nav">
            <li class="nav-item menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor">
                <a class="nav-link " href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('front.about.us')}}">about us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('front.blog.list')}}">About cities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">Agencys</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">FAQs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">Login</a>
            </li>
        </ul>
    </div><!-- main-nav -->
</div>

<main id="main" class="@if (!request()->is('/')) bg-gray @endif">
    @yield('body')

</main>

<footer class="pt-5" id="footer">
    <div class="container">
        <div class="pt-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <h4 class="fw-bold">COMPANY ROADMAP</h4>
                        <p class="f-19">
                            Welcome to Globali, your go-to platform for all your real estate needs. We provide comprehensive real estate services, connecting property sales offices and experienced consultants with clients worldwide.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <ul class="footer_ul">
                                <li class="fw-bold">Pages</li>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <ul class="footer_ul">
                                <li class="fw-bold">Social Media</li>
                                <li><a href="#">Whatsapp</a></li>
                                <li><a href="#">YouTube</a></li>
                                <li><a href="#">Instagram</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <ul class="footer_ul">
                                <li class="fw-bold">Languages</li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pb-4">
                        <img src="{{url('assets/front/img/logofooter.png')}}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="text-center p-4 footer_end">
                <span class="extrallight">© 2023 Adib IT All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>

<div id="goToTop" class="go_to_top d-none">
    <button class="btn go_to_top_btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <img src="https://icons-for-free.com/iconfiles/png/512/arrow+up+chevronupcircle+circle+circle+icon+top+arrow+up+icon-1320185732363546123.png" alt="goToTop" class="w-100">
    </button>
</div>

<script src="{{url('assets/front/js/jquery.min.js')}}"></script>
<script src="{{url('assets/front/js/bootstrap.min.js')}}"></script>
<!-- javascript -->
<script src="{{url('assets/front/js/jquery.min.js')}}"></script>
<script src="{{url('assets/front/js/owl.carousel.js')}}"></script>
<script src="{{url('assets/front/js/main.js')}}"></script>
@yield('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function showMoreCrt567(data) {
        if (data.boxId) {
            let getBoxId2738273 = document.querySelector(`#${data.boxId}`)
            if (data.remove_class) {
                getBoxId2738273.classList.remove(data.remove_class)
            }
            if (data.add_class) {
                getBoxId2738273.classList.add(data.add_class)
            }
        }
        if (data.btnId) {document.querySelector(`#${data.btnId}`).classList.add('d-none')}
    }
    function watchScroll(data) {
        if (data.top) {
            let btnGoTo823238   = document.querySelector(`#${data.btnId}`)
            window.addEventListener('scroll', e => {
                if (btnGoTo823238) {
                    if (window.scrollY > data.top) {
                        btnGoTo823238.classList.remove('d-none')
                    } else {
                        btnGoTo823238.classList.add('d-none')
                    }
                }
            })
        }
    }
    watchScroll({btnId: 'goToTop', top: 280});
</script>
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


    $(document).ready(function(){
        $(document).scroll(function(){
            // x = $(document).scrollTop();
                    // if ( x > vm_number ) {
            $("#maine-menu1").addClass("menu-fix");
        });
    });
    $(function () {
        $(window).scroll(function () {
            var top_offset = $(window).scrollTop();
            if (top_offset == 0) {
                $('#maine-menu1').removeClass("menu-fix");
            } else {
                $('#maine-menu1').addClass("menu-fix");
            }
        })
    });
</script>
</body>

</html>