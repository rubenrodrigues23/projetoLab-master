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
        // Schema::create('clients', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->float('price');
        //     $table->string('description');
        //     $table->unsignedBigInteger('user_id');
        //     $table->timestamps();

        //     $table->foreign('user_id', 'user_id_fk')
        //         ->references('id')
        //         ->on('users')
        //         ->onUpdate('CASCADE')
        //         ->onDelete('RESTRICT');
        // });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_id', 'user_id_fk')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('RESTRICT');

            // $table->foreign('client_id', 'client_id_fk')
            //     ->references('id')
            //     ->on('client')
            //     ->onUpdate('CASCADE')
            //     ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('comments');
    }
};
