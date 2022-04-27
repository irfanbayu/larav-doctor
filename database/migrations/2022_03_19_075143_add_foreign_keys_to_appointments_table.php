<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('doctors_id', 'fk_appointments_to_doctors')
            ->references('id')->on('doctors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_appointments_to_users')
            ->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
             $table->foreign('consultations_id', 'fk_appointments_to_consultations')
            ->references('id')->on('consultations')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign('fk_appointments_to_doctors');
            $table->dropForeign('fk_appointments_to_users');
            $table->dropForeign('fk_appointments_to_consultations');
        });
    }
}
