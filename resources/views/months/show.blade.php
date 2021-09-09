<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mjesec') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3 title="{{$month->month}}">Month {{ $month->slug() }}!</h3>
          <p>Bruto: {{$month->bruto ? number_format($month->bruto/100, 2, ',', ' ') : number_format($month->last('bruto')/100, 2, ',', ' ')}}</p>
          <p>Prijevoz: {{$month->prijevoz ? number_format($month->prijevoz/100, 2, ',', ' ') : number_format($month->last('prijevoz')/100, 2, ',', ' ')}}</p>
          <p>Odbitak: {{$month->odbitak ? number_format($month->odbitak/100, 2, ',', ' ') : number_format($month->last('odbitak')/100, 2, ',', ' ')}}</p>
          <p>Prirez: {{$month->prirez ? number_format($month->prirez/100, 2, ',', ' ') : number_format($month->last('prirez')/100, 2, ',', ' ')}}</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
