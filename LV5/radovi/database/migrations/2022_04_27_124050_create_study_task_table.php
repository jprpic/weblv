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

    // Tasks can be done by students from various study programmes

    public function up()
    {
        Schema::create('study_task', function (Blueprint $table) {
            $table->unsignedTinyInteger('study_id');
            $table->foreign('study_id')->references('id')->on('studies');
            $table->foreignId('task_id')->constrained();
            $table->primary(['study_id','task_id']);
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
        Schema::dropIfExists('study_task');
    }
};
