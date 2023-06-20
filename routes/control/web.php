<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductBranchController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LeechController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ProductBranchOptionController;
use App\Http\Controllers\FlashController;
use App\Http\Controllers\CheckPaymentController;

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

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::group(['prefix' => '/home'], function () {
	Route::group(['middleware' => 'auth'], function(){

		Route::prefix('branches')->group(function () {
			Route::get('/', [BranchController::class,'home']);
      Route::get('add', [BranchController::class,'add']);
      Route::post('create', [BranchController::class,'input']);
      Route::get('edit/{id}', [BranchController::class,'edit']);
      Route::post('update', [BranchController::class,'update_be']);
      Route::get('delete/{uid}', [BranchController::class,'destroy']);
    });

    Route::prefix('banner')->group(function () {
      Route::get('/', [BannerController::class,'home']);
      Route::get('add', [BannerController::class,'add']);
      Route::post('create', [BannerController::class,'input']);
      Route::get('edit/{id}', [BannerController::class,'edit']);
      Route::post('update', [BannerController::class,'update_be']);
      Route::get('delete/{id}', [BannerController::class,'destroy']);
      Route::get('active/{id}', [BannerController::class,'active']);
      Route::get('non-active/{id}', [BannerController::class,'nonactive']);
    });

    Route::prefix('categories')->group(function () {
			Route::get('/', [CategoryController::class,'home']);
      Route::get('add', [CategoryController::class,'add']);
      Route::post('create', [CategoryController::class,'input']);
      Route::get('edit/{id}', [CategoryController::class,'edit']);
      Route::post('update', [CategoryController::class,'update_be']);
      Route::get('delete/{uid}', [CategoryController::class,'destroy']);
    });

    Route::prefix('products')->group(function () {
			Route::get('/', [ProductController::class,'home']);
      Route::get('add', [ProductController::class,'add']);
      Route::post('create', [ProductController::class,'input']);
      Route::get('edit/{id}', [ProductController::class,'edit']);
      Route::post('update', [ProductController::class,'update_be']);
      Route::get('delete/{uid}', [ProductController::class,'destroy']);
    });

    Route::prefix('webinars')->group(function () {
			Route::get('/', [WebinarController::class,'home']);
      Route::get('add', [WebinarController::class,'add']);
      Route::post('create', [WebinarController::class,'input']);
      Route::get('edit/{id}', [WebinarController::class,'edit']);
      Route::post('update', [WebinarController::class,'update_be']);
      Route::get('delete/{uid}', [WebinarController::class,'destroy']);
    });

    Route::prefix('blog-categories')->group(function () {
			Route::get('/', [BlogCategoryController::class,'home']);
      Route::get('add', [BlogCategoryController::class,'add']);
      Route::post('create', [BlogCategoryController::class,'input']);
      Route::get('edit/{id}', [BlogCategoryController::class,'edit']);
      Route::post('update', [BlogCategoryController::class,'update_be']);
      Route::get('delete/{uid}', [BlogCategoryController::class,'destroy']);
    });

    Route::prefix('tags')->group(function () {
			Route::get('/', [TagController::class,'home']);
      Route::get('add', [TagController::class,'add']);
      Route::post('create', [TagController::class,'input']);
      Route::get('edit/{id}', [TagController::class,'edit']);
      Route::post('update', [TagController::class,'update_be']);
      Route::get('delete/{uid}', [TagController::class,'destroy']);
    });

    Route::prefix('blogs')->group(function () {
      Route::get('/', [BlogController::class,'home']);
      Route::get('add', [BlogController::class,'add']);
      Route::post('create', [BlogController::class,'input']);
      Route::get('edit/{id}', [BlogController::class,'edit']);
      Route::post('update', [BlogController::class,'update_be']);
      Route::get('delete/{uid}', [BlogController::class,'destroy']);
      Route::get('active/{uid}', [BlogController::class,'active']);
      Route::get('non-active/{uid}', [BlogController::class,'nonactive']);
    });

    Route::prefix('users')->group(function () {
			Route::get('/', [UserController::class,'home']);
      Route::get('add', [UserController::class,'add']);
      Route::post('create', [UserController::class,'input']);
      Route::get('edit/{id}', [UserController::class,'edit']);
      Route::get('edit-pass/{id}', [UserController::class,'edit_pass']);
      Route::post('update', [UserController::class,'update_be']);
      Route::post('update-pass', [UserController::class,'updatepass_be']);
      Route::get('delete/{uid}', [UserController::class,'destroy']);
    });

    Route::prefix('branch_products')->group(function () {
      Route::get('/', [ProductBranchController::class,'home']);
      Route::get('add', [ProductBranchController::class,'add']);
      Route::post('create', [ProductBranchController::class,'input']);
      Route::get('edit/{id}', [ProductBranchController::class,'edit']);
      Route::post('update', [ProductBranchController::class,'update_be']);
      Route::get('delete/{uid}', [ProductBranchController::class,'destroy']);
    });

    Route::prefix('option_products')->group(function () {
      Route::get('/', [ProductBranchOptionController::class,'home']);
      Route::get('add', [ProductBranchOptionController::class,'add']);
      Route::post('create', [ProductBranchOptionController::class,'input']);
      Route::get('edit/{id}', [ProductBranchOptionController::class,'edit']);
      Route::post('update', [ProductBranchOptionController::class,'update_be']);
      Route::get('delete/{uid}', [ProductBranchOptionController::class,'destroy']);
    });

    Route::prefix('banners')->group(function () {
      Route::get('/', [GimmickController::class,'home']);
      Route::get('add', [GimmickController::class,'add']);
      Route::post('create', [GimmickController::class,'input']);
      Route::get('edit/{id}', [GimmickController::class,'edit']);
      Route::post('update', [GimmickController::class,'update_be']);
      Route::get('delete/{uid}', [GimmickController::class,'destroy']);
      Route::get('active/{uid}', [GimmickController::class,'active']);
      Route::get('non-active/{uid}', [GimmickController::class,'nonactive']);
    });

    Route::prefix('vouchers')->group(function () {
      Route::get('/', [VoucherController::class,'home']);
      Route::get('add', [VoucherController::class,'add']);
      Route::post('create', [VoucherController::class,'input']);
      Route::get('edit/{id}', [VoucherController::class,'edit']);
      Route::post('update', [VoucherController::class,'update_be']);
      Route::get('delete/{uid}', [VoucherController::class,'destroy']);
      Route::get('active/{uid}', [VoucherController::class,'active']);
      Route::get('non-active/{uid}', [VoucherController::class,'nonactive']);
    });

    Route::prefix('QR-Voucher')->group(function () {
      Route::get('/', [QRController::class,'Voucherindex']);
    });

    Route::prefix('Claim-Voucher')->group(function () {
      Route::get('/', [QRController::class,'Customerindex']);
      Route::get('/export', [ExportExcelController::class,'export']);
    });

    Route::prefix('Merchant')->group(function () {
      Route::get('/', [QRController::class,'indexMerchant']);
      Route::get('add', [QRController::class,'addMerchant']);
      Route::post('create', [QRController::class,'inputMerchant']);
      Route::get('edit/{id}', [QRController::class,'editMerchant']);
      Route::post('update', [QRController::class,'updateMerchant']);
      Route::get('delete/{uid}', [QRController::class,'destroyMerchant']);
    });

    Route::prefix('Gift')->group(function () {
      Route::get('/', [QRController::class,'indexGift']);
      Route::get('add', [QRController::class,'addGift']);
      Route::post('create', [QRController::class,'inputGift']);
      Route::get('edit/{id}', [QRController::class,'editGift']);
      Route::post('update', [QRController::class,'updateGift']);
      Route::get('delete/{uid}', [QRController::class,'destroyGift']);
    });

    Route::prefix('promos')->group(function () {
      Route::get('/', [PromoController::class,'home']);
      Route::get('add', [PromoController::class,'add']);
      Route::post('create', [PromoController::class,'input']);
      Route::get('edit/{id}', [PromoController::class,'edit']);
      Route::post('update', [PromoController::class,'update_be']);
      Route::get('delete/{uid}', [PromoController::class,'destroy']);
      Route::get('active/{uid}', [PromoController::class,'active']);
      Route::get('non-active/{uid}', [PromoController::class,'nonactive']);
    });

    Route::prefix('registrations')->group(function () {
      Route::get('/', [RegistrationController::class,'home']);
    });

    Route::prefix('register')->group(function () {
      Route::get('/', [RegistrationController::class,'regis']);
    });

    Route::prefix('mgm')->group(function () {
      Route::get('/', [RegistrationController::class,'mgm_view']);
    });

    Route::prefix('filter')->group(function () {
      Route::get('/', [HomeController::class,'filter']);
    });

    Route::prefix('bookings')->group(function () {
      Route::get('/', [LeechController::class,'home']);
    });

    Route::prefix('payments')->group(function () {
      Route::get('/', [PaymentController::class,'home']);
      Route::get('/paid/{id}', [PaymentController::class,'paid']);
      Route::get('/reset/{id}', [PaymentController::class,'reset']);
    });

    Route::prefix('flash-sale')->group(function () {
      Route::get('/', [FlashController::class,'index']);
    });

	});
});

Route::get('/updateapp', function()
{
    exec('composer dump-autoload');
    echo 'composer dump-autoload complete';
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/config-cache', function() {
    Artisan::call('config:clear');
    return 'Clear Config cleared';
});

Route::get('/logout', [HomeController::class,'logout']);

Route::prefix('blogs/')->group(function () {
   Route::get('/', [BlogController::class,'view']);
   Route::get('/preview/{slug}', [BlogController::class,'preview']);
   Route::get('/categories/{name}', [BlogController::class,'categories']);
   Route::get('/tags/{name}', [BlogController::class,'tags']);
   Route::get('/search',['uses' => [BlogController::class,'search_be','as' => 'search']]);
});

Route::prefix('banners/')->group(function () {
   Route::get('/', [GimmickController::class,'view']);
   Route::get('/preview/{slug}', [GimmickController::class,'preview']);
   Route::get('/categories/{name}', [GimmickController::class,'categories']);
   Route::get('/tags/{name}', [GimmickController::class,'tags']);
   Route::get('/search',['uses' => [GimmickController::class,'search','as' => 'search']]);
});

Route::get('/checkPay', [CheckPaymentController::class,'index']);
Route::get('/checkPayFlash', [CheckPaymentFlashController::class,'index']);
Route::get('/csrf', function(){
    return csrf_token();
});
