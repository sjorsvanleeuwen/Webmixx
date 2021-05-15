<?php

declare(strict_types=1);

use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;
use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
use SjorsvanLeeuwen\Webmixx\Policies\MenuItemPolicy;
use SjorsvanLeeuwen\Webmixx\Policies\MenuPolicy;
use SjorsvanLeeuwen\Webmixx\Policies\PageAttributeTemplatePolicy;
use SjorsvanLeeuwen\Webmixx\Policies\PagePolicy;
use SjorsvanLeeuwen\Webmixx\Policies\PageTemplatePolicy;

return [
    'templateBasePath' => 'webmixx_templates',
    'menuModules' => [
        // Add models you would like to use as menu pages
        //'module_name' => [
        //    'title' => 'My Module',
        //    'model' => Model::class,
        //],
        [
            'id' => Page::moduleName(),
            'title' => 'Page',
            'model' => Page::class,
        ],
    ],
    'policyBindings' => [
        Menu::class => MenuPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
        Page::class => PagePolicy::class,
        PageAttributeTemplate::class => PageAttributeTemplatePolicy::class,
        PageTemplate::class => PageTemplatePolicy::class,
    ],
    'uploads' => [
        'disk' => 'local',
        'public_disk' => 'public',
        'directory' => 'webmixx',
    ],
];
