<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    @auth
    <p>Welcome, you are logged in!</p>
    <form action="/logout" method="POST">
    @csrf
    <button>Log out</button>
    @else

    <section class="register-container";>
    <h2>If you don't have an account, please Register here</h2>
    <form action="/register" method="POST">
        @csrf
        
        <table class="register_table";>
          <tr class="register_table";> <th> 
            <input required id="name" name='name' type="text" placeholder="name"> </th> </tr> <br>
          <tr class="register_table";> <th> 
            <input required id="email" name='email' type="email" placeholder="email"> </th> </tr> <br>
          <tr class="register_table";> <th> 
            <input required id="password" name='password' type="password" placeholder="password"> </th> </tr> <br>
        <button>Register</button><br><br>
        </table>
    </section>
    <br><br><br>
    <section class="login-container";>
    <h2><b>If you already have an account, please Login</b></h2>
    <form action="/login" method="POST">
        @csrf
        <table class="login_table";>
            <tr class="login_table";>
        <th> <input required name='login_name' type="text" placeholder="name"> </th> </tr> <br>
            <tr class="login_table";>
        <th> <input required name='login_password' type="password" placeholder="password"> </th> </tr>
        </table> <br>
        <button>Login</button>
    </section>
    @endauth
</body>
</html>