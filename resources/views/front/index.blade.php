@extends('front.layouts.front')
@section('styles')

@endsection
@section('body')
    <section class="box_header">
        <div class="w-75 mx-auto p-2">
            <div class="warpper">
                <input class="radio" id="one" name="group" type="radio" checked>
                <input class="radio" id="two" name="group" type="radio">
                <input class="radio" id="three" name="group" type="radio">

                <div class="tabs shadow d-flex justify-content-center">
                    <label class="tab" id="one-tab" for="one">All Status</label>
                    <label class="tab" id="two-tab" for="two">Projects</label>
                    <label class="tab" id="three-tab" for="three">Resell</label>
                </div>

                <div class="panels shadow_tab w-100 rounded-3">
                    <div class="panel p-4" id="one-panel">
                        <form action="" class="row align-items-end">
                            <div class="col-lg-10">
                                <div class="row">
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Project nane : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Country : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">City : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Zone : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 text-center">
                                <input type="submit" value="search" class="w-100 mt-3 search py-2">
                            </div>
                        </form>
                    </div>
                    <div class="panel p-4" id="two-panel">

                        <form action="" class="row align-items-end">
                            <div class="col-lg-10">
                                <div class="row">
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Project nane : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Country : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">City : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                    <label for="" class="col-lg-3">
                                        <p class="t_bold mb-2">Zone : </p>
                                        <input type="number" class="input_number py-2 px-2"
                                               placeholder="Property type" name="" id="">
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-2 text-center">
                                <input type="submit" placeholder="search" class="w-100 mt-3 search py-2">
                            </div>
                        </form>
                    </div>
                    <div class="panel p-4" id="three-panel">
                        <h2 class="semibold semibold text-center">coming soon</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg_box py-4 my-5">
        <div class="px-lg-5 container-xxl">
            <div class="w_center">
                <h2 class="semibold text-gray">Our features</h2>
                <p class="text-center regular text-gray">
                    The highest quality and most reliable projects
                </p>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach($projects as $project)

                    <div class="item mb-5">
                        <div class="w-100">
                            <a href="{{route('front.project.show',[app()->getLocale(),$project->id,$project->slug])}}">
                                <div class="card">
                                <div class="position-relative">
                                        @if(is_file($project->pic))
                                            <img src="{{url($project->pic)}}" class="card-img-top img_dark_opacity" alt="">
                                        @endif
                                        <div class="position-absolute bottom-0 start-0 w-100 p-3">
                                            <div class="d-flex justify-content-between align-items-center text-white ">
                                                <span class="fw-bold">${{$project->price}}</span>
                                                <div class="d-flex">
                                                    <div class="p-2 mx-1 my-bg-secondary rounded-1">
                                                        <img src="{{url('assets/front/img/full page projects.svg')}}"
                                                             style="width: 15px !important;" alt="">
                                                    </div>
                                                    <div class="p-2 mx-1 my-bg-secondary rounded-1">
                                                        <img src="{{url('assets/front/img/like projects.svg')}}" style="width: 15px !important;"
                                                             alt="">
                                                    </div>
                                                    <div class="p-2 mx-1 my-bg-secondary rounded-1">
                                                        <img src="{{url('assets/front/img/add projects.svg')}}" style="width: 15px !important;"
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="card-body">
                                        <h5 class="card-title f-15">{{read_lang($project,'name')}}</h5>
                                        <p class="extrallight f-15 mb-3"></p>

                                        <div class="d-flex justify-content-between flex-wrap mb-2 h-70">
                                            <div class="d-flex align-items-center">
                                                <span><img src="{{url('assets/front/img/bed.svg')}}" style="width: 25px;" alt=""></span>
                                                <span class="ms-2 t_bold">{{$project->feature_set(3,$project->id)}}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span><img src="{{url('assets/front/img/shower.svg')}}" style="width: 18px;" alt=""></span>
                                                <span class="ms-2 t_bold">{{$project->feature_set(4,$project->id)}}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span><img src="{{url('assets/front/img/car.svg')}}" style="width: 25px;" alt=""></span>
                                                <span class="ms-2 t_bold">{{$project->feature_set(6,$project->id)}}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span><img src="{{url('assets/front/img/metr.svg')}}" style="width: 20px;" alt=""></span>
                                                <span class="ms-2 t_bold">{{ $project->feature_set_lang(5,$project->id,'en') }}</span>
                                            </div>
                                        </div>
                                        {{-- <span class="regular fw-bold">APARTMENT</span>--}}
                                        <hr>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex">
                                                <img src="{{url('assets/front/img/user projects.svg')}}" style="width: 18px;" alt="">
                                                <span class="ms-2">Admin</span>
                                            </div>
                                            <div class="d-flex">
                                                <img src="{{url('assets/front/img/sanjagh projects.svg')}}" style="width: 18px;" alt="">
                                                <span class="ms-2">{{Carbon\Carbon::parse($project->created_at)->toFormattedDateString()}}</span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container-fluid">
        <div class="w_center">
            <h2 class="semibold text-gray">{{read_lang_word('صفحه-ورود','titr')}}</h2>
            <p class="text-center regular text-gray">
                Join the most amazing real estate platform
            </p>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-5 px-lg-5 position-relative">
                <div class="w_center">
                    <h3 class="semibold line_bottom_h3 position-relative text-gray">Log in</h3>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="input_login p-3 w-100 rounded-4 mb-3" placeholder="user name"  name="username">
                        @error('username')
                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                        <input type="password" class="input_login p-3 w-100 rounded-4" placeholder="password" name="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-start mb-3">
                            <a href="{{ route('password.request') }}" class="text-gray">
                                Forgot your
                                <span class="text-gray">password?</span>
                            </a>
                    </div>

                    <div class="text-center mb-4">
                        <input type="submit" value="Log in" class="search px-5 py-2 rounded-3 fw-bold f-22" name="" id="">
                    </div>

                    <div class="text-center text-gray">
                            <span>
                                Don’t have any account?
                                <span class="text-gray">Sign Up</span>
                            </span>
                    </div>
                </form>
                <div class="d-lg-block d-none">
                    <img src="{{url('assets/front/img/my globali top1.svg')}}" class="position-absolute" style="top: -70px; left: 50%;" alt="">
                    <img src="{{url('assets/front/img/my globali top1.svg')}}" class="position-absolute" style="top: -40px;left: 25px;" width="50px" alt="">
                    <img src="{{url('assets/front/img/my globali top2.svg')}}" class="position-absolute" style="top: -40px;right: 25px;" width="20px" alt="">
                    <img src="{{url('assets/front/img/my globali top2.svg')}}" class="position-absolute" style="top: 40%;left: 5px;" width="20px" alt="">
                </div>

            </div>
            <div class="col-lg-7 position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 262.4 236.5">
                    <defs>
                        <style>
                            .a {
                                fill: #4700dfa3;
                                fill-opacity: 0.42;
                                fill-rule: evenodd;
                            }
                        </style>
                    </defs>
                    <path class="a"
                          d="M84.5.3C72.1.3,59-.8,46.7,1.1,37.4,6.6,29.6,11.6,28.2,22.3a38.3,38.3,0,0,0,2.7,12.4c2.8,6.3,9,8.3,8.3,17.7-3.8,12.9-14.1,12.1-14.1,25,2.5,8.3,4.6,13.7,13.4,19.9s19.7,8.1,23.3,14.5c1,3.9,2.4,5.3,5.1,7.7,5.6,10.7,2.3,21.7,10.8,30.9,4.7,5.1,22.9,7.8,29.5,8.2l10.3.3c7.3.1,17.4.1,17.2,10.2-11.8,35.3,13.5,20.4,22.3,30.4,4.2,4.6,4.4,11.6,4.5,17.6,1.8,11.5,15.7,16,26.4,18.1,5.1.9,10.7.4,15.9.4h58.6V.3H57M84.5.3Z"
                          transform="translate(0 0)" />
                    <path class="a"
                          d="M75.2,1c-13.1,0-26.9-1-39.8.9-9.8,5.5-18,10.4-19.5,21.2a35.5,35.5,0,0,0,2.8,12.3c3,6.4,9.5,8.3,8.7,17.7C23.5,66,12.6,65.2,12.6,78.2c2.6,8.2,4.9,13.6,14.1,19.8s20.7,8.1,24.6,14.6c1,3.8,2.5,5.2,5.3,7.6C62.5,131,59,141.9,68,151.1c5,5.1,24.1,7.9,31,8.3l10.9.3c7.6,0,18.3.1,18.1,10.1-12.4,35.3,14.2,20.4,23.4,30.5,4.4,4.5,4.7,11.6,4.8,17.6,1.9,11.5,16.5,15.9,27.8,18,5.3,1,11.2.4,16.7.4h61.7V1H46.2m29,0Z"
                          transform="translate(0 0)" />
                    <path class="a"
                          d="M65.7.3C51.9.3,37.5-.8,23.9,1.1,13.6,6.6,5,11.6,3.4,22.3a36.3,36.3,0,0,0,3,12.4C9.5,41,16.3,43,15.5,52.4,11.4,65.3,0,64.5,0,77.4c2.7,8.3,5.1,13.7,14.8,19.9s21.8,8.1,25.8,14.5c1.1,3.9,2.6,5.3,5.6,7.7,6.1,10.7,2.5,21.7,11.9,30.9,5.3,5.1,25.3,7.8,32.7,8.2l11.4.3c8,.1,19.3.1,19,10.2-13.1,35.3,14.9,20.4,24.6,30.4,4.6,4.6,4.9,11.6,5,17.6,2,11.5,17.4,16,29.3,18.1,5.6.9,11.7.4,17.4.4h64.9V.3H35.3M65.7.3Z"
                          transform="translate(0 0)" />
                </svg>

                <div class="p-4">
                    <img src="{{url('assets/front/img/png/main_logo.png')}}" class="position-absolute top-0 end-0 logo_res" alt="">
                </div>


                <img src="{{url('assets/front/img/my globali top1.svg')}}" class="position-absolute" style="top: 50%;left: 0;" width="30px" alt="">
            </div>
        </div>
    </section>

    <section class="my-5 bg_box py-2">
        <div class="pt-4">
            <div class="w_center">
                <div class="d-flex align-items-end justify-content-center mb-2">
                    <h3 class="semibold mb-0 text-gray">A little about</h3>
                    <img src="{{url('assets/front/img/png/logo1png.png')}}" class="ms-2" width="150px" alt="">
                </div>
                <p class="text-center f-22 regular text-gray">
                    Our genius lies in the simplicity and efficiency of our platform
                </p>
            </div>
            <div class="container">
                <div class="row align-items-center">
                <div class="col-lg-7">
                <h4 class="fw-bold">Our Mission :</h4>
                <div id="box_rt13" class="box-sm-minified">
                    <p class="regulary text_justify mb-4">
                        At Globali, we are on a mission to revolutionize the real estate industry by providing a platform that connects property sales offices and real estate consultants with their clients in a seamless and efficient manner. Our platform is designed to streamline the process of buying and selling properties by providing easy access to up-to-date property listings, expert advice from experienced consultants, and a range of tools and resources to help both buyers and sellers make informed decisions.
                    </p>
                    <p class="regulary text_justify mb-4">
                        Our focus is on creating a global network of real estate professionals, enabling them to work together to provide the best possible service to their clients. We understand that buying or selling a property can be a complex and stressful process, and our goal is to make it as simple and hassle-free as possible. By bringing together the best minds in the industry and leveraging the latest technology, we are confident that we can help our clients achieve their real estate goals.
                    </p>
                        <p class="regulary text_justify mb-2">
                            We started our work in Istanbul, but our vision is to expand our platform to other cities and countries around the world, making it the go-to resource for anyone looking to buy or sell property. We believe that by creating a truly global network of real estate professionals, we can help to transform the industry and provide better outcomes for everyone involved. So whether you are a buyer, seller, or consultant, we invite you to join us on this exciting journey and discover the power of Globali.                </p>
                </div>
                {{-- این فانکشن آیدی المنت مدنظر رو میگیره و کلاسش رو کم و زیاد میکنه و آی دی خودش رو برای اینکه بعد از اکشن حذف بشه  --}}
                <div class="float-start d-lg-none">
                    <button class="btn" id="btn_rt13" onclick="showMoreCrt567({boxId: 'box_rt13',remove_class: 'box-sm-minified',add_class: 'box-sm-minified-close', btnId: 'btn_rt13'})">Show More</button>
                </div>
                <div class="">
                    <div class="text-end pt-2 pb-2 mb-5">
                        <a href="{{route('front.about.us',[app()->getLocale()])}}" class="search px-3 py-1 rounded-2  f-17">Read more</a>
                    </div>
                </div>
                </div>
                <div class="col-lg-5">
                    <img src="https://myglobal.49295.ir/new_lang/assets/front/img/our mission.svg" class="w-100 pb-5" alt="">
                </div>
                </div>
            </div>
        </div>
    </section>



    <section class="container">
        <section class="my-5">
            <div class="w_center">
                <h3 class="semibold text-gray">Explore cities</h3>
                <p class="text-center f-22 regular text-gray">
                    Here you can study and check the advantages, features and attractions of different cities in detail
                </p>
            </div>


            <div class="row">
                <div class="col-lg-3 px-lg-4">
                    <div class="img_dark_opacity my-3 m-lg-0">
                        <img src="{{url('assets/front/img/png/istanbul.jpg')}}" class="rounded-3 fit w-100" height="490px" alt="">
                        <div class="position-absolute start-0 top-0 p-3 text-white">
                            <h4 class="semibold fw-bold">ISTANBUL</h4>
                            <p class="extrallight">211 properties</p>
                        </div>
                        <div class="position-absolute end-0 bottom-0 px-2 py-3 text-white">
                            <a href="{{route('front.blog.list',[app()->getLocale()])}}" class="semibold text-white">More details ></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="img_dark_opacity my-3 m-lg-0">
                        <img src="{{url('assets/front/img/png/istanbul.jpg')}}" class="rounded-3 fit w-100" height="490px" alt="">
                        <div class="position-absolute start-0 top-0 p-3 text-white">
                            <h4 class="semibold fw-bold">Ankara</h4>
                            <p class="extrallight">119 properties</p>
                        </div>
                        <div class="position-absolute end-0 bottom-0 px-2 py-3 text-white">
                            <a href="{{route('front.blog.list',[app()->getLocale()])}}" class="semibold text-white">More details ></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="img_dark_opacity my-3 m-lg-0">
                        <img src="{{url('assets/front/img/png/istanbul.jpg')}}" class="rounded-3 fit w-100" height="490px" alt="">
                        <div class="position-absolute start-0 top-0 p-3 text-white">
                            <h4 class="semibold fw-bold">Izmir</h4>
                            <p class="extrallight">121 properties</p>
                        </div>
                        <div class="position-absolute end-0 bottom-0 px-2 py-3 text-white">
                            <a href="{{route('front.blog.list',[app()->getLocale()])}}" class="semibold text-white">More details ></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 px-lg-4">
                    <div class="img_dark_opacity my-3 m-lg-0">
                        <img src="{{url('assets/front/img/png/istanbul.jpg')}}" class="rounded-3 fit w-100" height="490px" alt="">
                        <div class="position-absolute start-0 top-0 p-3 text-white">
                            <h4 class="semibold fw-bold">Antalya</h4>
                            <p class="extrallight">154 properties</p>
                        </div>
                        <div class="position-absolute end-0 bottom-0 px-2 py-3 text-white">
                            <a href="{{route('front.blog.list',[app()->getLocale()])}}" class="semibold text-white">More details ></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>


    <section class="container">
        <div class="w_center">
            <h3 class="semibold text-gray">Our Partners</h3>
        </div>
        <section class="my-5 partners">

            <div class="owl-carousel owl-theme">
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/Baker_Logo_RGB_Red.png')}}" class="logo" width="150px" alt="">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/Compass-Logo.png')}}"  class="logo" width="150px" alt="">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/Landmark_NewLogo-Header-1.png')}}"  class="logo" width="150px" alt="">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/listings-mls-realtor-mls-png-logo-10.png')}}" class="logo" width="150px" alt="">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/real-estate-logo-8FF68BA993-seeklogo.com.png')}}" class="logo" width="150px" alt="">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <img src="{{url('assets/front/img/real-estate-logo-942759067F-seeklogo.com.png')}}" class="logo" width="150px" alt="">
                    </div>
                </div>
            </div>

        </section>
    </section>
@endsection

@section('scripts')

@endsection
