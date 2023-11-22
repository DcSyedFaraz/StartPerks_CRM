<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\PersionalFundingController;
use App\Http\Controllers\Client\BussinessFundingController;

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
require __DIR__.'/auth.php';

Route::get('/', 'AssignRoleDashboardController@index');
Route::get('/sidebarCategory', 'CategoryController@sidebarCategory');
Route::get('/get_users', 'AdminDashboardController@get_users');
//Customer Routes
Route::group(['middleware' => ['permission:customers_dashboard'], "prefix" => "client"], function () {


    //Customer Dashboard
    Route::get('/dashboard', [ClientDashboardController::Class,"index"])->name('client.dashboard');

    Route::get('/personal-funding', [PersionalFundingController::Class,"index"])->name('client.pf');
    Route::get('/bussiness-funding', [BussinessFundingController::Class,"index"])->name('client.bf');

    Route::post('/prequailfer-document', [PersionalFundingController::Class,"doc_upload"])->name('prequailfer.document.upload');
    Route::post('/card-upload', [PersionalFundingController::Class,"card_detail_upload"])->name('client.card.upload');

    Route::post('/stage-step', [ClientDashboardController::Class,"step_process"])->name('client.card.stage_step');


    Route::get('/bussiness-credit', [PersionalFundingController::Class,"index"])->name('client.bc');


    // // tickets
    // Route::get('/Tickets', 'CustomerDashboardController@Tickets')->name('tickets');


    // // profile
    // Route::get('/profile', 'CustomerDashboardController@profile')->name('profile');




});
 // products
 Route::get('/products/{slug}', 'ProdutController@getProducts')->name('products');
 Route::get('products/{id}/view','ProdutController@redirectUrl');

// Admin Routes
// Route::group(['middleware' => ['permission:dashboard']], function () {

    //Admin Dashboard
    Route::resource('/salesman', AdminDashboardController::class);
    // Plan
    Route::resource('plan', PaymentController::class);
    Route::post('subscription', 'PaymentController@subscription')->name("subscription.create");
    Route::get('cust', 'PaymentController@cust')->name("cust");
    //Admin Dashboard
    Route::get('/admin_dashboard', 'AdminDashboardController@index')->name('dashboard');

    Route::post('/announcements/imagesupload', 'AnnouncementsController@imagesupload')->name("imagesupload");
    //roles
    Route::resource('roles', RoleController::class);

    //users
    Route::resource('users', UserController::class);

    // ProdutController
    Route::resource('products', ProdutController::class);
    Route::get('products-sales', 'ProdutController@salesList')->name('products-sales');

    // ProdutController
     Route::get('addProduct', 'ProdutController@addProduct');
     Route::post('scrapUrlData', 'ProdutController@scrapUrlData');

    // banks
    Route::resource('banks', BanksController::class);

    // banks Cards
    Route::resource('bank_cards', BankCardsController::class);



    //permissions
    Route::resource('permissions', PermissionController::class);

    //category
    Route::resource('category', 'CategoryController');


    //ticket
    Route::resource('/Tickets', 'AdminDashboardController@Tickets');

    Route::post('/addNewSalesman','SellerController@addNewSalesman')->name('addNewSalesman');
    Route::resource('/salesmen', SellerController::class);
    Route::post('/salesmen/updateSeller/{id}', 'SellerController@updateSeller');

    //aggreament
    Route::resource('/aggreament', AggreamentController::class);
    Route::post('/aggreament/changeStatus', 'AggreamentController@changeStatus')->name('changeStatus');
    Route::get('/aggreamentdata', 'AggreamentController@currentAggreament');
    //customer
    Route::resource('/customers', CustomersController::class);
    Route::post('/customers/updateSeller/{id}', 'CustomersController@updateSeller');


// });
//Salesman Routes

Route::group(['middleware' => ['permission:salesman_dashboard']], function () {

            //Admin Dashboard
            Route::resource('salesman_dashboard', SalesmanDashboardController::class);

            //product
            // Route::get('products', 'SalesmanDashboardController@products');

            //customer
            Route::get('refreals', 'SalesmanDashboardController@customers');

            //announcement
            // Route::get('announcements', 'SalesmanDashboardController@announcements');

            //profile
            Route::get('profile', 'SalesmanDashboardController@profile');

            //get_customers
            Route::get('/get_users', 'SalesmanDashboardController@get_users');

});
 //Announcement
 Route::resource('/announcements', 'AnnouncementsController');
 Route::get('/getannouncements', 'AnnouncementsController@getAnnouncements');
 Route::post('/announcements/postComment', 'AnnouncementsController@PostComment')->name("postcomment");











