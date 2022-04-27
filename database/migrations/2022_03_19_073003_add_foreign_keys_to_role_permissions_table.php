<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
           $table->foreign('permissions_id', 'fk_role_permissions_to_permissions')
            ->references('id')->on('permissions')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('roles_id', 'fk_role_permissions_to_roles')
            ->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropForeign('fk_role_permissions_to_permissions');
            $table->dropForeign('fk_role_permissions_to_roles');
        });
    }
}
