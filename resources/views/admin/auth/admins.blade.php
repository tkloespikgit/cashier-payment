@extends('layout.admin')
@section('page-name','管理员')
@section('body')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>管理员列表</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>name</th>
                            <th>account</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>action</th>
                        </tr>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{$admin ->name}}</td>
                                <td>{{$admin ->account}}</td>
                                <td><font color="{{$admin ->email_status == 0 ? 'red':'green'}}">{{$admin ->email}}</font> </td>
                                <td><font color="{{$admin ->phone_status == 0 ? 'red':'green'}}">{{$admin ->phone}}</font> </td>
                                <td>
                                    @if($admin ->status == 1)
                                        <a href="javascript:void(0)" title="Not allowed to log in" onclick="SystemFunc.ajaxGet('{{url('admins/modify/close',$admin ->id)}}')" class="btn btn-xs btn-danger" ><i class="fa fa-close"></i></a>
                                    @else
                                        <a href="javascript:void(0)" title="Allowed to log in" onclick="SystemFunc.ajaxGet('{{url('admins/modify/open',$admin ->id)}}')" class="btn btn-xs btn-success" ><i class="fa fa-check"></i></a>
                                    @endif
                                        <a href="javascript:void(0)" data-url="{{url('admins/modify/edit',$admin ->id)}}" class="btn btn-xs btn-primary open-frame" ><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5>添加管理员</h5>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('admins/list')}}">
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
                                        <td><label><input type="checkbox" name="roles[]" value="{{$role->id}}"></label></td>
                                        <td>{{$role ->name}}</td>
                                        <td>{{$role ->description}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @include('include.captcha')
                        <input type="submit" value="确认添加" class="btn btn-block btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection