<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'as' => 'dashboard.'], function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
Route::get('/campaigns', [DashboardController::class, 'campaigns'])->name('campaigns');
Route::get('/creatives', [DashboardController::class, 'creatives'])->name('creatives');
Route::get('/campaign/new', [DashboardController::class, 'newCampaign'])->name('campaign.new');
Route::get('/campaign/{id}/creatives', [DashboardController::class, 'addCreatives'])->name('campaign.add.creatives');
Route::post('/campaign/{id}/creatives', [DashboardController::class, 'uploadCreatives'])->name('campaign.upload.creatives');


Route::get('/campaign/{id}/edit', [DashboardController::class, 'editCampaign'])->name('campaign.edit');
Route::post('/campaign/{id}/update', [DashboardController::class, 'updateCampaign'])->name('campaign.update');
Route::post('/campaign/create', [DashboardController::class, 'createCampaign'])->name('campaign.create');


});
require __DIR__.'/auth.php';
