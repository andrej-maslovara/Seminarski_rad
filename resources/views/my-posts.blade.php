<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<section>
        <h2>My Posts</h2>
        @foreach($posts as $post)
        <section style="background-color: DimGrey; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}}</h3>
            @if($post['image'])
            <img src="{{ asset('storage/images/' . $post['image']) }}" alt="Post Image" style="max-width: 15%;">
            @else
            <p>No image available</p>
            @endif
            <p>{{$post['body']}}</p>
            
            @if(auth()->user()->id === $post->user_id)

            <p> <a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
            @endif
            @endforeach
        </section>
        <a href="{{ url('/') }}"><button>< Go Back</button></a>

</body>
</html>