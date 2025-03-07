<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Welcome page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    @auth
    @if(!session('welcome_message_shown'))
        <p style="color: navajowhite; font-weight: bold; font-size: 20px;">
            Welcome, you are logged in!
        </p>
        {{ session(['welcome_message_shown' => true]) }}
    @endif
    
    @if(auth()->user()->role_id === 1)
    <p>Hello <span>Administrator</span>, what will it be today?</p>
    <section class="basic_container">

        <a href="/assign-role">Regulate Users roles</a>
        
        <a href="/roles">Regulate Roles</a> 

        <a href="/manager">Page manager</a> 

        <a href="/navigation">Navigation manager</a> 

        @endif
        
        @if(auth()->user()->role_id !== 1)
        <p> Hello <span>{{ auth()->user()->name }}</span>, what will it be today?</p>
        
        <a href="/user-list">Show all Users</a> 
        @endif
        <a href="/all-posts">Show All Posts</a> 

    </section>
    <section class="basic_container">

        <a href="/my-posts">Show my Posts</a> 

        <a href="/create-post">Create a Post</a> 
       
    </section>


    <form class="log_out" action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    

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
            <h2 style="color: chocolate;">Don't have an account?</h2><br>
            </th></tr><br>
                @csrf
              <button type="submit" name="registerButton">Register here</button>
          </table>
        </form>
      </section>
    @endauth
</body>
</html>