<h2>Last 10 Shortened Links:</h2>
<ul>
    @foreach($links as $link)
        <li><a href="{{ route('redirect', $link->shortened_code) }}">{{ $link->shortened_code }}</a></li>
    @endforeach
</ul>
