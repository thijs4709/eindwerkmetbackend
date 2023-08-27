<?php

use App\Http\Controllers\AdminBoxesController;
use App\Http\Controllers\AdminCardController;
use App\Http\Controllers\AdminMonsterAttributeController;
use App\Http\Controllers\AdminMonsterClassController;
use App\Http\Controllers\AdminMonsterSpecialTypeController;
use App\Http\Controllers\AdminMonsterTypeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminSpellTypeController;
use App\Http\Controllers\AdminTrapTypeController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

//Route::get("/", function () {
//    return view("home");
//});
Route::get('/', [HomeController::class, 'index'])->name('home_frontend');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/shop_detail_card/{card:slug}', [HomeController::class, 'shop_detail_card'])->name('shop_detail_card');
Route::get('/shop_detail_box/{box:slug}', [HomeController::class, 'shop_detail_box'])->name('shop_detail_box');
Route::post('/order_received', [HomeController::class, 'order_received'])->name('order_received');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/deliveries', [HomeController::class, 'deliveries'])->name('deliveries');
Route::post('/checkoutPay', [HomeController::class, 'checkoutPay'])->name('checkoutPay');
Route::get('/success',[HomeController::class, 'success'])->name('checkout.success');
Route::get('/cancel',[HomeController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook',[HomeController::class, 'webhook'])->name('checkout.wehook');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/cart', [HomeController::class, 'updateQuantity'])->name('quantity');
Route::post('/cartBulk', [HomeController::class, 'updateQuantityBulk'])->name('quantityBulk');
Route::get('/removeItem/{id}', [HomeController::class, 'removeItem'])->name('removeItem');
Route::get('/addToCart/{id}/{product_type}','App\Http\Controllers\HomeController@addToCart')->name('addToCart');
Route::get('contactformulier', [ContactController::class, 'create'])->name('contact.create');
Route::post('contactformulier', [ContactController::class, 'store'])->name('contact.store');

/**backend**/

Route::group(["prefix" => "admin", "middleware" => ['auth', 'verified']], function () {
    Route::get("/", [BackendController::class, "index",])->name("home");


    Route::group(["middleware" => 'admin'], function () {
        Route::resource("users", AdminUsersController::class);
        Route::get('users/edit/{user:id}',[AdminUsersController::class, 'edit'])->name('users.edit');
        Route::post('users/restore/{user}', [AdminUsersController::class, 'userRestore'])->name('admin.userrestore');

        // Boxes routes
        Route::resource('boxes', AdminBoxesController::class);
        Route::get('boxes/{box:slug}', [AdminBoxesController::class, 'show'])->name('boxes.show');
        Route::get('boxes/edit/{box:slug}', [AdminBoxesController::class, 'edit'])->name('boxes.edit');
        Route::post('boxes/restore/{post}', [AdminBoxesController::class, 'boxRestore'])->name('admin.boxrestore');

        // everything with cards routes
        Route::resource('cards', AdminCardController::class);
        Route::get('cards/{card:slug}', [AdminCardController::class, 'show'])->name('cards.show');
        Route::get('cards/edit/{card:slug}', [AdminCardController::class, 'edit'])->name('cards.edit');
        Route::post('cards/restore/{post}', [AdminCardController::class, 'cardRestore'])->name('admin.cardrestore');

        Route::resource('monstertype', AdminMonsterTypeController::class);
        Route::get('monstertype/edit/{monsterType:slug}', [AdminMonsterTypeController::class, 'edit'])->name('monstertype.edit');
        Route::post('monstertype/restore/{post}', [AdminMonsterTypeController::class, 'monsterTypeRestore'])->name('admin.monstertyperestore');

        Route::resource('monsterattribute', AdminMonsterAttributeController::class);
        Route::get('monsterattribute/edit/{monsterAttribute:slug}', [AdminMonsterAttributeController::class, 'edit'])->name('monsterattribute.edit');
        Route::post('monsterattribute/restore/{post}', [AdminMonsterAttributeController::class, 'monsterAttributeRestore'])->name('admin.monsterattributerestore');

        Route::resource('monsterspecialtype', AdminMonsterSpecialTypeController::class);
        Route::get('monsterspecialtype/edit/{monsterSpecialType:slug}', [AdminMonsterSpecialTypeController::class, 'edit'])->name('monsterspecialtype.edit');
        Route::post('monsterspecialtype/restore/{post}', [AdminMonsterSpecialTypeController::class, 'monsterSpecialTypeRestore'])->name('admin.monsterspecialtyperestore');

        Route::resource('monsterclass', AdminMonsterClassController::class);
        Route::get('monsterclass/edit/{monsterClass:slug}', [AdminMonsterClassController::class, 'edit'])->name('monsterclass.edit');
        Route::post('monsterclass/restore/{post}', [AdminMonsterClassController::class, 'monsterClassRestore'])->name('admin.monsterclassrestore');

        Route::resource('spelltype', AdminSpellTypeController::class);
        Route::get('spelltype/edit/{spellType:slug}', [AdminSpellTypeController::class, 'edit'])->name('spelltype.edit');
        Route::post('spelltype/restore/{post}', [AdminSpellTypeController::class, 'spellTypeRestore'])->name('admin.spelltyperestore');

        Route::resource('traptype', AdminTrapTypeController::class);
        Route::get('traptype/edit/{trapType:slug}', [AdminTrapTypeController::class, 'edit'])->name('traptype.edit');
        Route::post('traptype/restore/{post}', [AdminTrapTypeController::class, 'trapTypeRestore'])->name('admin.traptyperestore');

        Route::get('orders',[AdminOrderController::class,'index'])->name('order.index');
    });

});

Auth::routes(['verify' => true]);
