<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');


Route::get('/storage/{path}', function ($path) {
    if (!auth()->check()) {
        abort(404); // ❌ not logged in
    }

    $file = storage_path('app/public/' . $path);

    if (!file_exists($file)) {
        abort(404); // ❌ file missing
    }

    // return file inline (for images/PDFs) or force download
    return response()->file($file);
})->where('path', '.*')->middleware('auth');

// Guest Users
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
});


// Authenticated users
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    // Route::middleware('role:Employee,true')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'])->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change-password');

// vehivle size type

    Route::resource('vehicle-types', App\Http\Controllers\Admin\Masters\VehicleTypeMasterController::class);
    Route::resource('self-vehicle', App\Http\Controllers\Admin\Masters\SelfVehicleController::class);
    Route::resource('master-group', App\Http\Controllers\Admin\Masters\MasterGroupController::class);
    Route::resource('group-master-category', App\Http\Controllers\Admin\Masters\MasterGroupCategoryController::class);
    Route::resource('sub-group-master', App\Http\Controllers\Admin\Masters\SubGroupMasterController::class);
    Route::get('/get-master-group-categories', [App\Http\Controllers\Admin\Masters\SubGroupMasterController::class, 'getMasterGroupCategories'])->name('get.master.group.categories');
    Route::resource('year-master', App\Http\Controllers\Admin\Masters\YearmasterController::class);
    Route::resource('state-master', App\Http\Controllers\Admin\Masters\StatemasterController::class);
    Route::resource('vendor-master', App\Http\Controllers\Admin\Masters\VendorMasterController::class);
    Route::resource('client-master', App\Http\Controllers\Admin\Masters\ClientmasterController::class);
    Route::resource('driver-master', App\Http\Controllers\Admin\Masters\DrivermasterController::class);
    Route::resource('gst-master', App\Http\Controllers\Admin\Masters\GstmasterController::class);
    Route::resource('fuel-master', App\Http\Controllers\Admin\Masters\FuelmasterController::class);
    Route::resource('trip-movement', App\Http\Controllers\Admin\Masters\TripMovementController::class);
    Route::resource('bank-master', App\Http\Controllers\Admin\Masters\BankmasterController::class);
    Route::resource('department-master', App\Http\Controllers\Admin\Masters\DepartmentmasterController::class);
    Route::resource('branch-master', App\Http\Controllers\Admin\Masters\BranchmasterController::class);
    Route::resource('company-billing-master', App\Http\Controllers\Admin\Masters\CompanybillingmasterrController::class);
    Route::resource('numbering-prefix-master', App\Http\Controllers\Admin\Masters\NumberingprefixController::class);
    Route::resource('invoicemaster', App\Http\Controllers\Admin\Masters\InvoicemasterController::class);
    Route::resource('invoiceadhoc', App\Http\Controllers\Admin\Masters\InvoicemasterController::class);
    Route::resource('invoicefixmaster', App\Http\Controllers\Admin\Masters\InvoicefixmasterController::class);

    Route::get('/filter-trips', [App\Http\Controllers\Admin\Masters\InvoiceMasterController::class, 'filterTrips'])->name('filter.trips');
    Route::post('/admin/masters/invoice/get-trips', [\App\Http\Controllers\Admin\Masters\InvoicemasterController::class, 'getTrips'])
    ->name('admin.invoice.getTrips');
    Route::get('get-trips', [App\Http\Controllers\Admin\Masters\InvoicemasterController::class, 'getTrips'])->name('get.trips');
    Route::get('get-filtered-trips', [App\Http\Controllers\Admin\Masters\InvoicemasterController::class, 'getFilteredTrips'])->name('get.filtered.trips');

    // Bulk edit (optional if you want to open modal with multiple records)
    Route::post('courier-trip-movement/bulk-add', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'bulkEdit'])->name('add-courier-trip-movement.bulkEdit');
    Route::post('courier-trip-movement/update-bulk', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'updateBulk'])->name('add-courier-trip-movement.updateBulk');
    Route::get('add-courier-trip-movement', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'index'])->name('add-courier-trip-movement.index');

    Route::post('trip-movement-courier/bulk-edit', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'courier_bulkEdit'])->name('trip-movement-courier.bulkEdit');
    Route::post('trip-movement-courier/update-bulk', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'courier_updateBulk'])->name('trip-movement-courier.updateBulk');
    Route::post('trip-movement-courier/bulk-delete', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class, 'courier_deleteBulk'])->name('trip-movement-courier.deleteBulk');

    Route::get('trip-movement-curier-list', [App\Http\Controllers\Admin\Masters\PODTripMomentController::class,'courier_tripmovement_list'])->name('trip-movement-curier-list.index');;

    Route::resource('trip-movement-pod', App\Http\Controllers\Admin\Masters\PODTripMomentController::class);
    Route::resource('trip-exp-detail', App\Http\Controllers\Admin\Masters\TripExpDetailController::class);

   



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class);
   


    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire'])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole'])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);

    Route::get('/pdf-test', [PdfTestController::class, 'generate']);

    Route::get('/tripmovements', [App\Http\Controllers\Admin\Masters\TripMovementController::class, 'index'])->name('tripmovements.index');


// });
});




Route::get('/php', function (Request $request) {
    if (!auth()->check())
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});