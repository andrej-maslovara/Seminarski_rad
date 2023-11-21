<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
        <h2>My Posts</h2>
<section>
        @foreach($posts as $post)
        <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
            <h3><span class="post_title">{{$post['title']}}</span></h3>
            @if($post['image'])
            <img src="{{ asset('storage/images/' . $post['image']) }}" alt="Post Image" style="max-width: 50%;">
            @else
            <p style="color: red; font-style: italic;">No image available</p>
            @endif
            <p><span class="post_body">{{$post['body']}}</span></p>
            <br>
            @if(auth()->user()->id === $post->user_id)
            
            <a href="/edit-post/{{$post->id}}">Edit</a>
            <br><br>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="delete_button">Delete</button>
            </form>
            @endif
            <br>
        </section>
        @endforeach

        @if(session('success'))
        <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
        @endif
        </section>
        <br><br>
        <a href="{{ url('/') }}"><button>< Go Back</button></a>

</body>
</html>