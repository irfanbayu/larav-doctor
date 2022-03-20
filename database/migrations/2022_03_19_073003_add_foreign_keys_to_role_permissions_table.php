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
           $table->foreign('permissions_id', 'fk_permissions_roles_to_permissions')
            ->references('id')->on('permissions')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('roles_id', 'fk_permissions_roles_to_roles')
            ->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
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
            $table->dropForeign('fk_permissions_roles_to_permissions');
            $table->dropForeign('fk_permissions_roles_to_roles');
        });
    }
}
