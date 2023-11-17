<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>

<a href="{{ url('/') }}"><button>< Go Back</button></a>
<br><br>
<section style="border: 2px solid orange; padding: 20px; max-width: 25%; margin: 5px left;">
        <h2>Create a new post</h2>
        <form action="/create-post" method=POST enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="post title" style="width: 20%";><br><br>
            <textarea name="body" cols="40" rows="7" placeholder="add text here"></textarea><br><br>
            <button>Submit Post</button><br><br>
        
            <input style="color: white"; type="file" name="image" accept="image/*"><br><br>
        </form>
    </section>
    <br>
    <a href="/my-posts">Show my Posts</a> <br>
</body>
</html>