@extends('layout')

@section('content')
  @include('partials._hero')
  @include('partials._search')
  <div class="mx-4 gap-4 space-y-4 md:space-y-0 lg:grid lg:grid-cols-2">
    @if (isset($listings) && count($listings) != 0)
      @foreach ($listings as $index => $listing)
        <x-listing-card :listing="$listing" />
      @endforeach
    @else
      <p>No listings to be displayed...</p>
    @endif
  </div>
  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
@endsection

{{-- to pass variable as prop, prefix the name with colon --}}
