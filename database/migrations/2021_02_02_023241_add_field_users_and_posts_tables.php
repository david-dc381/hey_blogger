<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUsersAndPostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // creamos un campo de foto para las tablas de usuarios y posts que nos hace falta
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('password');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('descripcion_post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('foto');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
}
