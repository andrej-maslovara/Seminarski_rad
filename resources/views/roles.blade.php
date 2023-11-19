<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles regulation</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <a href="{{ url('/') }}"><button>< Go Back</button></a>
    @if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
    @endif
@if(auth()->user()->role_id === 1)
<section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; max-width: 25%; margin: 5px left;">
      
    <form action="{{ route('create-role') }}" method="POST">
        @csrf
            <ul style="list-style-type: none; padding: 20;">
        @foreach($roles as $role)
            <li style="margin-bottom: 25px;">
            <input type="radio" name="role" value="{{ $role->name }}"><span class="role">{{$role->name}}</span>
            </li>
            @endforeach
            </ul>
            <div style="border: 2px solid orange; background-color: DimGrey; padding: 20px; margin: 5px left;">
                <label for="new_role">New Role:</label>
                <input type="text" name="new_role">
                <button type="submit">Create Role</button>
            </div>
        </form>
        <form action="{{ route('delete-role', ['role' => $role->id]) }}" method="POST" 
        onsubmit="return confirmDelete();">
        @csrf
        @method('DELETE')

        <button type="submit" class="delete_button">Delete Role</button>

        <script>
            function confirmDelete() {
                var selectedRole = document.querySelector('input[name="role"]:checked');
                if (selectedRole && ['admin', 'editor', 'blogger', 'No role'].includes(selectedRole.value)) {
                    alert('Cannot delete special roles.');
                    return false; // Cancel the form submission
                }
                return confirm('Are you sure you want to delete this role?');
            }
        </script>
    </form>
</section>
    @endif

</body>
</html>