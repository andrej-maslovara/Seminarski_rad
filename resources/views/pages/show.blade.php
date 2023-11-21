<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showing {{ $page->title }}</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

</head>
<body>
@if(auth()->user()->role_id === 1)

<h1 style="color: navajowhite; font-weight: bold;">{{ $page->title }}</h1>

<a href="{{ url()->previous() }}" id="goBackLink"><button>< Go Back(really)</button></a>
<br>

<section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
    {!! $bladeContent !!}

    @foreach($page->elements as $element)
        <div style="color: {{ $element->color }}; font-size: {{ $element->font_size }};">
            {!! htmlspecialchars($element->content) !!}
        </div>
    @endforeach


<script>
    // Add a click event listener to specific clickable elements
    document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(e) {
        // Check if the clicked element is NOT the goBackLink
        if (!e.target.closest('#goBackLink')) {
            e.preventDefault();
        }
    });
});
</script>
</section>
@endif
</body>
</html>