<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function __construct(){
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);
    //     if(Auth::check()){
    //         view()->share('user', Auth::user());
    //     }
    }

    function home(){     
        return view('pages.home');
    }

    function contact(){
        return view('pages.contact');
    }

    function category($id){
        $category = LoaiTin::find($id);
        $tintuc = $category->tintuc()->paginate(5);
        return view('pages.category', compact('category','tintuc'));
    }

    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinNoiBat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinLienQuan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.detail', compact('tintuc','tinNoiBat','tinLienQuan'));
    }

    function getLogin(){
        return view('pages.login');
    }

    function postLogin(Request $request){
        $this->validate($request,
        [
            'email'     =>  'required',
            'password'  =>  'required|min:3|max:32'
        ],
        [
            'email.required'    =>  'Bạn chưa nhập email',
            'password.required' =>  'Bạn chưa nhập password',
            'password.min'      =>  'Mật khẩu phải có độ dài từ 3 - 32',
            'password.max'      =>  'Mật khẩu phải có độ dài từ 3 - 32'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('home');
        }else{
            return redirect('login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    function getLogout(){
        Auth::logout();
        return redirect('login');
    }


}
