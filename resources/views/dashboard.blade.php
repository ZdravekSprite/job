<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          You're logged in!
          <!-- start 1 -->
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <form method="POST" action="{{ route('settings.update')}}">
            @csrf
            <div class="mt-4">
              <x-label for="start1" :value="__('Početak 1. smjene')" />
              <input id="start1" type="time" name="start1" value="{{ $settings ? $settings->start1->format('H:i') : old('start1')?? '06:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada započinje 1. smjena.</p>
              <x-label for="end1" :value="__('Kraj 1. smjene')" />
              <input id="end1" type="time" name="end1" value="{{ $settings ? $settings->end1->format('H:i') : old('end1')?? '14:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada završava 1. smjena.</p>
            </div>
            <div class="mt-4">
              <x-label for="start2" :value="__('Početak 2. smjene')" />
              <input id="start2" type="time" name="start2" value="{{ $settings ? $settings->start2->format('H:i') : old('start2')?? '14:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada započinje 2. smjena.</p>
              <x-label for="end2" :value="__('Kraj 2. smjene')" />
              <input id="end2" type="time" name="end2" value="{{ $settings ? $settings->end2->format('H:i') : old('end2')?? '22:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada završava 2. smjena.</p>
            </div>
            <div class="mt-4">
              <x-label for="start3" :value="__('Početak 3. smjene')" />
              <input id="start3" type="time" name="start3" value="{{ $settings ? $settings->start3->format('H:i') : old('start3')?? '22:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada započinje 3. smjena.</p>
              <x-label for="end2" :value="__('Kraj 3. smjene')" />
              <input id="end3" type="time" name="end3" value="{{ $settings ? $settings->end3->format('H:i') : old('end3')?? '06:00'}}" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
              <p>Vrijeme kada završava 3. smjena.</p>
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
