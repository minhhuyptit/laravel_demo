<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;

class TinTucController extends Controller
{
    public function getList(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.list', compact('tintuc'));
    }
    public function getAdd(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.add', compact('theloai','loaitin'));
    }
    public function postAdd(Request $request){
        $this->validate($request,
        [
            'loaitin'   =>  'required',
            'tieude'    =>  'required|min:3|unique:TinTuc,TieuDe',
            'tomtat'    =>  'required',
            'noidung'   =>  'required'
        ],
        [
            'loaitin.required'  => 'Bạn chưa nhập tên loại tin',
            'tieude.required'   => 'Bạn chưa nhập tiêu đề',
            'tieude.min'        => 'Tiêu đề phải có ít nhất 3 kí tự',
            'tieude.unique'     => 'Tiêu đề này đã tồn tại',
            'tomtat.required'   => 'Bạn chưa nhập tóm tắt',
            'noidung.required'  => 'Bạn chưa nhập nội dung'
        ]);
        $tintuc = new TinTuc();
        $tintuc->TieuDe           = $request->tieude;
        $tintuc->TieuDeKhongDau   = str_slug($request->tieude);
        $tintuc->TomTat           = $request->tomtat;
        $tintuc->NoiDung          = $request->noidung;
        $tintuc->idLoaiTin        = $request->loaitin;
        $tintuc->NoiBat           = $request->noibat;
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists('upload/tintuc/'.$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc', $hinh);
            $tintuc->Hinh = $hinh;
        }else{
            $tintuc->Hinh = '';
        }
        $tintuc->save();
        return redirect('admin/tintuc/add')->with('thongbao', 'Bạn đã thêm tin tức thành công');
    }

    public function getEdit($id){
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::where('idTheLoai',$tintuc->loaitin->idTheLoai)->get();
        return view('admin.tintuc.edit', compact('tintuc','theloai','loaitin'));
    }

    public function postEdit(Request $request, $id){
        $tintuc = TinTuc::find($id);
        $this->validate($request,
        [
            'loaitin'   =>  'required',
            'tieude'    =>  'required|min:3|unique:TinTuc,TieuDe,'.$id,
            'tomtat'    =>  'required',
            'noidung'   =>  'required'
        ],
        [
            'loaitin.required'  => 'Bạn chưa nhập tên loại tin',
            'tieude.required'   => 'Bạn chưa nhập tiêu đề',
            'tieude.min'        => 'Tiêu đề phải có ít nhất 3 kí tự',
            'tieude.unique'     => 'Tiêu đề này đã tồn tại',
            'tomtat.required'   => 'Bạn chưa nhập tóm tắt',
            'noidung.required'  => 'Bạn chưa nhập nội dung'
        ]);
        $tintuc->TieuDe           = $request->tieude;
        $tintuc->TieuDeKhongDau   = str_slug($request->tieude);
        $tintuc->TomTat           = $request->tomtat;
        $tintuc->NoiDung          = $request->noidung;
        $tintuc->idLoaiTin        = $request->loaitin;
        $tintuc->NoiBat           = $request->noibat;
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(\file_exists('upload/tintuc/'.$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc', $hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $hinh;
        }
        $tintuc->save();
        return redirect('admin/tintuc/edit/'.$id)->with('thongbao', 'Bạn đã sửa tin tức thành công');
    }

    public function getDelete($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/list')->with('thongbao', 'Xóa thành công');
    }
}
