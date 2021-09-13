<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $days = Day::orderBy('date', 'desc')->where('user_id', '=', Auth::user()->id)->paginate(25);
    $holidays = Holiday::get();
    foreach ($days as $day) {
      if ($holidays->where('date', '=', $day->date)->first() != null) {
        $day->holiday = $holidays->where('date', '=', $day->date)->first()->name;
      }
    }
    //dd($days, $holidays);
    return view('days.index')->with(compact('days'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    //dd($request);
    $day = new Day;
    if ($request->input('date')) $day->date = $request->input('date');
    if ($request->input('state')) $day->state = $request->input('state');
    if ($request->input('night')) $day->night = $request->input('night');
    if ($request->input('start')) {
      $day->start = $request->input('start');
      $day->state = 1;
    }
    if ($request->input('end')) $day->end = $request->input('end');

    if ($request->input('date')) {
      $old_day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', date('Y-m-d', strtotime($request->input('date'))))->first();
      //dd($old_day);
      if ($old_day) return redirect(route('day.edit', ['date' => $day->date->format('d.m.Y')]))->with('new_day', $day)->with('warning', 'Day already exist');
    }
    //dd($day);
    return view('days.create')->with(compact('day'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'date' => 'required'
    ]);
    //dd($request);
    $day = new Day;
    $day->date = $request->input('date');
    $day->user_id = Auth::user()->id;
    $day->state = $request->input('state') ? $request->input('state') : 0;
    if ($request->input('state') == 1) {
      $day->start = $request->input('start');
      $day->end = $request->input('end');
      if ($day->start > $day->end) {
        //dd($day->start,$day->end);
        $next_day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', $day->date->addDays(1)->format('Y-m-d'))->first();
        if (!$next_day) {
          $next_day = new Day;
          $next_day->date = $day->date->addDays(1)->format('d.m.Y');
        }
        $next_day->night = $day->end->format('H:i');
        $day->end = "24:00";
        //dd($day,$next_day);
        $next_day->save();
      }
    }
    $day->save();
    return redirect(route('day.show', ['date' => $day->date->format('d.m.Y')]))->with('success', 'Day Created');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  //public function show(Day $day)
  public function show($date)
  {
    $day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', date('Y-m-d', strtotime($date)))->first();
    if (!$day) return redirect(route('days.index'))->with('warning', 'Wrong Day');
    //dd($day->end->format('H:i'));
    if ($day->end->format('H:i') == "00:00") {
      $next_day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', $day->date->addDays(1)->format('Y-m-d'))->first();
      if ($next_day) {
        $day->end = $next_day->night->format('H:i');
      }
    }
    return view('days.show')->with('day', $day);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  //public function edit(Day $day)
  public function edit($date)
  {
    //dd($date);
    //dd($request, session('new_day'));
    if (session('new_day')) {
      $day = session('new_day');
    } else {
      $day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', date('Y-m-d', strtotime($date)))->first();
    }
    if (!$day) return redirect(route('day.create', ['date' => $day->date->format('d.m.Y')]))->with('warning', 'Day not exist');
    //dd($day);
    return view('days.edit')->with('day', $day);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  //public function update(Request $request, Day $day)
  public function update(Request $request, $date)
  {
    //dd($request, $date);
    $day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', date('Y-m-d', strtotime($date)))->first();
    $day->state = $request->input('state') ? $request->input('state') : 0;
    if ($request->input('state') == 1) {
      $day->start = $request->input('start');
      $day->end = $request->input('end');
      $next_day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', $day->date->addDays(1)->format('Y-m-d'))->first();
      if ($day->start > $day->end) {
        if (!$next_day) {
          $next_day = new Day;
          $next_day->date = $day->date->addDays(1)->format('d.m.Y');
        }
        $next_day->night = $day->end->format('H:i');
        $day->end = "24:00";
        //dd($day,$next_day);
        $next_day->save();
      } else {
        if ($next_day) {
          $next_day->night = "00:00";
          $next_day->save();
        }
      }
    }
    //dd($day);
    $day->save();
    return redirect(route('day.show', ['date' => $day->date->format('d.m.Y')]))->with('success', 'Day Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  //  public function destroy(Day $day)
  public function destroy($date)
  {
    $day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', date('Y-m-d', strtotime($date)))->first();
    //dd($day->night);
    if ($day->night->format('H:i') == "00:00") {
      $day->delete();
    } else {
      $day->state = 0;
      $day->start = "00:00";
      $day->end = "00:00";
      $day->save();
    }
    $next_day = Day::where('user_id', '=', Auth::user()->id)->where('date', '=', $day->date->addDays(1)->format('Y-m-d'))->first();
    if ($next_day) {
      $next_day->night = "00:00";
      $next_day->save();
    }
    return redirect(route('days.index'))->with('success', 'Day removed');
  }
}
