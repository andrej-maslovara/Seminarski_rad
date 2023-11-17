<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All posts</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>

<a href="{{ url('/') }}"><button>< Go Back</button></a>
<br>

        <h2>All Posts</h2>
        @foreach($posts as $post)
        <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
            <h3>
                <span class="post_title">{{$post['title']}}</span> 
                <span class="name">  by  {{$post->user->name}}</span> - 
                <span style="color: orange;">{{$post->user->role}}</span></h3>
            
            @if($post['image'])
            <img src="{{ asset('storage/images/' . $post['image']) }}" alt="Post Image" style="max-width: 80%;">
            @else
            <p style="color: red; font-style: italic;">No image available</p>
            @endif
            <p><span class="post_body">{{$post['body']}}</span></p>
            
            @if(auth()->user()->id === $post->user_id || auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
            <a href="/edit-post/{{$post->id}}">Edit</a>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="delete_button">Delete</button>
            </form>
            @else
            <p>You do not have permission to edit or delete this post.</p>
            @endif
           </section>
           <br>
        @endforeach
    
</body>
</html>