<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<a href="{{ url('/') }}"><button>< Go Back</button></a>
    <section>
    <h2>All Users</h2>
        @foreach($users as $user)
        <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
                <h3><span class="name">{{$user->name}}</span> - 
                    <span class="role">{{$user->role}}</span></h3>
                    <a href="{{ url('/users-posts/' . $user->id) }}">View Posts</a>
        </section>
        @endforeach
    </section>
</body>
</html>