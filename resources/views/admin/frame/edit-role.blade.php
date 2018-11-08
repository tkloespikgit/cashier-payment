@extends('layout.admin-without-nav')
@section('title','编辑权限')
@section('content')
    <form method="post" action="{{url('roles/edit',[$role ->id])}}" id="frameForm">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">KEY</label>
            <input id="name" value="{{old('key',$role ->name)}}" name="key" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="display_name">Display name</label>
            <input id="display_name" value="{{old('display_name',$role ->display_name)}}" name="display_name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" style="resize: none">{{old('description',$role->description)}}</textarea>
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
                                <input type="checkbox" {{$role ->hasPermission($permission->name)? 'checked' : ''}} value="{{$permission ->id}}" name="permissions[]">
                            </label>
                        </td>
                        <td>{{$permission ->display_name}}</td>
                        <td>{{$permission ->description}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @include('include.captcha')
        <input type="button" value="确认提交" name="doSubmit" class="btn btn-info btn-block" id="frameSubmit">
    </form>
@endsection