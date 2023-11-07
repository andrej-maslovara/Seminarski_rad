<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
  <section>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{$post->title}}"><br><br>
    <textarea name="body" id="" cols="30" rows="10">{{$post->body}}</textarea><br><br>
    <button>Save Changes</button>
    </form>
  </section>
</body>
</html>