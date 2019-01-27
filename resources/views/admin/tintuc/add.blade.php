@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/add" method="POST" enctype="multipart/form-data">
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
                            <option value="{{ $tl->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="loaitin" id="LoaiTin">
                            @foreach (App\LoaiTin::where('idTheLoai',1)->get() as $lt)
                            <option value="{{ $lt->id }}">{{ $lt->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input type="text" class="form-control" name="tieude" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <input type="file" name="hinh" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea class="form-control" name="tomtat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea class="form-control" name="noidung" rows="3"></textarea>
                        </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="noibat" value="0" checked="checked" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="noibat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
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