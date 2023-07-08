<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener</title>
</head>
<body>
<form id="shorten-form">
    @csrf
    <input type="text" name="original_url" placeholder="Enter URL">
    <button type="submit">Shorten</button>
</form>

<div id="shortened-links">
    <h2>Last 10 Shortened Links:</h2>
    <ul>
        @foreach($links as $link)
            <li><a href="{{ route('redirect', $link->shortened_code) }}">{{ $link->shortened_code }}</a></li>
        @endforeach
    </ul>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#shorten-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('shorten') }}',
                data: $(this).serialize(),
                success: function(response) {
                    $('#shortened-url').html('Shortened URL: <a href="' + response.shortened_url + '">' + response.shortened_url + '</a>');

                    loadShortenedLinks();
                }
            });
        });

        function loadShortenedLinks() {
            $.ajax({
                type: 'GET',
                url: '{{ route('shortened-links') }}',
                success: function(response) {
                    $('#shortened-links').html(response);
                }
            });
        }

        loadShortenedLinks();
    });
</script>
</body>
</html>
