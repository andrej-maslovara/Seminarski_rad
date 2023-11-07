<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Welcome page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    @auth
    <table><th><tr>
        <p>Welcome, you are logged in!</p></th></tr><br>
        <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
        </form>
    </table>

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

    <section class="login-container";>
    <h2>Please Login</h2>
    <form action="/login" method="POST">
        @csrf
        <table class="login_table";>
            <tr class="login_table";>
        <th> <input required name='login_name' type="text" placeholder="name"> </th> </tr> <br>
            <tr class="login_table";>
        <th> <input required name='login_password' type="password" placeholder="password"> </th> </tr><br>
        <th class="login_table";>
        <button>Login</button></th><br>
        </table>
        </form>
    </section>
      <section class="register-container">
        <form action="{{ route('register') }}" method="GET">
          <table>
            <th><tr>
            <h2>Don't have an account?</h2><br>
            </th></tr><br>
                @csrf
              <button type="submit" name="registerButton">Register here</button>
          </table>
        </form>
      </section>
    @endauth
</body>
</html>