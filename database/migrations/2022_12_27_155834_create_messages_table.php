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
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('participant1_id');
            $table->unsignedBigInteger('participant2_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('participant1_id', 'participant1_id_fk')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');

            $table->foreign('participant2_id', 'participant2_id_fk')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
