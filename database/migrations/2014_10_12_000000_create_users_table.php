<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Primero creamos las tablas que no dependan de otra tabla (llave foránea).
        */
        Schema::create('roles', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre_rol');
            $table->integer('puntos')->nullable();
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre_categoria');
            $table->timestamps();
        });

        Schema::create('etiquetas', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre_etiqueta');
            $table->timestamps();
        });

        /*
         * Ahora creamos las tablas que dependen de las tablas de arriba (llaves foráneas).
        */

        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('nombre_usuario');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('rol_id');
            $table->rememberToken();
            $table->timestamps();
            #Creamos la relación de tablas.
            $table->foreign('rol_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('titulo_post');
            $table->text('descripcion_post');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('categoria_id')
                  ->references('id')->on('categorias')
                  ->onDelete('cascade');
        });

        // Tabla de muchos a muchos
        Schema::create('posts_etiquetas', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('etiqueta_id');
            $table->timestamps();

            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade');

            $table->foreign('etiqueta_id')
                  ->references('id')->on('etiquetas')
                  ->onDelete('cascade');
        });

         Schema::create('comentarios', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade');
        });

         // Insertamos un registro por defecto, el del admin
         DB::table('roles')->insert([
            'nombre_rol' => 'administrador',
         ]);

         DB::table('users')->insert([
            'nombre'         => 'Dave',
            'nombre_usuario' => 'Superadmin',
            'email'          => 'admin@gmail.com',
            'password'       => bcrypt('admin123'),
            'rol_id'         => 1
         ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
        Schema::dropIfExists('posts_etiquetas');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('users');
        Schema::dropIfExists('etiquetas');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('roles');
    }
}
