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
    <p style="color: navajowhite; font-weight: bold;
    font-size: 26px;";>Hello <span style="color: magenta; font-weight: bold; font-size: 30px;">Administrator</span>, what will it be today?</p>
    <section style="border: 3px solid lightblue; padding: 10px; width: 25%; margin: 0 left;">

        <a href="/assign-role" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Regulate Users roles</a>
        
        <a href="/roles" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Regulate Roles</a> 

        <a href="/manager" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Page manager</a> 

        <a href="/navigation" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Navigation manager</a> 

        @endif
        
        @if(auth()->user()->role_id !== 1)
        <p style="color: navajowhite; font-weight: bold;
        font-size: 26px;";>Hello <span style="color: magenta; font-weight: bold; font-size: 30px;">{{ auth()->user()->name }}</span>, what will it be today?</p>
        <br style="line-height: 40px;">
        
        <a href="/user-list" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Show all Users</a> 
        @endif
        <a href="/all-posts" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Show All Posts</a> 

    </section>
    <section style="border: 3px solid lightblue; padding: 10px; width: 25%; margin: 0 left;">

        <a href="/my-posts" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Show my Posts</a> 

        <a href="/create-post" style="display: block; margin-bottom: 20px; border: 1px solid beige; padding: 10px;">Create a Post</a> 
       
    </section>

    
    <br style="line-height: 50px;">
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