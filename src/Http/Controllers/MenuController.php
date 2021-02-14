<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreateMenuRequest;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditMenuRequest;
use SjorsvanLeeuwen\Webmixx\Models\Menu;
use SjorsvanLeeuwen\Webmixx\Models\MenuItem;

class MenuController extends BaseController
{
    public function index(): ViewContract
    {
        $this->authorize('viewAny', Menu::class);

        Paginator::useBootstrap();

        $menus = Menu::query()->paginate();

        return view('webmixx::menus.index', compact('menus'));
    }

    public function create(): ViewContract
    {
        $this->authorize('create', Menu::class);

        return view('webmixx::menus.create');
    }

    public function store(CreateMenuRequest $request): RedirectResponse
    {
        $this->authorize('create', Menu::class);

        $menu = new Menu();
        $menu->fill($request->validated());
        $menu->slug = Str::slug($menu->name);

        $menu->save();

        return redirect()->route('webmixx.menus.index');
    }

    public function show(Menu $menu): ViewContract
    {
        $this->authorize('view', $menu);

        return view('webmixx::menus.show', compact('menu'));
    }

    protected function saveMenuItems(array $menuItems, ?int $parent_id = null, string $root = '/'): void
    {
        foreach (array_values($menuItems) as $index => $menuItemData) {
            $is_home = $parent_id === null && $index === 0;

            /** @var MenuItem $menuItem */
            $menuItem = MenuItem::find($menuItemData['id']);
            $menuItem->order = $index;
            $menuItem->menu_item_id = $parent_id;
            if ($is_home) {
                $menuItem->full_slug = $root;
            } else {
                $menuItem->full_slug = $root . $menuItem->slug;
            }
            $menuItem->save();

            if ($is_home) {
                $new_root = $root;
                $new_parent_id = null;
            } else {
                $new_root = $menuItem->full_slug . '/';
                $new_parent_id = $menuItem->id;
            }

            $this->saveMenuItems(Arr::get($menuItemData, 'menu_items', []), $new_parent_id, $new_root);
        }
    }
}
