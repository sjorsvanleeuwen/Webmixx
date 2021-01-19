<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('page_template_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('page_template_id')->references('id')->on('page_templates');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
}
