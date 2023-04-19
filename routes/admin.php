<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Access\PermissionCatController;
use App\Http\Controllers\Admin\Access\PermissionController;
use App\Http\Controllers\Admin\Access\RoleController;
use App\Http\Controllers\Admin\Form\AllFormController;
use App\Http\Controllers\Admin\Car\CarPicController;
use App\Http\Controllers\Admin\Car\CarBrandController;
use App\Http\Controllers\Admin\Car\CarCatController;
use App\Http\Controllers\Admin\Car\CarController;
use App\Http\Controllers\Admin\Car\OptionController;
use App\Http\Controllers\Admin\CarRent\RentController;
use App\Http\Controllers\Admin\Setting\LangSetController;
use App\Http\Controllers\Admin\Setting\ProfileController;
use App\Http\Controllers\Admin\Setting\SliderController;
use App\Http\Controllers\Admin\Setting\MetaController;
use App\Http\Controllers\Admin\Setting\AboutController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\ContactController;
use App\Http\Controllers\Admin\Setting\UploadController;
use App\Http\Controllers\Admin\Setting\SelectController;
use App\Http\Controllers\Admin\Setting\CrmLangController;
use App\Http\Controllers\Admin\Setting\SiteWordController;
use App\Http\Controllers\Admin\Setting\SeenController;
use App\Http\Controllers\Admin\User\UserWorkController;
use App\Http\Controllers\Admin\User\UserApiController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserAgentController;
use App\Http\Controllers\Admin\User\UserOtherController;
use App\Http\Controllers\Admin\Blog\ArticleController;
use App\Http\Controllers\Admin\Blog\NewsController;
use App\Http\Controllers\Admin\Other\ServiceController;
use App\Http\Controllers\Admin\Other\FaqController;
use App\Http\Controllers\Admin\Gallery\GalleryController;


use App\Http\Controllers\Admin\Other\AdController;
use App\Http\Controllers\Admin\Other\BannerController;
use App\Http\Controllers\Admin\Other\InterviewController;
use App\Http\Controllers\Admin\Other\MemoryController;
use App\Http\Controllers\Admin\Other\SoundController;
use App\Http\Controllers\Admin\Other\ReportController;
use App\Http\Controllers\Admin\Other\NoteController;

// NEW ROUTES
use App\Http\Controllers\Admin\RealState\ProjectFeatureController;
use App\Http\Controllers\Admin\RealState\VillaCategoryController;

//Access
Route::resource('permissionCat', PermissionCatController::class);
Route::resource('permission', PermissionController::class);
Route::resource('role', RoleController::class);

//Setting
Route::get('seen-list', [SeenController::class,'index'])->name('seen.index');

//Setting
Route::get('profile', [ProfileController::class,'show'])->name('profile.show');
Route::patch('profile/{id}/update', [ProfileController::class,'update'])->name('profile.update');

Route::resource('lang-set', LangSetController::class);
Route::get('lang-set-status/{id}/{type}/{status}', [LangSetController::class,'status'])->name('lang-set.status');

Route::resource('meta', MetaController::class);
Route::get('meta-status/{id}/{type}/{status}', [MetaController::class,'status'])->name('meta.status');

Route::resource('crm-lang', CrmLangController::class);

Route::resource('about', AboutController::class);

Route::resource('setting', SettingController::class);
Route::post('setting/percent/{id}', [SettingController::class,'percent'])->name('setting.percent');
Route::get('pic-delete/{id}', [SettingController::class,'delete_pic'])->name('pic.delete');

Route::resource('contact', ContactController::class);

Route::resource('upload', UploadController::class);

Route::resource('site-word', SiteWordController::class);

Route::resource('select', SelectController::class);
Route::get('select-status/{id}/{type}/{status}', [SelectController::class,'status'])->name('select.status');

Route::resource('slider', SliderController::class);
Route::get('slider-status/{id}/{type}/{status}', [SliderController::class,'status'])->name('slider.status');

//Car
Route::resource('car-brand', CarBrandController::class);
Route::resource('car-cat', CarCatController::class);

Route::resource('car', CarController::class);
Route::get('car-export-excel/{rand}', [CarController::class,'export_excel'])->name('export.excel.car');
Route::get('car-ajax/{type}/{id}', [CarController::class,'ajax'])->name('ajax.car');
Route::get('car-nerkh/{id}', [CarController::class,'nerkh_get'])->name('nerkh.get.car');
Route::post('car-nerkh/{id}', [CarController::class,'nerkh_post'])->name('nerkh.post.car');
Route::get('car-img-list/{id}', [CarController::class,'img_list'])->name('car.img.list');
Route::get('car-img-delete/{id}', [CarController::class,'img_delete'])->name('car.img.delete');
Route::get('car-img-update/{id}', [CarController::class,'img_update'])->name('car.img.update');

Route::resource('car-option', OptionController::class);

Route::resource('car-pic', CarPicController::class);
Route::get('car-pic-status/{id}/{type}/{status}', [CarPicController::class,'status'])->name('car-pic.status');

//CarRent
Route::get('car-rent-company/{status}/{status_record}/{status_reserve?}', [RentController::class,'index'])->name('car.rent.index');
Route::get('car-rent-colleague', [RentController::class,'index_colleague'])->name('car.rent.colleague.index');
Route::get('car-rent-show/{id}', [RentController::class,'show'])->name('car.rent.show');
Route::get('car-rent-message', [RentController::class,'message'])->name('car.rent.message');

//UserCustomer
Route::resource('user-customer', UserController::class);
Route::get('user-customer-status/{id}/{type}/{status}', [UserController::class,'status'])->name('user-customer.status');

//UserWork
Route::resource('user-work', UserWorkController::class);
Route::get('user-work-status/{id}/{type}/{status}', [UserWorkController::class,'status'])->name('user-work.status');

//UserApi
Route::resource('user-api', UserApiController::class);
Route::get('user-api-status/{id}/{type}/{status}', [UserApiController::class,'status'])->name('user-api.status');

//UserAgent
Route::resource('user-agent', UserAgentController::class);
Route::get('user-agent-status/{id}/{type}/{status}', [UserAgentController::class,'status'])->name('user-agent.status');

//UserOther
Route::resource('user-other', UserOtherController::class);
Route::get('user-other-status/{id}/{type}/{status}', [UserOtherController::class,'status'])->name('user-other.status');

//Form
Route::get('form/contact/list', [AllFormController::class,'contact'])->name('form.contact.index');

//Blog
Route::resource('article', ArticleController::class);
Route::resource('news', NewsController::class);

//other
Route::resource('service', ServiceController::class);

//faq
Route::resource('faq', FaqController::class);

//Gallery
Route::resource('gallery', GalleryController::class);
Route::get('gallery-status/{id}/{type}/{status}', [GalleryController::class,'status'])->name('gallery.status');
Route::post('gallery-sort/{id}', [GalleryController::class,'sort'])->name('gallery.sort');
Route::get('gallery-delete/{id}', [GalleryController::class,'delete'])->name('gallery.delete');


//Other
Route::resource('ads', AdController::class);
Route::get('ads-status/{id}/{type}/{status}', [AdController::class,'status'])->name('ads.status');

Route::resource('banner', BannerController::class);
Route::get('banner-status/{id}/{type}/{status}', [BannerController::class,'status'])->name('banner.status');

Route::resource('memory', MemoryController::class);
Route::get('memory-status/{id}/{type}/{status}', [MemoryController::class,'status'])->name('memory.status');
Route::post('memory-sort/{id}', [MemoryController::class,'sort'])->name('memory.sort');
Route::get('memory-delete/{id}', [MemoryController::class,'delete'])->name('memory.delete');

Route::resource('sound', SoundController::class);
Route::get('sound-status/{id}/{type}/{status}', [SoundController::class,'status'])->name('sound.status');


// NEW ROUTES
// project-feature
Route::resource('project-feature', ProjectFeatureController::class);
// projects
Route::get('villa-category-create', [VillaCategoryController::class, 'create'])->name('villa-category-create');
Route::post('villa-category-store', [VillaCategoryController::class, 'store'])->name('villa-category-store');
Route::get('villa-category-list', [VillaCategoryController::class, 'index'])->name('villa-category-list');
Route::get('villa-category-edit/{id}', [VillaCategoryController::class, 'edit'])->name('villa-category-edit');
Route::patch('villa-category-update/{id}', [VillaCategoryController::class, 'update'])->name('villa-category-update');
Route::delete('villa-category-destroy/{id}', [VillaCategoryController::class, 'destroy'])->name('villa-category-destroy');
Route::get('villa-category-video-delete/{id}', [VillaCategoryController::class, 'video_delete'])->name('villa-category-video-delete');
Route::get('villa-category-video-delete-lang/{id}/{lang}', [VillaCategoryController::class, 'video_delete_lang'])->name('villa-category-video-delete-lang');
Route::post('villa-category-sort', [VillaCategoryController::class, 'sort_item'])->name('villa-category-sort');
Route::get('villa-category-photo-destroy/{id}', [VillaCategoryController::class, 'photo_destroy'])->name('villa-category-photo-destroy');
