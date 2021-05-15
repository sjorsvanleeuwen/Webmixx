<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\EditorUploadController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\FieldTypeController as ApiFieldTypeController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\LinkTypeController as ApiLinkTypeController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\MenuController as ApiMenuController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\MenuItemController as ApiMenuItemController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\ModuleItemController as ApiModuleItemController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\PageController as ApiPageController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\PageTemplateController as ApiPageTemplateController;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\Api\PageAttributeTemplateController as ApiPageAttributeTemplateController;

Route::group([
    'prefix' => 'webmixx/api',
    'as' => 'webmixx.api.',
    'middleware' => [
        'web',
        'auth',
    ],
], function (): void {
    Route::resource('field_types', ApiFieldTypeController::class)
        ->only([
            'index',
            'show'
        ]);

    Route::resource('link_types', ApiLinkTypeController::class)
        ->only([
            'index',
            'show',
        ]);

    Route::get('menu/{menu}', [
        ApiMenuController::class,
        'show',
    ])->name('menu.show');

    Route::resource('menu.menu_item', ApiMenuItemController::class)
        ->only([
            'store',
            'update',
            'destroy',
        ]);

    Route::resource('module_item', ApiModuleItemController::class)
        ->parameter('module_item', 'page_attribute_template')
        ->only([
            'show',
        ]);

    Route::resource('page_template', ApiPageTemplateController::class)
        ->only([
            'index',
            'show',
        ]);

    Route::resource('page_template.page_attribute_template', ApiPageAttributeTemplateController::class)
        ->only([
            'store',
            'update',
            'destroy',
        ]);

    Route::get('page/{page}', [
        ApiPageController::class,
        'show',
    ])->name('page.show');

    Route::post('editor/upload',
       EditorUploadController::class
    )->name('editor.upload');
});
