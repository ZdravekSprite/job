<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Novi mjesec') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          Create new!
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />

          <form method="POST" action="{{ route('months.store') }}">
            @csrf

            <!-- month -->
            <div class="mt-4">
              <x-label for="month" :value="__('Mjesec')" />
              <select class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="month" name="month">
                @for($month=1; $month <= 12; $month++)
                  <option value="{{$month}}">{{$month}}</option>
                @endfor
              </select>

            <!-- year -->
            <div class="mt-4">
              <x-label for="year" :value="__('Godina')" />
              <select class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="year" name="year">
                @for($year=2020; $year <= 2022; $year++)
                  <option value="{{$year}}">{{$year}}</option>
                @endfor
              </select>

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
