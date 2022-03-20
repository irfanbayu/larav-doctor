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
        Schema::table('role_users', function (Blueprint $table) {
            $table->foreign('roles_id', 'fk_role_users_to_roles')
            ->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('users_id', 'fk_role_users_to_users')
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
        Schema::table('role_users', function (Blueprint $table) {
            $table->dropForeign('fk_role_users_to_roles');
            $table->dropForeign('fk_role_users_to_users');
        });
    }
}
