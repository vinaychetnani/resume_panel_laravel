<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResumePanelDataHsSs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_panel_data_hs_ss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resume_id');
            $table->string('user_id');
            $table->string('hs');
            $table->string('ss');
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
        Schema::drop('resume_panel_data_hs_ss');
    }
}