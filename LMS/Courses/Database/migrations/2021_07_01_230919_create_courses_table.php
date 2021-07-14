<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('status_id')->references('id')->on('course_status');
            $table->foreignId('course_level_id')->references('id')->on('course_levels');
            $table->string('title',60);
            $table->string('subtitle', 120);
            $table->text('description');
            $table->boolean('paid');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('courses');
    }
}
