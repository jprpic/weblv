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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('name',100);
            $table->string('name_eng',100);
            $table->string('description', 1000);
            $table->unsignedTinyInteger('study');
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table){
            $table->foreignId('task_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(['task_id']);
        });
        Schema::dropIfExists('tasks');

    }
};
