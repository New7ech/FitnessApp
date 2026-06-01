<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerRequestController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ShopController::class, 'home'])->name('home');

Route::prefix('panier')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/articles/{article}', [CartController::class, 'add'])->name('add');
    Route::patch('/', [CartController::class, 'update'])->name('update');
    Route::delete('/articles/{article}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/', [CartController::class, 'clear'])->name('clear');
});

Route::prefix('commande')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'show'])->name('show');
    Route::post('/', [CheckoutController::class, 'store'])->name('store');
    Route::get('/succes/{facture}', [CheckoutController::class, 'success'])->name('success');
    Route::get('/factures/{facture}/pdf', [CheckoutController::class, 'pdf'])->name('pdf');
});

Route::post('/contact', [CustomerRequestController::class, 'store'])->name('contact.store');

Route::get('/media/public/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.public');

Route::prefix('gestion')->group(function () {
    Route::get('/', [AccueilController::class, 'index'])->name('accueil');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('categories', CategorieController::class)->parameters([
        'categories' => 'categorie',
    ]);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('emplacements', EmplacementController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('factures', FactureController::class);
    Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPdf'])->name('factures.pdf');
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/requests/{customerRequest}', [AdminDashboardController::class, 'update'])->name('requests.update');
        Route::post('/requests/{customerRequest}/notify', [AdminDashboardController::class, 'notify'])->name('requests.notify');
        Route::delete('/requests/{customerRequest}', [AdminDashboardController::class, 'destroy'])->name('requests.destroy');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
