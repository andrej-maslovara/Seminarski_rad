<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    
    <section class="register-container";>
    <h2>We're glad you can join us.</h2>
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
      </form>
    </section>
   </body>
</html>