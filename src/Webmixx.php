<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use SjorsvanLeeuwen\Webmixx\Exceptions\MenuModuleNotFoundException;

class Webmixx
{
    /**
     * The Laravel application instance.
     *
     * @var Application.
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct($app = null)
    {
        if (! $app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
    }

    public function getMenuModules(): Collection
    {
        return collect(config('webmixx.menuModules'));
    }

    public function getMenuModelClass(string $id): string
    {
        $menuModule = $this->getMenuModules()->firstWhere('id', $id);
        if ($menuModule === null) {
            throw new MenuModuleNotFoundException('Menu module with id: ' . $id . ' was not found.');
        }
        return $menuModule['model'];
    }

    /**
     * @return array<string, string>
     */
    public function getPolicyBindings(): array
    {
        return config('webmixx.policyBIndings', []);
    }

    public function getTemplateViewPath(string $module, string $template_name): string
    {
        return config('webmixx.templateBasePath', 'webmixx_templates') . '.' . $module . '.' . $template_name;
    }
}
