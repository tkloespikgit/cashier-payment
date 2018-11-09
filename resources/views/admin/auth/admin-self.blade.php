@extends('layout.admin')
@section('page-name','编辑个人信息')
@section('body')
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5>{{$admin ->name}}</h5>
            </div>
            <div class="panel-body">
                <form method="post" >
                    {{csrf_field()}}
                    <p><span class="text-primary inline-key">Name :</span>
                        <input type="text" value="{{$admin ->name}}" required placeholder="name" name="name" class="form-control" style="display: inline-block;width: 150px"></p>
                    <p><span class="text-primary inline-key">Password :</span>
                        <input type="password" value="" placeholder="required" name="password" class="form-control" style="display: inline-block;width: 150px"></p>
                    <p><span class="text-primary inline-key">Account :</span> <span class="text-danger">{{hideString($admin ->account)}}</span></p>
                    <p><span class="text-primary inline-key">Mobile Phone :</span> <span class="text-danger">{{hideString($admin ->phone)}}</span></p>
                    <p><span class="text-primary inline-key">Emails :</span> <span class="text-danger">{{hideEmails($admin ->email)}}</span></p>
                    <p><span class="text-primary inline-key">Created Date :</span> <span class="text-danger">{{$admin ->created_at}}</span></p>
                    <div class="col-lg-6">
                        @include('include.captcha')
                        <input type="submit" value="提交" class="btn btn-success btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
