<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dan') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3>Day {{ $day->date->format('d.m.Y') }}!</h3>
          <p>state {{ $day->state }}</p>
          <p>smjena je započela u {{ $day->start->format('H:i') }}</p>
          <p>smjena je završila u {{ $day->end->format('H:i') }}</p>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
