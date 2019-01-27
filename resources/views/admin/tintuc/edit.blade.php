@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>{{ $tintuc->TieuDe }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/edit/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
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
                        <label>Thể Loại</label>
                        <select class="form-control" name="theloai" id="TheLoai">
                            @foreach ($theloai as $tl)
                            <option 
                            @if ($tl->id == $tintuc->loaitin->idTheLoai)
                                selected
                            @endif
                            value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="loaitin" id="LoaiTin">
                            @foreach ($loaitin as $lt)
                            <option 
                            @if ($lt->id == $tintuc->idLoaiTin)
                                selected
                            @endif 
                            value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                    <input type="text" class="form-control" name="tieude" value="{{ $tintuc->TieuDe }}" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                            <label>Hình Ảnh</label>
                            <p><img width="200" src="upload/tintuc/{{ $tintuc->Hinh }}"></p>
                            <input type="file" name="hinh" placeholder="Please Enter Category Name" />
                        </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="form-control" name="tomtat" rows="3">{{ $tintuc->TomTat }}</textarea>
                    </div>
                    <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control" name="noidung" rows="3">{{ $tintuc->NoiDung }}</textarea>
                        </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="noibat" value="0" 
                            @if ($tintuc->NoiBat == 0) 
                                checked="checked" 
                            @endif 
                            type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="noibat" value="1"
                            @if ($tintuc->NoiBat == 1) 
                                checked="checked" 
                            @endif
                             type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($tintuc->comment as $cm)
                    <tr class="even gradeC" align="center">
                        <td>{{ $cm->id }}</td>
                        <td>{{ $cm->user->name }}</td>
                        <td>{{ $cm->NoiDung }}</td>
                        <td>{{ $cm->created_at }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/delete/{{ $cm->id }}/{{ $tintuc->id }}"> Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                var idTheLoai = $(this).val();
                $.get('admin/ajax/loaitin/'+idTheLoai, function(data){
                    $('#LoaiTin').html(data);
                });
            });
        });
    </script>
@endsection