# Webmixx

This package allows to build a website quick and simple within a laravel application.
Build your templates, create your Pages and put them in a Menu.

- [Installation](#installation)
- [Usage](#usage)
  - [Pages and PageTempates](#pages-and-pagetemplates)
  - [Menus](#menus)
  - [PageModuleSet and PageModuleItem](#pagemoduleset-and-pagemoduleitem)
    - [PageModuleSet](#pagemoduleset)
    - [PageModuleItem](#pagemoduleitem)

## Installation

Install it as usual:

```bash
composer require sjorsvanleeuwen/webmix
```

It should work out of the box in a local environment after you publish the assets for the backend:

```bash
php artisan vendor:publish --tag=webmixx-assets
```

## Usage

### Pages and PageTemplates
Log in as any user and go to: /webmixx/dashboard and create a PageTemplate and add some PageAttributeTemplates.

Next, create a Page and select your newly created PageTemplate and fill the form.

Afterwards create your PageTemplate blade file.
If you did not change the config file, this should be created in your project resources folder in resources/views/webmixx_templates/Page.

Use the name of your PageTemplate as name of your blade template.

Check your PageTemplates show url for a quick start of your PageTemplate.

When you are done with building your template file, visit /preview/Page/{id of your Page}, or simply click it from the Page list in the backend.

### Menus

Create your Menu in the admin interface and add Pages to it.

For more advanced usage, you can add other Models to your Menu by creating a config setting in. Look for the Page settings for an example.

After that create a menu template file in: resources/views/webmixx_templates/menu. It should be named as a slug representation of your Menu name.

In your Menu template you will have a $menuItems available which is a collection of MenuItems that are on top level.

Next include it in your views with our Blade Component:

```html
<x-webmixx-menus-menu menu="SLUG_REPRESENTATION_OF_YOUR_MENU_NAME"/>
```

### PageModuleSet and PageModuleItem

Imagine having already build a nice news module, or a slideshow module.

It would be really nice to somehow include them in your Pages.

This can be done easily with PageModuleSets and PageModuleItems.

#### PageModuleSet
Sticking with the news example, we want to list the 3 most recent news articles in a component on one or more Pages.

First create a new class, it can be located anywhere and let it implement \SjorsvanLeeuwen\Webmixx\Contracts\ModuleSetFieldType\ModuleSetFieldType.

Implement the functions in the interface:
- *getIterator* Used in Page display, this will contain the data you want the Page to display
- *getModuleDisplayName* A nice name for your reference when building a PageTemplate

This could look something like this:
```php
<?php

namespace App\WebmixxModules;

use App\Models\News;
use SjorsvanLeeuwen\Webmixx\Contracts\ModuleSetFieldType;
use Traversable;

class ThreeMostRecentNewsArticles implements ModuleSetFieldType
{
    public static function getModuleDisplayName() : string{
        return '3 Most Recent News Articles';
    }
    
    public function getIterator() : Traversable{
        return News::query()
            ->orderByDesc('created_at')
            ->take(3)
            ->get();
    }
}
```

Next register it in your AppServiceProvider boot method:
```php
    public function boot(): void
    {
        Webmixx::addPageModule(new ThreeMostRecentNewsArticles());
    }
```

Now, when building a PageTemplate and adding a ModuleSet it will provide you with another field called Data Provider.

Select your freshly build ModuleSet (it will show up with the name given in the getModuleDisplayName function).

When you build a Page with your new PageTemplate, the module will not be visible since there is no data to be configured for this attribute.

#### PageModuleItem

PageModuleItems work quite the same, with one small difference: when building a Page you get an option to choose which of the items provided you want to embed in your Page.

Let's stick with the slideshow example. We want a slideshow on every Page, just not the same on every Page.

As before, create a new class but this time implement ModuleItemFieldType.

Implement the functions in the interface:
- *getSelectList* Used in Page creation, this should return a collection with an integer id field and a string name field.
- *getItem* Used in PageTemplate to retrieve your item from the PageAttribute.   
- *getModuleDisplayName* A nice name for your reference when building a PageTemplate

This could look something like this:
```php
<?php

declare(strict_types=1);

namespace App\WebmixxModules;

use App\Models\Slideshow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use SjorsvanLeeuwen\Webmixx\Contracts\ModuleItemFieldType;

class PageSlideshowProvider implements ModuleItemFieldType
{
    public static function getModuleDisplayName(): string
    {
        return 'Page header slideshow';
    }

    public static function getSelectList(): Collection
    {
        return Slideshow::query()
            ->get();
    }

    public function getItem(int $value): Model
    {
        return self::getSelectList()->firstWhere('id', $value);
    }
}

```

As before, now register it in your AppServiceProvider
```php
    public function boot(): void
    {
        Webmixx::addPageModule(new PageSlideshowProvider());
    }
```

Now, when building a PageTemplate and adding a ModuleItem it will provide you with another field called Data Provider.

Select your freshly build ModuleItem (it will show up with the name given in the getModuleDisplayName function).

When you build a Page with your new PageTemplate, you will see a select element containing all the available slideshows.
