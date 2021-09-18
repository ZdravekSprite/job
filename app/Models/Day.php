<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
  use HasFactory;

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'created_at',
    'updated_at',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'date' => 'datetime:d.m.Y',
    'night' => 'datetime:H:i',
    'start' => 'datetime:H:i',
    'end' => 'datetime:H:i',
  ];

  /**
   * Get the user that owns the day.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Dan u tjednu.
   */
  public function dan()
  {
    $weekMap = [
      0 => 'Ne',
      1 => 'Po',
      2 => 'Ut',
      3 => 'Sr',
      4 => 'Če',
      5 => 'Pe',
      6 => 'Su',
    ];
    return $weekMap[$this->date->dayOfWeek];
  }
}
