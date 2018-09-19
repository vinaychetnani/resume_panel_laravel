<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResumePanelDataAntiphrase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_panel_data_antiphrase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resume_id');
            $table->string('user_id');
            $table->string('phrase');
            $table->string('skill');
            $table->string('skill_type');
            $table->timestamps();
            $table->boolean('pushed_to_live_db')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('resume_panel_data_antiphrase');
    }
}