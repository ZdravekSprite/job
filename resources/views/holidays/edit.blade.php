<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $holiday->date->format('Y-m-d') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          Edit {{$holiday->date->format('Y-m-d')}}!
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <form method="POST" action="{{ route('holidays.update', ['holiday' => $holiday->date->format('d.m.Y')]) }}">
            @csrf
            @method('PUT')
            <!-- date -->
            <div class="mt-4">
              <x-label for="date" :value="__('Datum')" />
              <input id="date" class="hidden" type="date" name="date" value="{{$holiday->date->format('Y-m-d')}}" required />
              {{$holiday->date->format('Y-m-d')}}
            </div>

            <!-- name -->
            <div class="mt-4">
              <x-label for="name" :value="__('Praznik')" />
              <input id="name" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="name" value="{{$holiday->name ? $holiday->name : old('name')?? ''}}" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
              <x-button class="ml-4">
                {{ __('Spremi') }}
              </x-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
