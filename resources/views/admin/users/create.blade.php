@extends('layout.admin')
@section('page-name','添加用户')
@section('body')
    <div class="row">
        <div class="col-lg-4">
            <form method="post" action="{{url('user/create')}}">
                {{csrf_field()}}
                <input type="hidden" name="phone_country" value="CN">
                <div class="form-group">
                    <label for="account">账　号：</label>
                    <input type="text" value="{{old('account')}}" name="account" class="form-control" id="account">
                </div>
                <div class="form-group">
                    <label for="phone">手机号：</label>
                    <input type="text" value="{{old('phone')}}" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">邮　箱：</label>
                    <input type="email" value="{{old('email')}}" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">密　码：</label>
                    <input type="password" value="" name="password" class="form-control" id="password">
                </div>
                @include('include.captcha')
                <input type="submit" value="确认添加" class="btn btn-block btn-success">
            </form>
        </div>
    </div>
@endsection