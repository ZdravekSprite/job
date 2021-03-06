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
   * Get the next month.
   */
  public function next()
  {
    $next = Month::orderBy('month', 'asc')->where('user_id', '=', $this->user_id)->where('month', '>', $this->month)->first();
    return $next ? $next->slug() : $this->slug();
  }

  /**
   * Get the prev month.
   */
  public function prev()
  {
    $prev = Month::orderBy('month', 'desc')->where('user_id', '=', $this->user_id)->where('month', '<', $this->month)->first();
    return $prev ? $prev->slug() : $this->slug();
  }

  /**
   * Get the first day of month.
   */
  public function from()
  {
    $firstDate = '01.' . $this->slug();
    $from = CarbonImmutable::createFromFormat('d.m.Y', $firstDate)->firstOfMonth();
    return $from;
  }

  /**
   * Get the last day of month.
   */
  public function to()
  {
    $firstDate = '01.' . $this->slug();
    $to = Carbon::createFromFormat('d.m.Y', $firstDate)->endOfMonth();
    return $to;
  }

  /**
   * Get the days of month.
   */
  public function days()
  {
    $firstDate = '01.' . $this->slug();
    $from = CarbonImmutable::createFromFormat('d.m.Y', $firstDate)->firstOfMonth();
    $to = Carbon::createFromFormat('d.m.Y', $firstDate)->endOfMonth();
    //dd($firstDate,$from,$to);
    $daysColection = Day::whereBetween('date', [$from, $to])->where('user_id', '=', $this->user_id)->get();
    $holidaysColection = Holiday::whereBetween('date', [$from, $to])->get();
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

  /**
   * Get the hours Norm of month.
   */
  public function hoursNorm()
  {
    $hoursNormAll = 0;
    $hoursNormHoli = 0;

    $hoursNormGO = 0;
    $hoursNormDopust = 0;
    $hoursNormSick = 0;

    $minWork = 0;
    $minWorkNight = 0;
    $minWorkHoli = 0;
    $minWorkSunday = 0;

    foreach ($this->days() as $d) {

      $day_minWork = ($d->start ? ($d->end ? $d->end->diffInMinutes($d->start) : 24*60 - $d->start->format('H') * 60 + $d->start->format('i')) : 0) + ($d->night ? $d->night->format('H') * 60 + $d->night->format('i') : 0);
      $minWork += $day_minWork;

      $day_minNight1 = $d->night ? $d->night->format('H') * 60 + $d->night->format('i') : 0;
      $day_endMin = $d->end ? $d->end->format('H') * 60 + $d->end->format('i') : 1440;
      $day_minNight2 = $d->end && ($day_endMin > 1320) ? $day_endMin - 1320 : 0;
      $minWorkNight += $day_minNight1 + $day_minNight2;
      $dayOfWeek = $d->date->dayOfWeek;
      switch ($dayOfWeek) {
        case 0:
          $def_h = 0;
          $minWorkSunday += $day_minWork;
          break;
        case 6:
          $def_h = 5;
          break;
        default:
          $def_h = 7;
          break;
      }
      $hoursNormAll += $def_h;

      if ($d->holiday) {
        $hoursNormHoli += $def_h;
        $minWorkHoli += $day_minWork;
      }

      switch ($d->state) {
        case 2:
          $hoursNormGO += $def_h;
          break;
        case 3:
          $hoursNormDopust += $def_h;
          break;
        case 4:
          $hoursNormSick += $def_h;
          break;
        default:
          break;
      }
    }
    $hoursNormWork = $hoursNormAll - $hoursNormHoli - $hoursNormGO - $hoursNormDopust - $hoursNormSick;
    $hoursNorm = (object) [
      'All' => $hoursNormAll,
      'Holiday' => $hoursNormHoli,
      'GO' => $hoursNormGO,
      'Dopust' => $hoursNormDopust,
      'Sick' => $hoursNormSick,
      'Work' => $hoursNormWork,
      'min' => $minWork,
      'minNight' => $minWorkNight,
      'minSunday' => $minWorkSunday,
      'minHoliday' => $minWorkHoli
    ];
    return $hoursNorm;
  }
}
