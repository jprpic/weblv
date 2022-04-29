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

    // Students can apply for multiple tasks before picking one

    public function up()
    {
        Schema::create('task_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->primary(['user_id','task_id']);
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
        Schema::dropIfExists('task_user');
    }
};
