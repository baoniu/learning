<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OverHook</title>
</head>
<body>
<h1>{{ $post->title }}</h1>
@can('show-post', $post)
    <a href="#">编辑文章</a>
@endcan
</body>
</html>