@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nội Dung</th>
                        <th>Hình</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slide as $sl)
                    <tr class="even gradeC" align="center">
                        <td>{{ $sl->id }}</td>
                        <td>{{ $sl->Ten }}</td>
                        <td>{{ $sl->NoiDung }}</td>
                        <td>
                            <img width="200" src="upload/slide/{{ $sl->Hinh }}" alt="">
                        </td>
                        <td>{{ $sl->link }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/delete/{{ $sl->id }}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/edit/{{ $sl->id }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection