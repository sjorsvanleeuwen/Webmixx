<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\FormButtons;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\InputCheckbox;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\InputFile;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\InputText;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\RichText;
use SjorsvanLeeuwen\Webmixx\View\Components\Forms\Select;
use SjorsvanLeeuwen\Webmixx\View\Components\Menus\Menu;
use SjorsvanLeeuwen\Webmixx\View\Components\Pages\PageAttribute;
use SjorsvanLeeuwen\Webmixx\View\Components\Pages\PageAttributeTemplate;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(Webmixx $webmixx): void
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'webmixx');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'webmixx');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('webmixx.php'),
            ], 'webmixx-config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/webmixx'),
            ], 'webmixx-views');

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../dist' => public_path('vendor/webmixx'),
            ], 'webmixx-assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/webmixx'),
            ], 'webmixx-lang');

            // Registering package commands.
            // $this->commands([]);
        }

        $this->bootPolicies($webmixx);
        $this->bootComponents();
    }

    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'webmixx');

        // Register the main class to use with the facade
        $this->app->singleton('webmixx', function () {
            return new Webmixx($this->app);
        });
    }

    protected function bootPolicies(Webmixx $webmixx): void
    {
        foreach ($webmixx->getPolicyBindings() as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    protected function bootComponents(): void
    {
        $this->loadViewComponentsAs('webmixx', [
            // Forms
            InputCheckbox::class,
            InputFile::class,
            InputText::class,
            RichText::class,
            Select::class,
            FormButtons::class,

            // Admin page
            PageAttributeTemplate::class,
            PageAttribute::class,

            // Front Menu
            Menu::class,
        ]);
    }
}
