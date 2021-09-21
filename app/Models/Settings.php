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
    'start1' => 'datetime:H:i',
    'end1' => 'datetime:H:i',
    'start2' => 'datetime:H:i',
    'end2' => 'datetime:H:i',
    'start3' => 'datetime:H:i',
    'end3' => 'datetime:H:i',
  ];

  /**
   * Get the user that owns the settings.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
