<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

</head>
<body>
@if(auth()->user()->role_id === 1)
<h1 style="color: navajowhite; font-weight: bold;">Create page</h1>

<a href="{{ url('/') }}"><button>< Go Back</button></a>
<br><br>

@if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
  @endif
  <br>
  
<section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 50%; margin: 5px left;">
    <!-- Creating a new page -->
    <form action="{{ route('create-page') }}" method="POST">
        @csrf
        <label for="pageTitle">Page Title:</label>
        <input type="text" id="pageTitle" name="pageTitle" required>
        
        <label for="pageContent">Page Content:</label>
        <textarea name="pageContent" id="pageContent" style="width: 100%; height: 500px;"></textarea>

        <br>
        <button type="submit">Create Page</button>
    </form>
</section>

@endif
</body>
</html>