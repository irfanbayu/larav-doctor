<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_user', function (Blueprint $table) {
            $table->foreign('roles_id', 'fk_roles_user_to_roles')
            ->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('user_id', 'fk_roles_user_to_users')
            ->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_user', function (Blueprint $table) {
            $table->dropForeign('fk_roles_user_to_roles');
            $table->dropForeign('fk_roles_user_to_users');
        });
    }
}
