<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LMS\Billings\Models\Provider;

class CreateBillingPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Provider::class);
            $table->string('name');
            $table->integer('interval');
            $table->integer('repeats')->nullable();
            $table->string('price');
            $table->string('data');
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
        Schema::dropIfExists('billing_plans');
    }
}
