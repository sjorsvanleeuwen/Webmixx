<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\LinkTypeController as ApiLinkTypeController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\MenuController as ApiMenuController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\MenuItemController as ApiMenuItemController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\PageController as ApiPageController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\PageTemplateController as ApiPageTemplateController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\FrontController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\MenuController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\PageAttributeTemplateController;
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
    Route::resource('page_attribute_templates', PageAttributeTemplateController::class);
    Route::get('preview/{module}/{id}', [FrontController::class, 'preview'])->name('preview');
});

Route::group([
    'prefix' => 'webmixx/api',
    'as' => 'webmixx.api.',
    'middleware' => [
        'web',
        'auth',
    ],
], function (): void {
    Route::get('link_types', [
        ApiLinkTypeController::class,
        'index',
    ])->name('link_types.index');

    Route::get('link_types/{link_type}', [
        ApiLinkTypeController::class,
        'show',
    ])->name('link_types.show');

    Route::get('menu/{menu}', [
        ApiMenuController::class,
        'show',
    ])->name('menu.show');

    Route::post('menu/{menu}/menu_item', [
        ApiMenuItemController::class,
        'store',
    ])->name('menu.menu_item.store');

    Route::get('page_templates', [
        ApiPageTemplateController::class,
        'index',
    ])->name('page_template.index');

    Route::get('page/{page}', [
        ApiPageController::class,
        'show',
    ])->name('page.show');
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
