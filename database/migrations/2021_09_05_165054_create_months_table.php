<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('months', function (Blueprint $table) {
      $table->id();
      $table->smallInteger('month');
      $table->unsignedBigInteger('user_id');
      $table->mediumInteger('bruto')->nullable();
      $table->smallInteger('prijevoz')->nullable();
      $table->mediumInteger('odbitak')->nullable();
      $table->smallInteger('prirez')->nullable();
      $table->tinyInteger('prekovremeni')->nullable();
      $table->mediumInteger('stimulacija')->nullable();
      $table->mediumInteger('regres')->nullable();
      $table->timestamps();
      $table->unique(['user_id', 'month']);
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
    Schema::dropIfExists('months');
  }
}
