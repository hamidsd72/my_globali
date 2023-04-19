<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\RealStateController;
use App\Http\Controllers\Panel\FavoriteController;
use App\Http\Controllers\Panel\BlogController;
use App\Http\Controllers\Panel\TeamController;
use App\Http\Controllers\Panel\ClientController;
use App\Http\Controllers\Panel\NetworkController;
use App\Http\Controllers\Panel\IncomeController;
use App\Http\Controllers\Panel\AppointmentController;
use App\Http\Controllers\Panel\LeadOfferController;
use App\Http\Controllers\Panel\ProjectController;
use App\Http\Controllers\Panel\InsightController;
use App\Http\Controllers\Panel\D3BoxController;
use App\Http\Controllers\Panel\competitorsController;
use App\Http\Controllers\Panel\SalesOfficesController;
use App\Http\Controllers\Panel\AgentsController;
use App\Http\Controllers\Panel\ManageClientsController;
use App\Http\Controllers\Panel\InvoicesController;
use App\Http\Controllers\Panel\KycController;


Route::get('/', [PanelController::class,'index'])->name('index');
Route::get('authentication', [PanelController::class,'authentication_index'])->name('authentication.index');
Route::post('authentication/submit', [PanelController::class,'authentication_submit'])->name('authentication.submit');
Route::get('authentication/show', [PanelController::class,'authentication_show'])->name('authentication.show');
Route::get('profile', [PanelController::class,'profile'])->name('profile');
Route::get('profile/edit', [PanelController::class,'profile_edit'])->name('profile.edit');
Route::post('profile/update', [PanelController::class,'profile_update'])->name('profile.update');
Route::get('offers', [PanelController::class,'offers'])->name('reale_state.offers');

Route::get('reale_state/filter/{cat?}', [RealStateController::class,'filter'])->name('reale_state.search');
Route::get('reale_state/{cat?}/', [RealStateController::class,'index'])->name('reale_state.index');
Route::get('reale_state/filter_country/{type}', [RealStateController::class,'filter_country'])->name('reale_state.filter_country');

Route::get('/favorites', [FavoriteController::class,'index'])->name('favorites.index');

Route::get('/blogs/{type?}', [BlogController::class,'index'])->name('blog.index');
Route::get('/blog/{type}/show/{id}', [BlogController::class,'show'])->name('blog.show');

Route::get('/team', [TeamController::class,'index'])->name('Team.index');
Route::get('/team-show/{id}', [TeamController::class,'show'])->name('Team.show');

Route::get('/clients', [ClientController::class,'index'])->name('clients.index');
Route::get('/client-show/{id}', [ClientController::class,'show'])->name('clients.show');

Route::get('/network', [NetworkController::class,'index'])->name('network.index');

Route::get('/income', [IncomeController::class,'index'])->name('income.index');

Route::get('/appointment', [AppointmentController::class,'index'])->name('appointment.index');
Route::get('/appointment/create/{id}', [AppointmentController::class,'create'])->name('appointment.create');
Route::post('/appointment/store', [AppointmentController::class,'store'])->name('appointment.store');
Route::get('/appointment/confirmation/{id}', [AppointmentController::class,'confirmation'])->name('appointment.confirmation');
Route::get('/appointment/reject/{id}', [AppointmentController::class,'reject'])->name('appointment.reject');
Route::get('/appointment/edit/{id}', [AppointmentController::class,'edit'])->name('appointment.edit');
Route::post('/appointment/update/{id}', [AppointmentController::class,'update'])->name('appointment.update');

Route::get('/lead_offer', [LeadOfferController::class,'index'])->name('lead_offer.index');
Route::get('/lead_offer/{userid}', [LeadOfferController::class,'user_index'])->name('lead_offer.user.index');
Route::get('/lead_offer/{projectid}/create', [LeadOfferController::class,'create'])->name('lead_offer.user.create');
Route::post('/lead_offer/{userid}/store', [LeadOfferController::class,'store'])->name('lead_offer.user.store');
Route::get('/lead_offer/{userid}/del/{item}', [LeadOfferController::class,'del'])->name('lead_offer.user.del');

// projects
Route::get('project-create', [ProjectController::class, 'create'])->name('project-create');
Route::post('project-store', [ProjectController::class, 'store'])->name('project-store');
Route::get('project-list', [ProjectController::class, 'index'])->name('project-list');
Route::get('project-edit/{id}', [ProjectController::class, 'edit'])->name('project-edit');
Route::patch('project-update/{id}', [ProjectController::class, 'update'])->name('project-update');
Route::delete('project-destroy/{id}', [ProjectController::class, 'destroy'])->name('project-destroy');
Route::get('project-video-delete/{id}', [ProjectController::class, 'video_delete'])->name('project-video-delete');
Route::post('project-sort', [ProjectController::class, 'sort_item'])->name('project-sort');
Route::get('project-photo-destroy/{id}', [ProjectController::class, 'photo_destroy'])->name('project-photo-destroy');
Route::get('project-status/{id}/{status}', [ProjectController::class, 'status'])->name('project-status');

Route::get('/insight', [InsightController::class,'index'])->name('insight.index');
Route::get('/insight/{id}', [InsightController::class,'show'])->name('insight.show');

Route::get('/3DBox', [D3BoxController::class,'index'])->name('3DBox.index');
Route::get('/3DBox/create', [D3BoxController::class,'create'])->name('3DBox.create');
Route::post('/3DBox/store', [D3BoxController::class,'store'])->name('3DBox.store');

Route::get('/competitors', [competitorsController::class,'index'])->name('competitors.index');
Route::get('/competitors/show/{id}', [competitorsController::class,'show'])->name('competitors.show');

Route::get('/sales-offices', [SalesOfficesController::class,'index'])->name('sales.offices.index');
Route::get('/sales-offices-show/{id}', [SalesOfficesController::class,'show'])->name('sales.offices.show');

Route::get('/agents', [AgentsController::class,'index'])->name('agents.index');
Route::get('/agents-show/{id}', [AgentsController::class,'show'])->name('agents.show');

Route::get('/manage-clients', [ManageClientsController::class,'index'])->name('manage.clients.index');
Route::get('/manage-clients-show/{id}', [ManageClientsController::class,'show'])->name('manage.clients.show');

Route::get('/invoices', [InvoicesController::class,'index'])->name('invoices.index');
Route::get('/invoices/create', [InvoicesController::class,'create'])->name('invoices.create');
Route::post('/invoices/store', [InvoicesController::class,'store'])->name('invoices.store');
Route::get('/invoices/edit/{id}', [InvoicesController::class,'edit'])->name('invoices.edit');
Route::post('/invoices/update/{id}', [InvoicesController::class,'update'])->name('invoices.update');
Route::DELETE('/invoices/destroy/{id}', [InvoicesController::class,'destroy'])->name('invoices.destroy');


Route::get('/kyc', [KycController::class,'index'])->name('kyc.index');
Route::get('/kyc/show/{id}', [KycController::class,'show'])->name('kyc.show');
Route::get('/kyc/confirmation/{id}', [KycController::class,'confirmation'])->name('kyc.confirmation');
Route::get('/kyc/reject/{id}', [KycController::class,'reject'])->name('kyc.reject');


Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');

})->name('logout');

Route::get('coming-soon', function ()
{
    return view('panel.coming_soon.index');
})->name('coming-soon');