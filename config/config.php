<?php

declare(strict_types=1);

use SjorsvanLeeuwen\Webmixx\Models\Page;
use SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate;
use SjorsvanLeeuwen\Webmixx\Models\PageTemplate;
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
        Page::moduleName() => [
            'title' => 'Page',
            'model' => Page::class,
        ],
    ],
    'policyBindings' => [
        Page::class => PagePolicy::class,
        PageAttributeTemplate::class => PageAttributeTemplatePolicy::class,
        PageTemplate::class => PageTemplatePolicy::class,
    ],
];
