<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\BackgroundController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\LogoUploadController;
use App\Http\Controllers\Front\CityController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\RestaurantPanel\RestaurantLoginController;
use App\Http\Controllers\Front\FoodController;
use App\Http\Controllers\Front\RestaurantMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantPanel\MenuController as RestaurantMenu;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\ItemTypeController;
use App\Http\Controllers\Admin\MenuItemsController;
use App\Http\Controllers\Admin\FoodTypeController;
use App\Http\Controllers\Front\RatingController;
use App\Http\Controllers\RestaurantPanel\BillingsController;
use App\Http\Controllers\RestaurantPanel\RestaurantItem;
use App\Http\Controllers\RestaurantPanel\SliderController as RestaurantSlider;
use App\Http\Controllers\RestaurantPanel\ItemTypeController as ItemTypeControllers;
use App\Http\Controllers\RestaurantPanel\FoodTypeController as FoodTypeControllers;
use Illuminate\Support\Facades\Auth;

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

Route::post('restaurant-check', [LoginController::class, 'restaurant_details_check'])->name('restaurant-check');
Route::post('restaurant-regiter', [RestaurantLoginController::class, 'restaurant_register_post'])->name('restaurant-regiter');
Route::post('/select_city', [HomeController::class, 'select_city'])->name('select_city');

// Route::post('search-bar', [HomeController::class, 'search_bar'])->name('search-bar');
Auth::routes();
Route::resource('food', FoodController::class);
Route::get('comming-soon', [UserController::class, 'comming'])->name('comming-soon');
Route::get('about', [HomeController::class, 'abount_us'])->name('about_us');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::resource('fooditem', RestaurantMenuController::class);
Route::resource('city', CityController::class);
Route::resource('rating', RatingController::class);
 Route::get('/{id}', [MenuController::class, 'menucard'])->name('menu-card');
Route::post('adminlogincheck', [AdminController::class, 'adminlogin_check'])->name('admin.login.check');
Route::get('admin/login', [Admincontroller::class, 'admin_login'])->name('adminLogin');
Route::prefix('restaurant-panel')->middleware('restaurant_check')->group(function () {
      Route::get('restaurant-menu/menu-card', [RestaurantMenu::class, 'view'])->name('view');
      Route::post('download-qr-code', [RestaurantMenu::class, 'downloadQrCode'])->name('download.qr.code');
      Route::post('change_categories', [FoodTypeControllers::class, 'change_categories'])->name('food-types.change_categories');

    Route::post('select-image', [RestaurantMenu::class, 'selectImage'])->name('select-image');
    Route::resource('restaurant-home', RestaurantLoginController::class);
    Route::resource('restaurant-menu', RestaurantMenu::class);
    Route::resource('restaurant-sliders', RestaurantSlider::class);
    Route::resource('restaurant-item', RestaurantItem::class);
    Route::resource('food-types', FoodTypeControllers::class);
    Route::resource('item-types', ItemTypeControllers::class);
    Route::get('menu-number/{id}', [RestaurantLoginController::class, 'menu_phone'])->name('restaurant.menu_phone');
    Route::post('post-menu-number/{id}', [RestaurantLoginController::class, 'post_menu_phone'])->name('restaurant.post_menu_phone');
    Route::post('change_password', [RestaurantLoginController::class, 'change_password'])->name('restaurant.change_password');
    Route::post('restaurant_offer', [RestaurantLoginController::class, 'offers'])->name('restaurant.offer');
    Route::post('restaurant_offer_delete', [RestaurantLoginController::class, 'offer_delete'])->name('restaurant.offer_delete');
     Route::get('background', [RestaurantMenu::class, 'backgrounds'])->name('restaurant.background');
    Route::get('background_add', [RestaurantMenu::class, 'background_add'])->name('restaurant.background_add');
    Route::post('background_post', [RestaurantMenu::class, 'background_post'])->name('restaurant.background_post');
    Route::post('background_delete/{id}', [RestaurantMenu::class, 'background_delete'])->name('restaurant.background_delete');
    Route::post('remove_background', [RestaurantMenu::class, 'remove_background'])->name('restaurant.remove_background');
    Route::resource('billing', BillingsController::class);
    Route::get('invoice/{id}', [BillingsController::class, 'invoice'])->name('restaurant.invoice');


});
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('restaurant/login', [RestaurantLoginController::class, 'restaurant_login'])->name('restaurant-login');
Route::get('restaurant/register', [RestaurantLoginController::class, 'restaurant_register'])->name('restaurant-register');
Route::prefix('admin')->middleware(['admin_login_check', 'is_admin'])->group(function () {
    Route::resource('home', DashboardController::class)->names([
        'index' => 'admin.home',
    ]);
    Route::resource('restaurant', RestaurantController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('item-type', ItemTypeController::class);
    Route::resource('menu-item', MenuItemsController::class);
    Route::resource('background', BackgroundController::class);
    Route::post('get-image', [MenuController::class, 'getImage'])->name('get-image');
    Route::get('pending-restaurant', [RestaurantController::class, 'pending_restaurant'])->name('restaurant.pending');
    Route::post('pendign-restaurant-post/{id}', [RestaurantController::class, 'pending_restaurant_post'])->name('restaurant.verified');
    Route::post('selectimage', [MenuController::class, 'selectimage'])->name('update.card.image');
    Route::resource('sliders', SliderController::class);
    Route::resource('logo', SettingController::class);
    Route::resource('all-city', AdminCityController::class);
    Route::resource('change-password', ChangePasswordController::class);
    Route::resource('food-type', FoodTypeController::class);
    Route::get('qr-code-g', function () {
        \QrCode::size(500)
            ->format('png')
            ->generate('https://www.websyst.in/', public_path('images/qrcode.png'));
        return view('Admin.menu.show');
    });
    Route::post('admin_offer/{id}', [RestaurantController::class, 'admin_offer'])->name('admin.offers');
    Route::post('admin_offer_delete/{id}', [RestaurantController::class, 'admin_offer_delete'])->name('admin.offer_delete');

});
