<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('menu_id')->unsigned();
            $table->bigInteger('menu_item_id')->unsigned()->nullable();
            $table->morphs('link');
            $table->string('slug');
            $table->string('name');
            $table->string('full_slug');
            $table->tinyInteger('order')->unsigned();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('menu_item_id')->references('id')->on('menu_items');
            $table->unique(['menu_id', 'link_type', 'link_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
}
