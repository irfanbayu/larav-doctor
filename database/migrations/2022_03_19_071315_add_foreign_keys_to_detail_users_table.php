<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            $table->foreign('users_id', 'fk_detail_users_to_users')
            ->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('type_users_id', 'fk_detail_users_to_type_users')
            ->references('id')->on('type_users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_users', function (Blueprint $table) {
            $table->dropForeign('fk_detail_users_to_users');
            $table->dropForeign('fk_detail_users_to_type_users');
        });
    }
}
