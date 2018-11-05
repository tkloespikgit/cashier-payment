<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Errors - {{$exception ->getMessage()?? 'page not found !'}}</title>
    @include('include.admin-links')
</head>
<body>
404
</body>
@include('include.admin-scripts')
</html>