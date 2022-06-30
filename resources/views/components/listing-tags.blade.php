@props(['tags_csv'])

@php
  $tags = (explode(',', $tags_csv));
  $tags = array_map(fn($tag) => trim($tag), $tags);
@endphp

<ul class="flex flex-wrap gap-1">
  @foreach ($tags as $tag)
    <li class="flex items-center justify-center rounded-xl bg-black py-1 px-3 text-xs text-white">
      <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li>
  @endforeach
</ul>