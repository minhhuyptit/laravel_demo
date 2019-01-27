<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getList(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list', compact('loaitin'));
    }
    public function getAdd(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.add', compact('theloai'));
    }
    public function postAdd(Request $request){
        $this->validate($request,
        [
            'Ten'   => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required'  => 'Bạn chưa nhập tên thể loại',
            'Ten.unique'    => 'Tên thể loại đã tồn tại',
            'Ten.min'       => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            'Ten.max'       => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
        ]);
        $loaitin = new LoaiTin();
        $loaitin->Ten           = $request->Ten;
        $loaitin->TenKhongDau   = str_slug($request->Ten);
        $loaitin->idTheLoai     = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/add')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.edit', compact('loaitin', 'theloai'));
    }

    public function postEdit(Request $request, $id){
        $this->validate($request,
        [
            'Ten'   => 'required|unique:LoaiTin,Ten|min:3|max:100'
        ],
        [
            'Ten.required'  => 'Bạn chưa nhập tên thể loại',
            'Ten.unique'    => 'Tên thể loại đã tồn tại',
            'Ten.min'       => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
            'Ten.max'       => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
        ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten           = $request->Ten;
        $loaitin->TenKhongDau   = str_slug($request->Ten);
        $loaitin->idTheLoai     = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/list')->with('thongbao', 'Xóa thành công');
    }
}
