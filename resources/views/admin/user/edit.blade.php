@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>{{ $user->name }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/edit/{{ $user->id }}" method="POST">
                    @csrf
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif  
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="name" value="{{ $user->name }}" placeholder="Nhập họ tên" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" readonly value="{{ $user->email }}" name="email" placeholder="Nhập Email" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Đổi mật khẩu</label><br>
                        <label>Password</label>
                        <input type="password" class="form-control password" disabled name="password" placeholder="Nhập vào password" />
                    </div>
                    <div class="form-group">
                        <label>Re-Password</label>
                        <input type="password" class="form-control password" disabled name="passwordAgain" placeholder="Nhập lại password" />
                    </div>
                    <div class="form-group">
                        <label>Quyền người dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" 
                            @if ($user->quyen == 1)
                                checked
                            @endif
                            type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                            @if ($user->quyen == 0)
                                checked
                            @endif
                            type="radio">Member
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#changePassword').change(function(){
            if($(this).is(':checked')){
                $('.password').removeAttr('disabled');
            }else{
                $('.password').prop('disabled', true);
            }
        });
    });
    </script>
@endsection