<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" title="{{$month->month}}">
      {{ __('Mjesec') }} {{ $month->slug() }}
    </h2>
    <div class="px-6">
      <p>Bruto: {{number_format($month->bruto/100, 2, ',', ' ')}}</p>
      <p>Prijevoz: {{$month->prijevoz ? number_format($month->prijevoz/100, 2, ',', ' ') : number_format($month->last('prijevoz')/100, 2, ',', ' ')}}</p>
      <p>Odbitak: {{$month->odbitak ? number_format($month->odbitak/100, 2, ',', ' ') : number_format($month->last('odbitak')/100, 2, ',', ' ')}}</p>
      <p>Prirez: {{$month->prirez ? number_format($month->prirez/100, 2, ',', ' ') : number_format($month->last('prirez')/100, 2, ',', ' ')}}</p>
    </div>
  </x-slot>

  @include('months.list')
  @include('months.payroll')
</x-app-layout>
