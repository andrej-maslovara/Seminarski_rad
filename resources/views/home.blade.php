<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Welcome page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    @auth
    <p style="color: navajowhite; font-weight: bold;
    font-size: 20px;";>Welcome, you are logged in!</p></th></tr><br>

    @if(auth()->user()->role_id === 1)
    <p style="color: white";> <a href="/assign-role">Show all Users</a> </p>
        @endif
        <br>
    <section style="border: 3px solid orange; padding: 10px;">
        <h2>Create a new post</h2>
        <form action="/create-post" method=POST enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="post title" style="width: 20%";><br><br>
            <textarea name="body" cols="40" rows="7" placeholder="add text here"></textarea><br><br>
            <button>Submit Post</button><br><br>
        
            <input style="color: white"; type="file" name="image" accept="image/*"><br><br>
        </form>
    </section>

    <section>
        <h2>All Posts</h2>
        @foreach($posts as $post)
        <section style="background-color: DimGrey; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            <p>{{$post['body']}}</p>
            @if($post['image'])
            <img src="{{ asset('storage/images/' . $post['image']) }}" alt="Post Image" style="max-width: 15%;">
            @else
            <p>No image available</p>
            @endif
            
            @if(auth()->user()->id === $post->user_id || auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
                <p> <a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
            @else
            <p>You do not have permission to edit or delete this post.</p>
            @endif
           </section>
        @endforeach
        
        <p style="color: white"><a href="/my-posts">Show my Posts</a></p>

    </section>

    <section>
        <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
        </form>
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