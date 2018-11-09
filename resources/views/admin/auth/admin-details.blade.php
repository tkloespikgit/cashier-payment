@extends('layout.admin')
@section('page-name','管理员详情')
@section('body')
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5>{{$admin ->name}}</h5>
            </div>
            <div class="panel-body">
                <p><span class="text-primary inline-key">Name :</span> <span class="text-danger">{{$admin ->name}}</span></p>
                <p><span class="text-primary inline-key">Account :</span> <span class="text-danger">{{hideString($admin ->account)}}</span></p>
                <p><span class="text-primary inline-key">Mobile Phone :</span> <span class="text-danger">{{hideString($admin ->phone)}}</span></p>
                <p><span class="text-primary inline-key">Emails :</span> <span class="text-danger">{{hideEmails($admin ->email)}}</span></p>
                <p><span class="text-primary inline-key">Created Date :</span> <span class="text-danger">{{$admin ->created_at}}</span></p>
                <p>
                    <span class="text-primary inline-key">Attached Roles :</span>
                    @foreach($roles as $role)
                        @if ($admin ->hasRole($role->name))
                            <input type="button" class="btn btn-default btn-xs" value="{{$role ->display_name}}">
                        @endif
                    @endforeach
                </p>
                <p>
                    @if($admin ->status == 1)
                        <a href="javascript:void(0)" title="Not allowed to log in" onclick="SystemFunc.ajaxGet('{{url('admins/modify/close',$admin ->id)}}')" class="btn btn-xs btn-danger" ><i class="fa fa-close"></i></a>
                    @else
                        <a href="javascript:void(0)" title="Allowed to log in" onclick="SystemFunc.ajaxGet('{{url('admins/modify/open',$admin ->id)}}')" class="btn btn-xs btn-success" ><i class="fa fa-check"></i></a>
                    @endif
                    <a href="javascript:void(0)" data-url="{{url('admins/modify/edit',$admin ->id)}}" class="btn btn-xs btn-primary open-frame" ><i class="fa fa-edit"></i></a>
                </p>
            </div>
        </div>
    </div>
@endsection
