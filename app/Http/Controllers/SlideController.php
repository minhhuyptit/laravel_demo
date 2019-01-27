<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getList(){
        $slide = Slide::all();
        return view('admin.slide.list', compact('slide'));
    }
    public function getAdd(){
        return view('admin.slide.add');
    }
    public function postAdd(Request $request){
        $this->validate($request,
        [
            'ten'       =>  'required',
            'noidung'   =>  'required'
        ],
        [
            'ten.required'      => 'Bạn chưa nhập tên',
            'noidung.required'  => 'Bạn chưa nhập nội dung'
        ]);
        $slide = new Slide();
        $slide->Ten        = $request->ten;
        $slide->NoiDung    = $request->noidung;
        $slide->link       = $request->link;
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists('upload/slide/'.$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/slide', $hinh);
            $slide->Hinh = $hinh;
        }else{
            $slide->Hinh = '';
        }
        $slide->save();
        return redirect('admin/slide/add')->with('thongbao', 'Bạn đã thêm slide thành công');
    }

    public function getEdit($id){
        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
    }

    public function postEdit(Request $request, $id){
        $slide = Slide::find($id);
        $this->validate($request,
        [
            'ten'       =>  'required',
            'noidung'   =>  'required'
        ],
        [
            'ten.required'      => 'Bạn chưa nhập tên',
            'noidung.required'  => 'Bạn chưa nhập nội dung'
        ]);
        $slide->Ten        = $request->ten;
        $slide->NoiDung    = $request->noidung;
        $slide->link       = $request->link;
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(\file_exists('upload/slide/'.$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move('upload/slide', $hinh);
            unlink('upload/slide/'.$slide->Hinh);
            $slide->Hinh = $hinh;
        }
        $slide->save();
        return redirect('admin/slide/edit/'.$id)->with('thongbao', 'Bạn đã sửa slide thành công');
    }

    public function getDelete($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/list')->with('thongbao', 'Xóa thành công');
    }
}
