<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Requests\CreateMenuRequest;
use SjorsvanLeeuwen\Webmixx\Models\Menu;

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

    public function show(Menu $menu): void
    {

    }

    public function edit(Menu $menu): void
    {

    }

    public function update(Menu $menu): void
    {

    }

    public function destroy(Menu $menu): void
    {

    }
}
