<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\FrontController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\MenuController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\PageController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\PageTemplateController;

Route::group([
    'middleware' => [
        'web',
    ],
], function (): void {
    Route::fallback([FrontController::class, 'handle']);
});

Route::group([
    'prefix' => 'webmixx',
    'as' => 'webmixx.',
    'middleware' => [
        'web',
        'auth',
    ],
], function (): void {
    Route::view('dashboard', 'webmixx::dashboard')->name('dashboard');
    Route::resource('menus', MenuController::class);
    Route::resource('pages', PageController::class);
    Route::resource('page_templates', PageTemplateController::class);
    Route::get('preview/{module}/{id}', [FrontController::class, 'preview'])->name('preview');
});

if (app()->environment('local')) {
    Route::get('webmixx/auth', function () {
        $user = \App\Models\User::updateOrCreate([
            'id' => 1,
            'name' => 'Sjors van Leeuwen',
            'email' => 'sjors@sjorsvanleeuwen.com',
            'password' => 'dontcare',
        ]);

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('webmixx.dashboard');
    })->name('login')->middleware('web');
}
