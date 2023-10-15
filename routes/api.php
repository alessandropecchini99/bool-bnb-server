<?php


use App\Http\Controllers\Api\ApartmentController as ApiApartmentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('apartments')->group(function () {
    // CRUDS
    // retrieve all apartments // http://127.0.0.1:8000/api/apartments/all
    Route::get('/', [ApiApartmentController::class, 'index']);
    //  retrieve apartment by id  http://127.0.0.1:8000/api/apartments/{id}
    Route::get('{id}', [ApiApartmentController::class, 'show']);
    //  retrieve apartments images // http://127.0.0.1:8000/api/apartments/{id}/images
    Route::get('{id}/images', [ApiApartmentController::class, 'getImages']);
    // retrieve all services related to apartment // http://127.0.0.1:8000/api/apartments/{id}/services
    Route::get('{id}/services', [ApiApartmentController::class, 'getServices']);
    //  retrieve apartments views // http://127.0.0.1:8000/api/apartments/{id}/views
    Route::get('{id}/views', [ApiApartmentController::class, 'getViews']);
    //  retrieve apartments images // http://127.0.0.1:8000/api/apartments/{id}/messages
    Route::get('{id}/messages', [ApiApartmentController::class, 'getMessages']);
    // Register view of an apartment in database // http://127.0.0.1:8000/api/apartments/{id}/register-apartment-view
    Route::post('{id}/register-apartment-view', [ViewController::class, 'registerApartmentView']);

});

//  retrieve apartments in radius // http://127.0.0.1:8000/api/search // use params: lat,lon,radius
Route::get('/search', [ApiApartmentController::class, 'search']);
//  retrieve apartments in radius // http://127.0.0.1:8000/api/send-message // use params: apartment_id, guest_name, guest_email, guest_message
Route::post('/send-message', [ApiApartmentController::class, 'sendMessage']);
// http://127.0.0.1:8000/api/get-auth-user
Route::get('/get-auth-user', [AuthenticatedSessionController::class, 'getAuthUser']);
