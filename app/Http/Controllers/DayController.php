<?php

namespace App\Http\Controllers;

use App\Models\Day;
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
    $days = Day::orderBy('date','desc')->where('user_id', '=', Auth::user()->id)->get();
    //dd($days);
    return view('days.index')->with(compact('days'));
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $day = new Day;
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
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  public function show(Day $day)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  public function edit(Day $day)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Day $day)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Day  $day
   * @return \Illuminate\Http\Response
   */
  public function destroy(Day $day)
  {
    //
  }
}
