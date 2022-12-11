<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('days_of_month');
            $table->integer('months');
            $table->integer('days_of_week');
            $table->integer('duration_type');
            $table->integer('total_tasks');
            $table->integer('total_executed');
            $table->dateTime('execute_from');
            $table->dateTime('execute_to');
            $table->dateTime('last_execution');
            $table->integer('status');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('scheduled_tasks');
    }
};
