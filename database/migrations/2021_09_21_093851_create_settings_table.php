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
      $table->time('1start')->default('00:00:00');
      $table->time('1end')->default('00:00:00');
      $table->time('2start')->default('00:00:00');
      $table->time('2end')->default('00:00:00');
      $table->time('3start')->default('00:00:00');
      $table->time('3end')->default('00:00:00');
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
