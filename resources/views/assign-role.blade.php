<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign role</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<a href="{{ url('/') }}"><button>< Go Back</button></a>
<section>
    <h2>All Users</h2>
        @foreach($users as $user)
        @if($user->role_id !== 1)
        <section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
                <h3><span class="name">{{$user->name}}</span> - <span class="role">{{$user->role}}</span></h3>
                
                @if(auth()->user()->role_id === 1)
                    <form action="{{ route('assign-role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <label for="role">Select Role:</label>
                        <input type="radio" name="role" value="admin"> Admin
                        <input type="radio" name="role" value="editor"> Editor
                        <input type="radio" name="role" value="blogger"> Blogger
                        <button type="submit">Assign Role</button>
                    </form>
                    <form action="{{ route('delete-user', ['user' => $user->id]) }}" method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this user?');">

                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="delete_button">Delete User</button>
                    </form>
                @endif
            </section>
        @endif
    @endforeach

    @if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
    @endif
</section>


</body>
</html>