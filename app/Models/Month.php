<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

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
   * Get the last month for some attributte.
   */
  public function last($att)
  {
    $month = Month::orderBy('month', 'desc')->where('user_id', '=', $this->user_id)->where('month', '<', $this->month)->where($att, '<>', null)->first();
    if (!$month) $month = $this;
    return $month->attributes[$att];
  }

  /**
   * Get the days month for some attributte.
   */
  public function days()
  {
    $firstDate = '01.' . $this->slug();
    $from = CarbonImmutable::createFromFormat('d.m.Y', $firstDate)
      ->firstOfMonth();
    $to = Carbon::createFromFormat('d.m.Y', $firstDate)
      ->endOfMonth();
    /*
    $from = CarbonImmutable::parse($month['x'])->firstOfMonth();
    $to = Carbon::parse($month['x'])->endOfMonth();
    */
    //dd($firstDate,$from,$to);
    $daysColection = Day::whereBetween('date', [$from, $to])
      ->where('user_id', '=', $this->user_id)
      ->get();
    $holidaysColection = Holiday::whereBetween('date', [$from, $to])
      ->get();
    $datesArray = array();
    for ($i = 0; $i < $from->daysInMonth; $i++) {
      if ($daysColection->where('date', '=', $from->addDays($i))->first() != null) {
        $temp_date = $daysColection->where('date', '=', $from->addDays($i))->first();
      } else {
        $temp_date = new Day;
        $temp_date->date = $from->addDays($i);
        //dd($temp_date);
      }
      //$temp_date = $from->addDays($i);
      if ($holidaysColection->where('date', '=', $from->addDays($i))->first() != null) {
        //dd($holidaysColection->where('date', '=', $from->addDays($i))->first());
        $temp_date->holiday = $holidaysColection->where('date', '=', $from->addDays($i))->first()->name;
      }
      $datesArray[] = $temp_date;
    }
    $days = $datesArray;

    return $days;
  }
}
