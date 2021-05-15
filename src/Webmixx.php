<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use SjorsvanLeeuwen\Webmixx\Contracts\ModuleFieldType;
use SjorsvanLeeuwen\Webmixx\Contracts\ModuleItemFieldType;
use SjorsvanLeeuwen\Webmixx\Contracts\ModuleSetFieldType;
use SjorsvanLeeuwen\Webmixx\Exceptions\MenuModuleNotFoundException;

class Webmixx
{
    protected Application $app;
    protected Collection $pageModuleSets;
    protected Collection $pageModuleItems;
    protected Collection $previewModules;

    public function __construct(Application $app = null)
    {
        if (! $app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;
        $this->pageModuleSets = collect();
        $this->pageModuleItems = collect();
        $this->previewModules = collect();
    }

    public function addPageModule(ModuleFieldType $module): void
    {
        if ($module instanceof ModuleSetFieldType) {
            $this->pageModuleSets->push([
                'id' => get_class($module),
                'name' => $module::getModuleDisplayName(),
            ]);
        } else if ($module instanceof ModuleItemFieldType) {
            $this->pageModuleItems->push([
                'id' => get_class($module),
                'name' => $module::getModuleDisplayName(),
            ]);
        }
    }

    public function getPageModuleSets(): Collection
    {
        return $this->pageModuleSets;
    }

    public function getPageModuleItems(): Collection
    {
        return $this->pageModuleItems;
    }

    public function addPreviewModule(string $module_name, callable $render_function): void
    {
        $this->previewModules->push([
            'id' => $module_name,
            'render' => $render_function,
        ]);
    }

    public function getPreviewModules(): Collection
    {
        return $this->previewModules;
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

    public function getPublicUploadDisk(): Filesystem
    {
        return Storage::disk(config('webmixx.uploads.public_disk'));
    }

    public function getUploadDirectory(): string
    {
        return config('webmixx.uploads.directory');
    }
}
