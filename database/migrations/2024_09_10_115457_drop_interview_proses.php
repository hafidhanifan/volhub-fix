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
        Schema::dropIfExists('interview_proses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_proses', function (Blueprint $table) {
            $table->id('id_interview');
            $table->date('tgl_interview');
            $table->string('lokasi_interview');
            $table->enum('status_interview', ['Not scheduled yet', 'On progress', 'Interview Completed']);
            $table->text('note_interview');
            $table->date('tgl_note');
            $table->time('interview_time');
        });
    }
};
