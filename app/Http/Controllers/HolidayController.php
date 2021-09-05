<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $holidays = Holiday::orderBy('date', 'desc')->get();
    return view('holidays.index')->with(compact('holidays'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $holiday = new Holiday;
    //dd($holiday);
    return view('holidays.create')->with(compact('holiday'));

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
      'date' => 'required',
      'name' => 'required',
    ]);
    $holiday = new Holiday;
    $holiday->date = $request->input('date');
    $holiday->name = $request->input('name');
    $holiday->save();
    return redirect(route('holidays.index'))->with('success', 'Holiday Created');
    //return redirect(route('holidays.show', ['date' => $holiday->date->format('d.m.Y')]))->with('success', 'Holiday Created');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Holiday  $holiday
   * @return \Illuminate\Http\Response
   */
  public function show(Holiday $holiday)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Holiday  $holiday
   * @return \Illuminate\Http\Response
   */
  public function edit(Holiday $holiday)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Holiday  $holiday
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Holiday $holiday)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Holiday  $holiday
   * @return \Illuminate\Http\Response
   */
  //public function destroy(Holiday $holiday)
  public function destroy($holiday)
  {
    $holiday = Holiday::where('date', '=', date('Y-m-d', strtotime($holiday)))->first();
    $holiday->delete();
    return redirect(route('holidays.index'))->with('success', 'Holiday removed');
  }
}
