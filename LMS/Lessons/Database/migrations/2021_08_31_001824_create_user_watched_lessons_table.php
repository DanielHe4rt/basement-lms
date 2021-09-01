<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LMS\Courses\Models\Course;
use LMS\Lessons\Models\Lesson;
use LMS\User\Models\User;

class CreateUserWatchedLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_watched_lessons', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Course::class);
            $table->foreignIdFor(Lesson::class);
            $table->timestamp('watched_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_watched_lessons');
    }
}
