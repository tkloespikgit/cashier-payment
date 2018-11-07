@extends('layout.admin')
@section('page-name','权限管理')
@section('body')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                     <h5>权限列表</h5>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>key</th>
                            <th>display name</th>
                            <th>description</th>
                            <th>action</th>
                        </tr>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission ->name}}</td>
                                <td>{{$permission ->display_name}}</td>
                                <td>{{$permission ->description}}</td>
                                <td>
                                    <a href="{{url('$permissions/edit',[$permission->id])}}">
                                        <i class="fa fa-edit">编辑</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">
                                {{$permissions ->render()}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h5>添加权限</h5>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{url('permissions/list')}}">
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
                        @include('include.captcha')
                        <input type="submit" value="确认提交" name="doSubmit" class="btn btn-info btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection