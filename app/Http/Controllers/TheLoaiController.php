<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getList(){
        $theloai = TheLoai::all();
        return view('admin.theloai.list', compact('theloai'));
    }
    public function getAdd(){
        $theloai = TheLoai::all();
        return view('admin.theloai.add', compact('theloai'));
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
        $theloai = new TheLoai();
        $theloai->Ten           = $request->Ten;
        $theloai->TenKhongDau   = str_slug($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/add')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.edit', compact('theloai'));
    }

    public function postEdit(Request $request, $id){
        $theloai = TheLoai::find($id);
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
        $theloai->Ten           = $request->Ten;
        $theloai->TenKhongDau   = str_slug($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/list')->with('thongbao', 'Xóa thành công');
    }
}
