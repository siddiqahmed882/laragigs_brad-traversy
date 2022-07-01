@extends('layout')

@section('content')
  <x-card class="p-10">
    <header>
      <h1 class="my-6 text-center text-3xl font-bold uppercase">
        Manage Gigs
      </h1>
    </header>
    <table class="w-full table-auto rounded-sm">
      <tbody>
        @if(count($listings) != 0)
          @foreach ($listings as $listing)   
            <tr class="border-gray-300">
              <td class="border-t border-b border-gray-300 px-4 py-4 text-lg">
                <a href="/listings/{{$listing->id}}">
                  {{$listing->title}}
                </a>
              </td>
              <td class="border-t border-b border-gray-300 px-4 py-4 text-lg">
                <a href="/listings/{{$listing->id}}/edit" class="rounded-xl px-6 py-2 text-blue-400">
                  <i class="fa-solid fa-pen-to-square"></i>
                  Edit
                </a>
              </td>
              <td class="border-t border-b border-gray-300 px-4 py-4 text-lg">
                <form action="/listings/{{$listing->id}}/delete" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-500">
                    <i class="fa-solid fa-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <p class="text-center">No listings found</p>
            </td>
          </tr> 
        @endif

      </tbody>
    </table>
  </x-card>
@endsection
