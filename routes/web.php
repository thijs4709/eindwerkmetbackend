<?php

use App\Http\Controllers\AdminBoxesController;
use App\Http\Controllers\AdminCardController;
use App\Http\Controllers\AdminCardTypeController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminMonsterAttributeController;
use App\Http\Controllers\AdminMonsterClassController;
use App\Http\Controllers\AdminMonsterSpecialTypeController;
use App\Http\Controllers\AdminMonsterTypeController;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminSpellTypeController;
use App\Http\Controllers\AdminTrapTypeController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItunesController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductsController;
use App\Models\Post;
use App\Models\ProductCategory;
use App\Models\User;
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
Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('contactformulier',[ContactController::class,'create'])->name('contact.create');
Route::post('contactformulier',[ContactController::class,'store'])->name('contact.store');
Route::get('/post/{post:slug}', [AdminPostsController::class,'post'])->name('frontend.post');
Route::get('/category/{category:slug}',[AdminCategoriesController::class,'category'])->name('category.category');

Route::get('/itunes', [ItunesController::class,'index'])->name('itunes.index');

/**backend**/

Route::group(["prefix" => "admin", "middleware" => ['auth','verified']], function () {
    Route::get("/", [
        BackendController::class,
        "index",
    ])->name("home");
//    Post routes
    Route::resource('posts', AdminPostsController::class,['except'=>['show']]);
    Route::get('posts/{post:slug}', [AdminPostsController::class, 'show'])->name('posts.show');
    Route::get('authors/{author:name}', [AdminPostsController::class, 'indexByAuthor'])->name('authors');
    Route::post('posts/restore/{post}',[AdminPostsController::class,'postRestore'])->name('admin.postrestore');
    // Category routes
    Route::resource('categories', AdminCategoriesController::class);
    // Comment routes
    Route::resource('comments',CommentController::class);
    //Product Routes
    Route::resource('products', ProductsController::class);
    Route::get('products/brand/{id}', [ProductsController::class, 'productsPerBrand'])->name('admin.productsPerBrand');
    Route::resource('brands', BrandsController::class);
    Route::resource('productcategories', ProductCategoryController::class);

    Route::group(["middleware" => 'admin'], function () {
        Route::resource("users", AdminUsersController::class);
        Route::post('users/restore/{user}',[AdminUsersController::class,'userRestore'])->name('admin.userrestore');
        Route::get('usersblade',[AdminUsersController::class,'index2'])->name('users.index2');
    });
    Route::resource('boxes', AdminBoxesController::class);
    Route::get('boxes/{box:slug}', [AdminBoxesController::class, 'show'])->name('boxes.show');
    Route::get('boxes/edit/{box:slug}', [AdminBoxesController::class, 'edit'])->name('boxes.edit');
    Route::post('boxes/restore/{post}',[AdminBoxesController::class,'boxRestore'])->name('admin.boxrestore');

    Route::resource('cards', AdminCardController::class);
    Route::get('cards/{card:slug}', [AdminCardController::class, 'show'])->name('cards.show');
    Route::get('cards/edit/{card:slug}', [AdminCardController::class, 'edit'])->name('cards.edit');
    Route::post('cards/restore/{post}',[AdminCardController::class,'cardRestore'])->name('admin.cardrestore');

    Route::resource('monstertype', AdminMonsterTypeController::class);
    Route::get('monstertype/edit/{monsterType:slug}', [AdminMonsterTypeController::class, 'edit'])->name('monstertype.edit');
    Route::post('monstertype/restore/{post}',[AdminMonsterTypeController::class,'monsterTypeRestore'])->name('admin.monstertyperestore');

    Route::resource('monsterattribute', AdminMonsterAttributeController::class);
    Route::get('monsterattribute/edit/{monsterAttribute:slug}', [AdminMonsterAttributeController::class, 'edit'])->name('monsterattribute.edit');
    Route::post('monsterattribute/restore/{post}',[AdminMonsterAttributeController::class,'monsterAttributeRestore'])->name('admin.monsterattributerestore');

    Route::resource('monsterspecialtype', AdminMonsterSpecialTypeController::class);
    Route::get('monsterspecialtype/edit/{monsterSpecialType:slug}', [AdminMonsterSpecialTypeController::class, 'edit'])->name('monsterspecialtype.edit');
    Route::post('monsterspecialtype/restore/{post}',[AdminMonsterSpecialTypeController::class,'monsterSpecialTypeRestore'])->name('admin.monsterspecialtyperestore');

    Route::resource('monsterclass', AdminMonsterClassController::class);
    Route::get('monsterclass/edit/{monsterClass:slug}', [AdminMonsterClassController::class, 'edit'])->name('monsterclass.edit');
    Route::post('monsterclass/restore/{post}',[AdminMonsterClassController::class,'monsterClassRestore'])->name('admin.monsterclassrestore');

    Route::resource('spelltype', AdminSpellTypeController::class);
    Route::get('spelltype/edit/{spellType:slug}', [AdminSpellTypeController::class, 'edit'])->name('spelltype.edit');
    Route::post('spelltype/restore/{post}',[AdminSpellTypeController::class,'spellTypeRestore'])->name('admin.spelltyperestore');

    Route::resource('traptype', AdminTrapTypeController::class);
    Route::get('traptype/edit/{trapType:slug}', [AdminTrapTypeController::class, 'edit'])->name('traptype.edit');
    Route::post('traptype/restore/{post}',[AdminTrapTypeController::class,'trapTypeRestore'])->name('admin.traptyperestore');

    Route::resource('cardtype', AdminCardTypeController::class);
    Route::get('cardtype/edit/{cardType:slug}', [AdminCardTypeController::class, 'edit'])->name('cardtype.edit');
    Route::post('cardtype/restore/{post}',[AdminCardTypeController::class,'cardTypeRestore'])->name('admin.cardtyperestore');
});

Auth::routes(['verify'=>true]);
