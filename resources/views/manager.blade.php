<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Look or change Pages</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
@if(auth()->user()->role_id === 1)
<h1 style="color: navajowhite; font-weight: bold;">Page Manager</h1>

<a href="{{ url('/') }}"><button>< Go Back</button></a>
<br><br>
<section style="border: 3px solid lightblue; padding: 10px; width: 18%; margin: 0 left;">
    <a href="/create-page" style="display: block; padding: 10px;">Create a new page</a> 
</section>
@if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
  @endif
  <br>
  
  @foreach($pages as $page)
    <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left; float: left;">
        <h2>{{ $page->title }}</h2>

        <a href="{{ route('pages.show', ['title' => $page->title]) }}">View Page</a>
        <br><br>
        <a href="{{ route('customize.show', ['title' => $page->title]) }}">Customize Page</a>
    </section>
@endforeach


@endif
</body>
</html>