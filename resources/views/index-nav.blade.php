<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit navigation</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">

</head>
<body>
@if(auth()->user()->role_id === 1)
<a href="{{ url('/') }}"><button>< Go Back</button></a>
<br>
@if(session('success'))
    <p style="color: limegreen; font-size: 24px;">{{ session('success') }}</p>
  @endif
  <br>
<!-- Section for creating new navigation item -->
<section style="border: 2px solid orange; background-color: DimGrey; padding: 20px; width: 35%; margin: 5px left; float: left;">
    <h2>Create New Navigation Item</h2>
    <form action="{{ route('navigation.store') }}" method="POST">
    @csrf

    <label style="color: white;" for="createTitle">Title:</label>
    <input style="width: 50%;" type="text" name="title" id="createTitle" required>
    <br>
    <p>Add new URL or choose from an existing one</p>

    <label style="color: white;" for="createUrl">URL:</label>
    <input type="url" name="url" id="createUrl" required onchange="toggleInput(this, 'selectUrl')">
    <br><br>

    <select name="existing_url" id="selectUrl" required onchange="toggleInput(this, 'createUrl')">
    <option value="" disabled selected>Select an option</option>
    @foreach($navigations as $item)
        <option value="{{ $item->url }}">{{ $item->title }}</option>
    @endforeach
    <option value="cancel">Cancel selection</option>
</select>
<br><br>
    <button type="submit">Create Navigation Item</button>
</form>

<script>
    function toggleInput(selected, otherInputId) {
        const otherInput = document.getElementById(otherInputId);

        if (selected.value !== '' && selected.value !== 'cancel') {
            otherInput.setAttribute('disabled', 'true');
        } else {
            otherInput.removeAttribute('disabled');
        }
    }
</script>

</section>
<br style="line-height: 24;">
<!-- Display navigation items -->
<h2>All Navigation items</h2>

@foreach($navigations as $navigation)
<section style="border: 2px solid orange; background-color: DimGrey; padding: 5px; width: 35%; margin: 5px left; float: left;">
    <span class="name">Page name - <strong>{{ $navigation->title }}</strong></span>
    <br><span class="role">Page URL - <strong>{{ $navigation->url }}</strong></span>
        <form action="{{ route('navigation.destroy', $navigation) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="delete_button" type="submit">Delete</button>
        </form>
    <br>
<!-- Section for editing navigation item -->
<br>
<form action="{{ route('navigation.update', $navigation) }}" method="POST">
    @csrf
    @method('PUT')

    <label style="color: white;" for="editTitle">Title:</label>
    <input style="width: 50%;" type="text" name="title" id="editTitle" value="{{ $navigation->title }}" required>
    <br><br>
    <select name="url" id="createUrl" required>
        <option value="" disabled>Select an option</option>
        @foreach($navigations as $item)
            <option value="{{ $item->url }}" {{ $navigation->url === $item->url ? 'selected' : '' }}>
                {{ $item->title }}
            </option>
        @endforeach
    </select>
<br><br>
    <button type="submit">Update Navigation Item</button>
    </form>
   
    </section>
    @endforeach

@endif
</body>
</html>