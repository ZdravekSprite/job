<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('days', function (Blueprint $table) {
      $table->id();
      $table->date('date');
      $table->unsignedBigInteger('user_id');
      $table->tinyInteger('state')->default(0);
      $table->time('start')->default('00:00:00');
      $table->time('end')->default('00:00:00');
      $table->timestamps();
      $table->unique(['user_id', 'date']);
      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('days');
  }
}
