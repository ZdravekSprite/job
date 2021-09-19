<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <table class="table-fixed" id="payroll">
          <thead>
            <tr>
              <th class="w-32">
                <a href="{{ route('months.show', ['month' => $month->prev()]) }}#payroll" title="{{$month->prev()}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                  </svg>
                </a>
              </th>
              <th class="w-32" colspan="3">
                <a class="float-right" href="{{ route('months.show', ['month' => $month->next()]) }}#payroll" title="{{$month->next()}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                  </svg>
                </a>
              </th>
            </tr>
            <tr>
              <th class="w-1/2 text-left"><b>OBRAČUN ISPLAĆENE PLAĆE</b></th>
              <th class="w-1/2 text-right" colspan="3"><b>Obrazac IP1</b></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border p-2">
                <ul>
                  <li><b>I. PODACI O POSLODAVCU</b></li>
                  <li>1. Tvrtka/ Ime i prezime: ____</li>
                  <li>2. Sjedište / Adresa: ____</li>
                  <li>3. Osobni identifikacijski broj: ____</li>
                  <li>4. IBAN broj računa ____ kod ____</li>
                </ul>
              </td>
              <td class="border p-2" colspan="3">
                <ul>
                  <li><b>II. PODACI O RADNIKU/RADNICI</b></li>
                  <li>
                    1. Ime i prezime: <b>{{ Auth::user()->name }}</b>
                  </li>
                  <li>2. Adresa: ____</li>
                  <li>3. Osobni identifikacijski broj: ____</li>
                  <li>4. IBAN broj računa ____ kod ____</li>
                  <li>5. IBAN broj računa iz čl. 212. Ovršnog zakona ____ kod ____</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td class="border p-2" colspan="4"><b>III. RAZDOBLJE NA KOJE SE PLAĆA ODNOSI:</b> GODINA {{ $data['III.godina'] }}, MJESEC
                {{ $data['III.mjesec'] }} DANI U MJESECU OD {{ $data['III.od'] }} DO {{ $data['III.do'] }}</td>
            </tr>
            <tr>
              <td class="w-3/4 border p-2" colspan="2"><b>1. OPIS PLAĆE</b></td>
              <td class="w-1/8 border p-2 text-center"><b>SATI</b></td>
              <td class="w-1/8 border p-2 text-right"><b>IZNOS</b></td>
            </tr>
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.1. Za redoviti rad</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.1.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.1.kn'] }}</td>
            </tr>
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.4 Za prekovremeni rad</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.4.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.4.kn'] }}</td>
            </tr>
            @if($data['1.7a.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7a Praznici. Blagdani, izbori</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7a.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7a.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7b.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7b Godišnji odmor</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7b.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7b.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7c.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7c Plaćeni dopust</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7c.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7c.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7d.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7d Bolovanje do 42 dana</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7d.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7d.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7e.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7e Dodatak za rad nedjeljom</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7e.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7e.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7f.h'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7f Dodatak za rad na praznik</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7f.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7f.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7g.kn'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7g Dodatak za noćni rad</td>
              <td class="w-1/8 border p-2 text-center">{{ $data['1.7g.h'] }}</td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7g.kn'] }}</td>
            </tr>
            @endif
            @if($data['1.7p.kn'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">1.7.P Nagrada za radne rezultate</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['1.7p.kn'] }}</td>
            </tr>
            @endif

            <tr>
              <td class="w-3/4 border p-2" colspan="2">2. OSTALI OBLICI RADA TEMELJEM KOJIH OSTVARUJE PRAVO NA UVEĆANJE PLAĆE PREMA KOLEKTIVNOM UGOVORU, PRAVILNIKU O RADU ILI UGOVORU O RADU I NOVČANI IZNOS PO TOJ OSNOVI (SATI PRIPRAVNOSTI)</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">
              @if($data['2.8.kn'] > 0)
              {{ $data['2.kn'] }}
              @endif
              </td>
            </tr>
            @if($data['2.8.kn'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">2.8. Stimulacija bruto</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['2.8.kn'] }} ({{ $data['extra'] }})</td>
            </tr>
            @endif

            <tr>
              <td class="w-3/4 border p-2" colspan="2">3. PROPISANI ILI UGOVORENI DODACI NA PLAĆU RADNIKA I NOVČANI IZNOSI PO TOJ OSNOVI</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['3.kn'] }}</td>
            </tr>
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">3.1. Prijevoz</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['3.1.kn'] }}</td>
            </tr>
            @if($data['3.7.kn'] > 0)
            <tr>
              <td class="w-3/4 border p-2 pl-6" colspan="2">3.7. Regres za godišnji odmor</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['3.7.kn'] }}</td>
            </tr>
            @endif

            <tr>
              <td class="w-3/4 border p-2" colspan="2">4. ZBROJENI IZNOSI PRIMITAKA PO SVIM OSNOVAMA PO STAVKAMA 1. DO 3.</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right">{{ $data['4.kn'] }}</td>
            </tr>

            <tr>
              <td class="w-3/4 border p-2" colspan="2"><b>5. OSNOVICA ZA OBRAČUN DOPRINOSA</b></td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right"><b>{{ $data['5.kn'] }}<b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
