<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LMS\Billings\Models\Provider;
use LMS\Billings\Models\Subscription;
use LMS\User\Models\User;

class CreateUserBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_billings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Provider::class);
            $table->foreignIdFor(Subscription::class);
            $table->foreignIdFor(User::class);
            $table->string('status');
            $table->string('data')->nullable(); // handle payment details

            $table->timestamp('paid_at')->nullable();
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
        Schema::dropIfExists('user_billings');
    }
}
