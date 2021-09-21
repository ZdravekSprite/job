<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('settings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->time('start1')->default('00:00:00');
      $table->time('end1')->default('00:00:00');
      $table->time('start2')->default('00:00:00');
      $table->time('end2')->default('00:00:00');
      $table->time('start3')->default('00:00:00');
      $table->time('end3')->default('00:00:00');
      $table->timestamps();
      $table->unique('user_id');
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
    Schema::dropIfExists('settings');
  }
}
