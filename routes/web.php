<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConsultationQuestionController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PsychologicalTestController;
use App\Http\Controllers\PsychologistController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTestController;
use App\Http\Controllers\WorkshopController;
use App\Models\User;
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

// Route::get('/role', [Controller::class, 'role']);

// site pages
Route::get('/search', [SiteController::class, 'search'])->name('search');
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::prefix('/workshops')->group(function () {
    Route::get('/', [WorkshopController::class, 'workshops'])->name('workshops');
    Route::get('/{workshop}', [WorkshopController::class, 'workshop'])->name('workshop');
});
Route::prefix('/tests')->group(function () {
    Route::get('/', [PsychologicalTestController::class, 'tests'])->name('tests');
    Route::get('/{test}', [PsychologicalTestController::class, 'test'])->name('test');
});
Route::prefix('/psychologists')->group(function () {
    Route::get('/{category?}', [PsychologistController::class, 'psychologists'])->name('psychologists');
    Route::get('/{psychologist}/profile', [PsychologistController::class, 'psychologist'])->name('psychologist');
});
Route::prefix('/blogs')->group(function () {
    Route::get('/', [ArticleController::class, 'blogs'])->name('blogs');
    Route::get('/{article}', [ArticleController::class, 'blog'])->name('blog');
});

// comments
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
// message
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store')->middleware('throttle:3,10');;


// auth needed
Route::middleware('auth')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/profile', [SiteController::class, 'profile'])->name('user.profile');
        Route::get('/edit', [SiteController::class, 'edit'])->name('user.edit');
        Route::post('/update/{user}', [SiteController::class, 'update'])->name('user.update');
        Route::get('/requests', [SiteController::class, 'requests'])->name('user.requests');
        Route::get('/workshops', [SiteController::class, 'workshops'])->name('user.workshops');
        Route::get('/tests', [SiteController::class, 'tests'])->name('user.tests');
        Route::prefix('/orders')->group(function () {
            Route::get('/', [UserController::class, 'orders'])->name('user.orders');
            Route::get('/{id}', [UserController::class, 'order'])->name('user.orders.show');
        });
    });
    // cart
    Route::prefix('/cart')->group(function () {
        Route::get('/', [CartController::class, 'cart'])->name('cart');
        Route::post('/add/{type}/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/item/{id}', [CartController::class, 'removeItem'])->name('cart.item.remove');
        Route::get('/checkout/{cart}', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout/{cart}', [CartController::class, 'store'])->name('cart.store');
    });
    Route::prefix('/cart')->group(function () {});
    Route::prefix('consultation')->name('consultations.')->group(function () {
        Route::get('create/{consultant?}', [ConsultationRequestController::class, 'create'])->name('create');
        Route::post('store', [ConsultationRequestController::class, 'store'])->name('store');
    });
});

// authentication
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard
Route::prefix('/dashboard')->middleware(['auth', 'role:admin'])->group(function () {
    // dashboard routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // categories
    Route::resource('categories', CategoryController::class);
    // psychologists
    Route::resource('psychologists', PsychologistController::class);
    // workshops
    Route::resource('workshops', WorkshopController::class);
    // articles
    Route::resource('articles', ArticleController::class);
    // psychological tests
    Route::resource('psychological-tests', PsychologicalTestController::class);
    Route::resource('user-tests', UserTestController::class);
    // coupons
    Route::resource('/coupons', CouponController::class)->except(['show']);
    // slider
    Route::resource('sliders', SliderController::class);
    // settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    // social links
    Route::resource('social-links', SocialLinkController::class);
    Route::post('/dashboard/social-links/bulk-update', [SocialLinkController::class, 'bulkUpdate'])->name('social-links.bulkUpdate');
    // about
    Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/about', [AboutController::class, 'update'])->name('about.update');
    Route::delete('/about/image/{id}', [AboutController::class, 'deleteImage'])->name('about.image.delete');
    // comments
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // contact
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    // users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggle-role');
    // Consultation
    Route::resource('consultations', ConsultationRequestController::class);
    Route::patch('/consultations/{consultation}/update-status', [ConsultationRequestController::class, 'updateStatus'])->name('consultations.update-status');
    // orders
    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/{id}', [OrderController::class, 'status'])->name('orders.status');
        Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('orders.delete');
    });
    // سوالات درخواست مشاوره
    Route::get('consultation-questions', [ConsultationQuestionController::class, 'index'])->name('consultation-questions.index');
    Route::post('consultation-questions/bulk-update', [ConsultationQuestionController::class, 'bulkUpdate'])->name('consultation-questions.bulkUpdate');
    Route::delete('consultation-questions/{id}', [ConsultationQuestionController::class, 'destroy'])
        ->name('consultation-questions.destroy');
});

// ajaxs
Route::get('/get-consultants-by-category/{category}', function ($categoryId) {
    $consultants = User::whereHas('categories', function ($query) use ($categoryId) {
        $query->where('categories.id', $categoryId);
    })->get(['id', 'name']);

    return response()->json($consultants);
});
