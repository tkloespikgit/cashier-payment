<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IFrame</title>
    @include('include.admin-links')
</head>
<body>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5>@yield('title')</h5>
            </div>
            <div class="panel-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
@include('include.admin-scripts')
</html>