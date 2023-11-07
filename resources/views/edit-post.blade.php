<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
  <section>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
    @csrf
    @method('PUT')
    <table><th><tr>
      <input type="text" name="title" value="{{$post->title}}">
          </th></tr><br><br>
          <th><tr>
    <textarea name="body" id="" cols="30" rows="10">{{$post->body}}</textarea>
          </th></tr><br><br>
    <button>Save Changes</button>
    </table>
    </form>
  </section>
</body>
</html>