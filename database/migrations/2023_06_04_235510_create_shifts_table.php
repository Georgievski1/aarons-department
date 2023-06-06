<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift_date');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('workers')->onDelete('cascade');
            $table->integer('hours');
            $table->integer('hour_rate');
            $table->string('taxable');
            $table->string('status');
            $table->string('shift_type');
            $table->string('paid')->nullable();
            $table->string('total');
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
        Schema::dropIfExists('shifts');
    }
}
