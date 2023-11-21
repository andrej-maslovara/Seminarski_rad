<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize the {{ $page->title }}</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
@if(auth()->user()->role_id === 1)

<h1 style="color: navajowhite; font-weight: bold;">{{ $page->title }}</h1>
<a href="{{ url('manager') }}"><button>< Go Back</button></a>
<br>
@if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
  @endif
<br>

<section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 50%; margin: 5px left;">
    <!-- Editing page -->
    <form action="{{ route('save-raw-code', ['title' => $page->title]) }}" method="POST">
        @csrf
        <textarea name="rawCode" id="rawCode" style="width: 100%; height: 500px;">{!! htmlspecialchars($bladeContent) !!}</textarea>
        <br>
        <button type="submit">Save Changes</button>
    </form>

    <!-- Delete page -->
    <form action="{{ route('delete-page', ['title' => $page->title]) }}" method="POST" style="margin-top: 10px;">
        @csrf
        @method('DELETE')
        <button class="delete_button" type="submit" onclick="return confirm('Are you sure you want to delete this page?')">Delete Page</button>
    </form>
</section>

@endif
</body>
</html>