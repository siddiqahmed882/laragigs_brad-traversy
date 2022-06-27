<h1>{{$title}}</h1>
<section>
  <article id="listing-{{ $listing['id'] + 1 }}">
    <h2>
      <a href="/listings/{{$listing['id']}}">{{ $listing['title'] }}</a>
    </h2>
    <p>{{ $listing['description'] }}</p>
  </article>
</section>