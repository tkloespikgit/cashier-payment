@extends('layout.admin-without-nav')
@section('title','编辑管理员')
@section('content')
    <form method="post" action="{{url('admins/modify/edit',[$admin ->id])}}" id="frameForm">
        {{csrf_field()}}
        <input type="hidden" name="phone_country" value="CN">
        <div class="form-group">
            <label for="name">名　字：</label>
            <input type="text" value="{{old('name',$admin ->name)}}" name="name" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="account">账　号：</label>
            <input type="text" value="{{old('account',$admin ->account)}}" name="account" class="form-control" id="account">
        </div>
        <div class="form-group">
            <label for="phone">手机号：</label>
            <input type="text" value="{{old('phone',$admin ->phone)}}" name="phone" id="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">邮　箱：</label>
            <input type="email" value="{{old('email',$admin ->email)}}" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">密　码：</label>
            <input type="password" value="" name="password" class="form-control" id="password" placeholder="如果不需要更换密码请留空">
        </div>
        <div class="form-group">
            <label>Attach roles</label>
            <table class="table">
                <tr>
                    <th>Check</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                @foreach($roles as $role)
                    <tr>
                        <td><label><input type="checkbox" name="roles[]" {{$admin ->hasRole($role ->name) ? 'checked':''}} value="{{$role->id}}"></label></td>
                        <td>{{$role ->name}}</td>
                        <td>{{$role ->description}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @include('include.captcha')
        <input type="button" value="确认提交" name="doSubmit" class="btn btn-info btn-block" id="frameSubmit">
    </form>
@endsection