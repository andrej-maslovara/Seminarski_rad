<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesAndElementsTables extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->text('raw_code')->nullable();
            $table->text('content')->nullable()->after('title');
        });

        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->integer('position');
            $table->string('color')->nullable();
            $table->string('font_size')->nullable();
            $table->timestamps();
            $table->string('deleted');
        });
    }

    public function down()
    {
        Schema::dropIfExists('elements');
        Schema::dropIfExists('pages');
    }
}