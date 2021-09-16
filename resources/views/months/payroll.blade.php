<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <table class="table-fixed">
          <thead>
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

            <tr>
              <td class="w-3/4 border p-2" colspan="2">2. OSTALI OBLICI RADA TEMELJEM KOJIH OSTVARUJE PRAVO NA UVEĆANJE PLAĆE PREMA KOLEKTIVNOM UGOVORU, PRAVILNIKU O RADU ILI UGOVORU O RADU I NOVČANI IZNOS PO TOJ OSNOVI (SATI PRIPRAVNOSTI)</td>
              <td class="w-1/8 border p-2 text-center"></td>
              <td class="w-1/8 border p-2 text-right"></td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
