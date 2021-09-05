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
    'created_at',
    'updated_at',
  ];

  /**
   * Get the user that owns the day.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
