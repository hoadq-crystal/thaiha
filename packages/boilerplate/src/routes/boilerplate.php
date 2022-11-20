<?php

use Sebastienheyd\Boilerplate\Controllers\Auth\ForgotPasswordController;
use Sebastienheyd\Boilerplate\Controllers\Auth\LoginController;
use Sebastienheyd\Boilerplate\Controllers\Auth\RegisterController;
use Sebastienheyd\Boilerplate\Controllers\Auth\ResetPasswordController;
use Sebastienheyd\Boilerplate\Controllers\DatatablesController;
use Sebastienheyd\Boilerplate\Controllers\ImpersonateController;
use Sebastienheyd\Boilerplate\Controllers\LanguageController;
use Sebastienheyd\Boilerplate\Controllers\Logs\LogViewerController;
use Sebastienheyd\Boilerplate\Controllers\Select2Controller;
use Sebastienheyd\Boilerplate\Controllers\Users\RolesController;
use Sebastienheyd\Boilerplate\Controllers\Users\UsersController;
use Sebastienheyd\Boilerplate\Controllers\Product\ProductController;
use Sebastienheyd\Boilerplate\Controllers\Category\CategoriesController;
use Sebastienheyd\Boilerplate\Controllers\Articles\ArticlesController;
use Sebastienheyd\Boilerplate\Controllers\Articles\ContactsController;


Route::group([
    'prefix'     => config('boilerplate.app.prefix', ''),
    'domain'     => config('boilerplate.app.domain', ''),
    'middleware' => ['web', 'boilerplate.locale'],
    'as'         => 'boilerplate.',
], function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Language switch
    if (config('boilerplate.locale.switch', false)) {
        Route::post('language', [LanguageController::class, 'switch'])->name('lang.switch');
    }

    // Frontend
    Route::group(['middleware' => ['boilerplate.guest']], function () {
        // Login
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        // Registration
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.post');

        // Password reset
        Route::prefix('password')->as('password.')->group(function () {
            Route::get('request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
            Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
            Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
            Route::post('reset', [ResetPasswordController::class, 'reset'])->name('reset.post');
        });

        // First login
        Route::get('connect/{token?}', [UsersController::class, 'firstLogin'])->name('users.firstlogin');
        Route::post('connect/{token?}', [UsersController::class, 'firstLoginPost'])->name('users.firstlogin.post');
    });

    // Email verification
    Route::controller(RegisterController::class)->prefix('email')->middleware('boilerplate.auth')->as('verification.')->group(function () {
        Route::get('verify', 'emailVerify')->name('notice');
        Route::get('verify/{id}/{hash}', 'emailVerifyRequest')->name('verify');
        Route::post('verification-notification', 'emailSendVerification')->name('send');
    });

    // Backend
    Route::group(['middleware' => ['boilerplate.auth', 'ability:admin,backend_access', 'boilerplate.emailverified']], function () {
        // Impersonate another user
        if (config('boilerplate.app.allowImpersonate', false)) {
            Route::controller(ImpersonateController::class)->prefix('impersonate')->as('impersonate.')->group(function () {
                Route::post('/', 'impersonate')->name('user');
                Route::get('stop', 'stopImpersonate')->name('stop');
                Route::post('select', 'selectImpersonate')->name('select');
            });
        }

        // Dashboard
        Route::get('/', [config('boilerplate.menu.dashboard'), 'index'])->name('dashboard');

        // Session keep-alive
        Route::post('keep-alive', [UsersController::class, 'keepAlive'])->name('keepalive');

        // Datatables
        Route::post('datatables/{slug}', [DatatablesController::class, 'make'])->name('datatables');
        Broadcast::channel('dt.{name}.{signature}', function ($user, $name, $signature) {
            return channel_hash_equals($signature, 'dt', $name);
        });

        // Select2
        Route::post('select2', [Select2Controller::class, 'make'])->name('select2');

        // Roles and users
        Route::resource('roles', RolesController::class)->except('show')->middleware(['ability:admin,roles_crud']);
        Route::resource('users', UsersController::class)->middleware('ability:admin,users_crud')->except('show');

        // Profile
        Route::controller(UsersController::class)->prefix('userprofile')->as('user.')->group(function () {
            Route::get('/', 'profile')->name('profile');
            Route::post('/', 'profilePost')->name('profile.post');
            Route::post('settings', 'storeSetting')->name('settings');
            Route::get('avatar/url', 'getAvatarUrl')->name('avatar.url');
            Route::post('avatar/upload', 'avatarUpload')->name('avatar.upload');
            Route::post('avatar/gravatar', 'getAvatarFromGravatar')->name('avatar.gravatar');
            Route::post('avatar/delete', 'avatarDelete')->name('avatar.delete');
        });

         // Category
        Route::controller(CategoriesController::class)->prefix('categories')->as('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create-post', 'createPost')->name('createPost');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });

        // Product
        Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create-post', 'createPost')->name('createPost');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });

        // Articles
        Route::controller(ArticlesController::class)->prefix('articles')->as('articles.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create-post', 'createPost')->name('createPost');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });

        // Contacts
        Route::controller(ContactsController::class)->prefix('contacts')->as('contacts.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('create-contact', 'createContact')->name('createContact');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
            Route::delete('destroy/{id}', 'destroy')->name('destroy');
        });

        // Logs
        if (config('boilerplate.app.logs', false)) {
            Route::controller(LogViewerController::class)->prefix('logs')->as('logs.')->middleware('ability:admin,logs')->group(function () {
                Route::get('/', 'index')->name('dashboard');
                Route::prefix('list')->group(function () {
                    Route::get('/', 'listLogs')->name('list');
                    Route::delete('delete', 'delete')->name('delete');
                    Route::prefix('{date}')->group(function () {
                        Route::get('/', 'show')->name('show');
                        Route::get('download', 'download')->name('download');
                        Route::get('{level}', 'showByLevel')->name('filter');
                    });
                });
            });
        }
    });
});
