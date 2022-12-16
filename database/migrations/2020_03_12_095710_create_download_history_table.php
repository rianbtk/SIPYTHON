<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_history', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->bigInteger('userid');
            $table->string('topicname');
            $table->string('doctype');
            $table->string('filepath');
            $table->string('downfile');
            $table->string('host')->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_history');
    }
}
