<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <body>
    <a href="{{route('admin.users.posts')}}"> all posts</a><br>
    <a href="{{route('admin.users.list')}}"> all users</a>
    <div style="display: flex;justify-content: space-between">
        <a href="{{route('home.create')}}"> create moderator or user</a>
        <a href="{{route('logout')}}">logout</a>
    </div>

</body>
</html>
