<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{config('app.name')}}-Control center portal">
    <meta name="author" content="toby chan">
    <title>{{config('app.name')}}-Control center portal</title>
    @include('include.admin-links')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">请登录</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{url('login')}}" method="post">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="账号" name="account" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="密码" name="password" type="password" value="">
                            </div>
                            @include('include.captcha')
                            <input type="submit" name="doSubmit" class="btn btn-success btn-block" value="登录">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('include.admin-scripts')
</body>
</html>
