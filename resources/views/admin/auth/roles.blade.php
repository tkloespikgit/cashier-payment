@extends('layout.admin')
@section('page-name','管理组')
@section('body')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>管理组列表</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>key</th>
                            <th>display name</th>
                            <th>description</th>
                            <th>action</th>
                            <th>permission</th>
                        </tr>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role ->name}}</td>
                                <td>{{$role ->display_name}}</td>
                                <td>{{$role ->description}}</td>
                                <td>
                                    <a data-url="{{url('roles/edit',[$role->id])}}" class="open-frame">
                                        <i class="fa fa-edit">编辑</i>
                                    </a>
                                </td>
                                <td>
                                    @foreach($permissions as $perms)
                                        @if($role ->hasPermission($perms ->name))
                                            <input type="button" class="btn btn-block btn-xs" value="{{$perms ->display_name}}">
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">
                                {{$roles ->render()}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5>添加管理组</h5>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('roles/list')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">KEY</label>
                            <input id="name" value="{{old('key')}}" name="key" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="display_name">Display name</label>
                            <input id="display_name" value="{{old('display_name')}}" name="display_name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" style="resize: none">{{old('description')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Attach permissions :</label>
                            <br>
                            <table class="table">
                                <tr>
                                    <th>Check</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" value="{{$permission ->id}}" name="permissions[]">
                                            </label>
                                        </td>
                                        <td>{{$permission ->display_name}}</td>
                                        <td>{{$permission ->description}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        @include('include.captcha')
                        <input type="submit" value="确认提交" name="doSubmit" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection