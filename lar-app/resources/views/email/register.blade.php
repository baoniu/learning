<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OverHook</title>
</head>
<body>
<h1>Hello Confirm You Email</h1>
<a href="{{ url('/verify/' . $confirm_code) }}">Confirm Email</a>
</body>
</html>