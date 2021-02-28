<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageAttributesTable extends Migration
{
    public function up(): void
    {
        Schema::create('page_attributes', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('page_id')->unsigned();
            $table->bigInteger('page_attribute_template_id')->unsigned();
            $table->bigInteger('page_attribute_id')->unsigned()->nullable();
            $table->longText('value')->nullable();
            $table->tinyInteger('order')->unsigned();
            $table->timestamps();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('page_attribute_template_id')->references('id')->on('page_attribute_templates');
            $table->foreign('page_attribute_id')->references('id')->on('page_attributes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_attributes');
    }
}
