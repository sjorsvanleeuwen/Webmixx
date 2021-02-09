<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageAttributeTemplatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('page_attribute_templates', function (Blueprint $table): void {
            $table->id();
            $table->bigInteger('page_template_id')->unsigned();
            $table->bigInteger('page_attribute_template_id')->unsigned()->nullable();
            $table->string('slug');
            $table->string('name');
            $table->string('field_type');
            $table->boolean('repeatable');
            $table->tinyInteger('order')->unsigned();
            $table->text('data_provider')->nullable();
            $table->timestamps();

            $table->foreign('page_template_id')->references('id')->on('page_templates');
            $table->foreign('page_attribute_template_id')->references('id')->on('page_attribute_templates');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_attribute_templates');
    }
}
