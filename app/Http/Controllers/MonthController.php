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
    $month->bruto = $request->input('bruto') ? $request->input('bruto') * 100 : null;
    $month->prijevoz = $request->input('prijevoz') ? $request->input('prijevoz') * 100 : null;
    $month->odbitak = $request->input('odbitak') ? $request->input('odbitak') * 100 : null;
    $month->prirez = $request->input('prirez') ? $request->input('prirez') * 100 : null;
    $old_month = Month::where('user_id', '=', Auth::user()->id)->where('month', '=', $month->month)->first();
    if ($old_month) return redirect(route('months.edit', ['month' => $month->slug()]))->with('new_month', $month)->with('warning', 'Day already exist');
    //dd($request,$month,$old_month);
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
    $data['III.godina'] = explode(".", $month)[1];
    $data['III.mjesec'] = explode(".", $month)[0];
    $unslug = $data['III.mjesec'] - 1 + $data['III.godina'] * 12;
    $month = Month::where('user_id', '=', Auth::user()->id)->where('month', '=', $unslug)->first();
    $days = $month->days();

    $from = $month->from();
    $to = $month->to();
    $data['III.od'] = $from->format('d');
    $data['III.do'] = $to->format('d');

    $hoursNorm = $month->hoursNorm();
    $bruto = $month->bruto ? $month->bruto : $month->last('bruto');
    $month->bruto = $bruto;
    $perHour = round(($bruto/ 100 / $hoursNorm->All), 2);
    $data['perHour'] = $perHour;
    $hoursWorkNorm = $hoursNorm->Work;
    //dd($hoursNorm, $bruto, $perHour);

    // 1.1. Za redoviti rad
    $h1_1 = $hoursNorm->min / 60 > $hoursWorkNorm ? $hoursWorkNorm : $hoursNorm->min / 60;
    $data['1.1.h'] = number_format($h1_1, 2, ',', '.');
    $data['1.1.kn'] = number_format($h1_1 * $perHour, 2, ',', '.');

    // 1.4 Za prekovremeni rad
    $h1_4 = $month->prekovremeni;
    $overWork = $hoursNorm->min / 60 - $hoursWorkNorm;

    $data['1.4.h'] = number_format($h1_4, 2, ',', '.') . ' (' . number_format($overWork, 2, ',', '.') . ')';
    $data['1.4.kn'] = number_format($h1_4 * $perHour * 1.5, 2, ',', '.');
    
    // 1.7a Praznici. Blagdani, izbori
    $data['1.7a.h'] = number_format($hoursNorm->Holiday, 2, ',', '.');
    $data['1.7a.kn'] = number_format($hoursNorm->Holiday * $perHour, 2, ',', '.');

    // 1.7b Godišnji odmor
    $data['1.7b.h'] = number_format($hoursNorm->GO, 2, ',', '.');
    $data['1.7b.kn'] = number_format($hoursNorm->GO * $perHour, 2, ',', '.');

    // 1.7c Plaćeni dopust
    $data['1.7c.h'] = number_format($hoursNorm->Dopust, 2, ',', '.');
    $data['1.7c.kn'] = number_format($hoursNorm->Dopust * $perHour, 2, ',', '.');

    // 1.7d Bolovanje do 42 dana
    $data['1.7d.h'] = number_format($hoursNorm->Sick, 2, ',', '.');
    $data['1.7d.kn'] = number_format($hoursNorm->Sick * $perHour * 0.7588, 2, ',', '.');

    // 1.7e Dodatak za rad nedjeljom
    $data['1.7e.h'] = number_format($hoursNorm->minSunday / 60, 2, ',', '.');
    $data['1.7e.kn'] = number_format($hoursNorm->minSunday / 60 * $perHour * 0.35, 2, ',', '.');

    // 1.7f Dodatak za rad na praznik
    $data['1.7f.h'] = number_format($hoursNorm->minHoliday / 60, 2, ',', '.');
    $data['1.7f.kn'] = number_format($hoursNorm->minHoliday / 60 * $perHour * 0.5, 2, ',', '.');

    //dd($month,$days);
    return view('months.show')->with(compact('month', 'days', 'data'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  //public function edit(Month $month)
  public function edit($month)
  {
    if (session('new_month')) {
      $month = session('new_month');
    } else {
      $unslug = explode(".", $month)[0] - 1 + explode(".", $month)[1] * 12;
      $month = Month::where('user_id', '=', Auth::user()->id)->where('month', '=', $unslug)->first();
    }
    //dd($month);
    return view('months.edit')->with(compact('month'));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  //public function update(Request $request, Month $month)
  public function update(Request $request,$month)
  {
    $this->validate($request, [
      'month' => 'required',
    ]);
    $month = Month::where('user_id', '=', Auth::user()->id)->where('month', '=', $request->input('month'))->first();
    $month->bruto = $request->input('bruto') ? $request->input('bruto') * 100 : $month->bruto;
    $month->prijevoz = $request->input('prijevoz') ? $request->input('prijevoz') * 100 : $month->prijevoz;
    $month->odbitak = $request->input('odbitak') ? $request->input('odbitak') * 100 : $month->odnitak;
    $month->prirez = $request->input('prirez') ? $request->input('prirez') * 100 : $month->prirez;
    $month->save();
    return redirect(route('months.show', ['month' => $month->slug()]))->with('success', 'Month Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Month  $month
   * @return \Illuminate\Http\Response
   */
  //public function destroy(Month $month)
  public function destroy($month)
  {
    $unslug = explode(".", $month)[0] - 1 + explode(".", $month)[1] * 12;
    $month = Month::where('month', '=', $unslug)->first();
    $month->delete();
    return redirect(route('months.index'))->with('success', 'Month removed');

  }
}
