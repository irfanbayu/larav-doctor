<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctors_id')->nullable()->index('fk_appointments_to_doctors');
            $table->foreignId('users_id')->nullable()->index('fk_appointments_to_users');
            $table->foreignId('consultations_id')->nullable()->index('fk_appointments_to_consultations');
            $table->enum('level',[1,2,3]);
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->enum('status',[1,2]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
