<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ZarinPallController;
use App\Http\Controllers\Front\PaymentController;

Route::get('lang/{locale}', function ($lang,$locale) {
    \Illuminate\Support\Facades\App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang_set');

Route::get('/register', [RegisterController::class,'index'])->name('guest.register');
Route::post('/sign_up', [RegisterController::class,'create'])->name('guest.sign_up');




Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/تأجير-السيارات-في-اسطنبول', [HomeController::class,'landingar'])->name('landing.ar');
Route::get('/اجاره-خودرو-در-استانبول', [HomeController::class,'landingfa'])->name('landing.fa');
Route::get('/rent-a-car-in-istanbul', [HomeController::class,'landingen'])->name('landing.en');
Route::get('/аренда-автомобиля-в-стамбуле', [HomeController::class,'landingru'])->name('landing.ru');

Route::get('/filter-car', [HomeController::class,'filter_car'])->name('filter.car');
Route::get('/reserve-car/{id}/{set?}', [HomeController::class,'reserve_car'])->name('reserve.car');
Route::get('/rent-car/level-1/{id}/{from}/{to}/{place}/{reserve_crm?}', [HomeController::class,'rent_car_level1'])->name('rent.car.level.1');
Route::get('/rent-car/level-1/{id}/show', [HomeController::class,'rent_car_level1_show'])->name('rent.car.level.1.show');
Route::post('/rent-car/level-1/post/{id}/{from}/{to}/{place}/{reserve_crm?}', [HomeController::class,'rent_car_level1_post'])->name('rent.car.level.1.post');

Route::get('/filter-car-type/{id}', [HomeController::class,'filter_car_id'])->name('filter.car.id');
//send message car
Route::post('/message/car/{id}/post', [HomeController::class,'car_post'])->name('message.car.post');
//payment
Route::get('/payment/send/{item_id}', [PaymentController::class,'send'])->name('payment.send');
Route::any('/payment/back', [PaymentController::class,'back'])->name('payment.back');
//zarinpal
Route::get('/zarin_pall/pay/{item_id}', [ZarinPallController::class,'pay'])->name('zarin_pall.pay');
Route::any('/zarin_pall/verify', [ZarinPallController::class,'verify'])->name('zarin_pall.verify');
// complete info
Route::get('/information/complete/{id}', [HomeController::class,'information_get'])->name('information.complete.get');
Route::post('/information/complete/post/{id}', [HomeController::class,'information_post'])->name('information.complete.post');
// Receipt
Route::get('/receipt/{id}', [HomeController::class,'receipt'])->name('receipt');
// about us
Route::get('/about-us', [HomeController::class,'about'])->name('about.us');

// Conditions
Route::get('/rental_conditions', [HomeController::class,'rental_conditions'])->name('rental_conditions');

// faqs
Route::get('/faqs', [HomeController::class,'faq'])->name('faq');

// contact us
Route::get('/contact-us', [HomeController::class,'contact'])->name('contact.us');
Route::post('/contact-us/post', [HomeController::class,'contact_post'])->name('contact.us.post');


//blogs
Route::get('/blogs/{type?}', [HomeController::class,'blog_list'])->name('blog.list');
Route::get('/blog/{type}/show/{id}', [HomeController::class,'blog_show'])->name('blog.show');

//services
Route::get('/services', [HomeController::class,'service_list'])->name('service.list');

// gallery image&video
Route::get('/gallery', [HomeController::class,'gallery'])->name('gallery');

//blogs
Route::get('/projects/{type?}', [HomeController::class,'projects'])->name('project.list');
Route::get('/project/{id}/{slug}', [HomeController::class,'project_show'])->name('project.show');

Route::get('/home', function (){
    return view('home');
});

Route::get('/counter', App\Http\Livewire\Counter::class);
Route::get('/verifyEmail', [HomeController::class, 'verifyEmail'])->name('verify.email');
Route::post('/verifyEmail/check', [HomeController::class, 'verifyEmail_check'])->name('verify.email.check');