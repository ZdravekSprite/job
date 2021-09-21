<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
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
    '1start' => 'datetime:H:i',
    '1end' => 'datetime:H:i',
    '2start' => 'datetime:H:i',
    '2end' => 'datetime:H:i',
    '3start' => 'datetime:H:i',
    '3end' => 'datetime:H:i',
  ];

  /**
   * Get the user that owns the settings.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
