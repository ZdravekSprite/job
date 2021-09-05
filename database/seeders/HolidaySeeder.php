<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('holidays')->delete();

    $holidays = [
      ['date' => date('Y-m-d', strtotime('1.1.2020')), 'name' => 'Nova godina'],
      ['date' => date('Y-m-d', strtotime('6.1.2020')), 'name' => 'Sveta tri kralja (Bogojavljenje)'],
      ['date' => date('Y-m-d', strtotime('12.4.2020')), 'name' => 'Uskrs'],
      ['date' => date('Y-m-d', strtotime('13.4.2020')), 'name' => 'Uskrsni ponedjeljak'],
      ['date' => date('Y-m-d', strtotime('1.5.2020')), 'name' => 'Praznik rada'],
      ['date' => date('Y-m-d', strtotime('30.5.2020')), 'name' => 'Dan državnosti'],
      ['date' => date('Y-m-d', strtotime('11.6.2020')), 'name' => 'Tijelovo'],
      ['date' => date('Y-m-d', strtotime('22.6.2020')), 'name' => 'Dan antifašističke borbe'],
      ['date' => date('Y-m-d', strtotime('5.8.2020')), 'name' => 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja'],
      ['date' => date('Y-m-d', strtotime('15.8.2020')), 'name' => 'Velika Gospa'],
      ['date' => date('Y-m-d', strtotime('1.11.2020')), 'name' => 'Dan svih svetih'],
      ['date' => date('Y-m-d', strtotime('18.11.2020')), 'name' => 'Dan sjećanja na žrtve Domovinskog rata i Dan sjećanja na žrtvu Vukovara i Škabrnje'],
      ['date' => date('Y-m-d', strtotime('25.12.2020')), 'name' => 'Božić'],
      ['date' => date('Y-m-d', strtotime('26.12.2020')), 'name' => 'Sveti Stjepan'],
      ['date' => date('Y-m-d', strtotime('1.1.2021')), 'name' => 'Nova godina'],
      ['date' => date('Y-m-d', strtotime('6.1.2021')), 'name' => 'Sveta tri kralja (Bogojavljenje)'],
      ['date' => date('Y-m-d', strtotime('4.4.2021')), 'name' => 'Uskrs'],
      ['date' => date('Y-m-d', strtotime('5.4.2021')), 'name' => 'Uskrsni ponedjeljak'],
      ['date' => date('Y-m-d', strtotime('1.5.2021')), 'name' => 'Praznik rada'],
      ['date' => date('Y-m-d', strtotime('30.5.2021')), 'name' => 'Dan državnosti'],
      ['date' => date('Y-m-d', strtotime('3.6.2021')), 'name' => 'Tijelovo'],
      ['date' => date('Y-m-d', strtotime('22.6.2021')), 'name' => 'Dan antifašističke borbe'],
      ['date' => date('Y-m-d', strtotime('5.8.2021')), 'name' => 'Dan pobjede i domovinske zahvalnosti i Dan hrvatskih branitelja'],
      ['date' => date('Y-m-d', strtotime('15.8.2021')), 'name' => 'Velika Gospa'],
      ['date' => date('Y-m-d', strtotime('1.11.2021')), 'name' => 'Dan svih svetih'],
      ['date' => date('Y-m-d', strtotime('18.11.2021')), 'name' => 'Dan sjećanja na žrtve Domovinskog rata i Dan sjećanja na žrtvu Vukovara i Škabrnje'],
      ['date' => date('Y-m-d', strtotime('25.12.2021')), 'name' => 'Božić'],
      ['date' => date('Y-m-d', strtotime('26.12.2021')), 'name' => 'Sveti Stjepan'],
    ];

    Holiday::insert($holidays);
  }
}
