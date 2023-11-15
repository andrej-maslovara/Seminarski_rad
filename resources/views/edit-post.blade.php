<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
<section>
  @if(auth()->user()->id === $post->user_id || auth()->user()->role_id === 1 || auth()->user()->role_id === 2)
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label for="title">Title:</label>
      <input type="text" name="title" value="{{$post->title}}"><br><br>

      <label for="body">Body:</label>
      <textarea name="body" cols="30" rows="10">{{$post->body}}</textarea><br><br>

      @if($post->image)
        <label for="remove_image">Remove Image:</label>
        <input type="checkbox" name="remove_image" id="remove_image">
        <br><br>

        <label for="new_image">Change Image:</label>
        <input type="file" name="new_image" id="new_image">
        <br><br>
      @endif

      <button>Save Changes</button>
    </form>
  @endif
</section>
<br>
<a href="{{ url('/') }}"><button>< Go Back</button></a>

</body>
</html>