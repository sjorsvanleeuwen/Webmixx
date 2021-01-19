<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTemplatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('page_templates', function (Blueprint $table): void {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->boolean('repeatable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_templates');
    }
}
