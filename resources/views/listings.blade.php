<h1>{{$title}}</h1>
<section>
  @if (isset($listings) && count($listings) != 0)
    @foreach($listings as $index => $listing)
      <article id="listing-{{ $index + 1 }}">
        <h2>
          <a href="/listings/{{$listing['id']}}">{{ $listing['title'] }}</a>
        </h2>
        <p>{{ $listing['description'] }}</p>
      </article>
    @endforeach
  @else
    <p>No listings to be displayed...</p>
  @endif
</section>
