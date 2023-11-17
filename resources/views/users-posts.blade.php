<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->name}}'s Posts</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<a href="{{ url('user-list') }}"><button>< Go Back</button></a>

<section>
    <h2>{{$user->name}}'s Posts</h2>

    @foreach($posts as $post)
        <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
            <h3><span class="post_title">{{$post['title']}}</span></h3>

            @if($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" alt="Post Image" style="max-width: 15%;">
            @else
                <p>No image available</p>
            @endif

            <p><span class="post_body">{{$post['body']}}</span></p>

            <p>
                <a href="{{ route('edit-post', ['id' => $post->id]) }}">Edit</a>
                <form action="{{ route('delete-post', ['id' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete_button">Delete</button>
                </form>
            </p>
        </section>
    @endforeach
</section>
@if(session('success'))
        <p style="color: green; font-size: 20px;">{{ session('success') }}</p>
    @endif
</body>
</html>