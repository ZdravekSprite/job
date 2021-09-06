<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
  use HasFactory;
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'user_id',
    'created_at',
    'updated_at',
  ];

  /**
   * Get the user that owns the month.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the month slug.
   */
  public function slug()
  {
    $m = $this->month % 12 + 1;
    $y = ($this->month - $this->month % 12) / 12;
    return sprintf("%02d.%04d", $m, $y);
  }
  /**
   * Get the last month bruto.
   */
  public function last_bruto()
  {
    $month = Month::orderBy('month','desc')->where('user_id', '=', $this->user_id)->where('month', '<', $this->month)->where('bruto', '<>', null)->first();
    if(!$month) $month = $this;
    return $month->bruto;
  }
}
