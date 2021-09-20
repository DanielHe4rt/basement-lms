<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseModuleLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_module_lessons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('module_id')->references('id')->on('course_modules');
            $table->foreignId('type_id')->references('id')->on('lesson_types');

            $table->string('title');
            $table->string('description');
            $table->text('content')->nullable();
            $table->integer('duration')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_module_lessons');
    }
}
