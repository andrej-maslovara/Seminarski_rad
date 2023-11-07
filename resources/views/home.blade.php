<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Welcome page</title>
    <style>
        body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/body_image.jpg') }}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        }

        h2 {
           color: white;
        }
    </style>
</head>
<body>
    @auth
    <p>Welcome, you are logged in!</p>
    <form action="/logout" method="POST">
    @csrf
    <button>Log out</button>
    </form>

    <section style="border: 3px solid orange; padding: 10px;">
        <h2>Create a new post</h2>
        <form action="/create-post" method=POST>
            @csrf
            <input type="text" name="title" placeholder="post title"><br><br>
            <textarea name="body" cols="30" rows="5" placeholder="add text here"></textarea><br><br>
            <button>Submit Post</button>
        </form>
    </section>

    <section>
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <section style="background-color: DimGrey; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            <p>{{$post['body']}}</p>
            <p> <a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
        </section>
        @endforeach
    </section>

    @else

    <section style="border: 3px solid green;">
    <h2>Register</h2>
    <form action="/register" method="POST">
        @csrf 
        <input name='name' type="text" placeholder="name">
        <input name='email' type="email" placeholder="email">
        <input name='password' type="password" placeholder="password">
        <button>Register</button>
    </form>
    </section>
    <section style="border: 3px solid purple;">
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf 
        <input name='login_name' type="text" placeholder="name">
        <input name='login_password' type="password" placeholder="password">
        <button>Login</button>
    </form>
    </section>
    @endauth
</body>
</html>