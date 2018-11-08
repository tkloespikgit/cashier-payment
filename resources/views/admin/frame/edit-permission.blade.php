@extends('layout.admin-without-nav')
@section('title','编辑权限')
@section('content')
    <form method="post" action="{{url('permissions/edit',[$permission ->id])}}" id="frameForm">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">KEY</label>
            <input id="name" value="{{old('key',$permission->name)}}" name="key" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="display_name">Display name</label>
            <input id="display_name" value="{{old('display_name',$permission ->display_name)}}" name="display_name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" style="resize: none">{{old('description',$permission ->description)}}</textarea>
        </div>
        @include('include.captcha')
        <input type="button" value="确认提交" name="doSubmit" class="btn btn-info btn-block" id="frameSubmit">
    </form>
@endsection