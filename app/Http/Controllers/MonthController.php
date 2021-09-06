<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthController extends Controller
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
    $months = Month::orderBy('month','desc')->where('user_id', '=', Auth::user()->id)->get();
    return view('months.index')->with('months', $months);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $month = new Month;
    //dd($day);
    return view('months.create')->with(compact('month'));

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
      'month' => 'required',
      'year' => 'required'
    ]);
    $month = new Month;
    $month->month = $request->input('month')-1+$request->input('year')*12;
    $month->user_id = Auth::user()->id;
    //dd($request,$month);
    $month->save();
    return redirect(route('months.show', ['month' => $month->slug()]))->with('success', 'Month Created');

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  //public function show(Month $month)
  public function show($month)
  {
    $unslug = explode(".", $month)[0] - 1 + explode(".", $month)[1] * 12;
    $month = Month::where('user_id', '=', Auth::user()->id)->where('month', '=', $unslug)->first();
    //dd($month);
    return view('months.show')->with(compact('month'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  public function edit(Month $month)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Month $month)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  public function destroy(Month $month)
  {
    //
  }
}
