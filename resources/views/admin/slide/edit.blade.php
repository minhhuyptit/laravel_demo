@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="" method="POST" enctype="multipart/form-data">
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
                        <label>Tên</label>
                        <input type="text" class="form-control" name="ten" value="{{ $slide->Ten }}" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea class="form-control" name="noidung"  rows="3">{{ $slide->NoiDung }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link" value="{{ $slide->link }}" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <p><img width="200" src="upload/slide/{{ $slide->Hinh }}"></p>
                        <input type="file" name="hinh" placeholder="Please Enter Category Name" />
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