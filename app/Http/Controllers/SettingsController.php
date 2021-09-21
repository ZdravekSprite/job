<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
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
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
   * @param  \App\Models\Settings  $settings
   * @return \Illuminate\Http\Response
   */
  public function show(Settings $settings)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Settings  $settings
   * @return \Illuminate\Http\Response
   */
  public function edit(Settings $settings)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Settings  $settings
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Settings $settings)
  {
    $settings = Settings::where('user_id', '=', Auth::user()->id)->first();
    if (!$settings) {
      $settings = new Settings();
      $settings->user_id = Auth::user()->id;
    }
    $settings->start1 = $request->input('start1') ?? $settings->start1;
    $settings->end1 = $request->input('end1') ?? $settings->end1;
    $settings->start2 = $request->input('start2') ?? $settings->start2;
    $settings->end2 = $request->input('end2') ?? $settings->end2;
    $settings->start3 = $request->input('start3') ?? $settings->start2;
    $settings->end3 = $request->input('end3') ?? $settings->end2;
    //dd($day);
    $settings->save();
    return redirect(route('dashboard'))->with('success', 'Settings Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Settings  $settings
   * @return \Illuminate\Http\Response
   */
  public function destroy(Settings $settings)
  {
    //
  }
}
