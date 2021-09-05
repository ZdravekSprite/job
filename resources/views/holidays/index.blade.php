<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Praznici') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @if(count($holidays) > 0)
          @foreach($holidays as $day)
          <div class="container">
            <a href="{{ route('holidays.show', ['holiday' => $day->date->format('d.m.Y')]) }}" title="{{$day->name}}">{{$day->date->format('d.m.Y')}}</a>
            {{$day->name}}
            <a class="float-right" style="color:black" href="{{ route('holidays.destroy', ['holiday' => $day->date->format('d.m.Y')]) }}" onclick="event.preventDefault();
    document.getElementById('delete-form-{{ $day->date->format('d.m.Y') }}').submit();" title="Izbriši">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </a>
            <form id="delete-form-{{ $day->date->format('d.m.Y') }}" action="{{ route('holidays.destroy', ['holiday' => $day->date->format('d.m.Y')]) }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
            </form>
          </div>
          @endforeach
          @else
          <p> No holidays found</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
