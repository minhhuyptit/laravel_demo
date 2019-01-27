<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function __construct(){
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);
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

    function getAccount(){
        $user = Auth::user();
        return view('pages.account', compact('user'));
    }

    function postAccount(Request $request){
        $user = Auth::user();
        $this->validate($request,
        [
            'name'          =>  'required'
        ],
        [
            'name.required'         => 'Bạn chưa nhập tên'
        ]);
        $user->name         = $request->name;
        if(!empty($request->changePassword)){
            $this->validate($request,
            [
                'password'      =>  'required|min:3|max:32',
                'passwordAgain' =>  'required|same:password'
            ],
            [
                'password.required'     => 'Bạn chưa nhập password',
                'password.min'          => 'Mật khẩu phải có độ dài từ 3 - 32',
                'password.max'          => 'Mật khẩu phải có độ dài từ 3 - 32',
                'passwordAgain.required'=> 'Bạn chưa nhập re-password',
                'passwordAgain.same'    => 'Password không phù hợp. Kiểm tra lại',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('account')->with('thongbao', 'Bạn đã sửa thành công');
    }

    function getRegister(){
        return view('pages.register');
    }

    function postRegister(Request $request){
        $this->validate($request,
        [
            'name'          =>  'required',
            'email'         =>  'required|unique:users,email',
            'password'      =>  'required|min:3|max:32',
            'passwordAgain' =>  'required|same:password'
        ],
        [
            'name.required'         => 'Bạn chưa nhập tên',
            'email.required'        => 'Bạn chưa nhập email',
            'email.unique'          => 'Email này đã tồn tại',
            'password.required'     => 'Bạn chưa nhập password',
            'password.min'          => 'Mật khẩu phải có độ dài từ 3 - 32',
            'password.max'          => 'Mật khẩu phải có độ dài từ 3 - 32',
            'passwordAgain.required'=> 'Bạn chưa nhập re-password',
            'passwordAgain.same'    => 'Password không phù hợp. Kiểm tra lại',
        ]);
        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->quyen        = 0;
        $user->password     = bcrypt($request->password);
        $user->remember_token = $request->_token;
        $user->save();
        return redirect('register')->with('thongbao', 'Đăng ký thành công');
    }

    function getSearch(Request $request){
        $keyword = $request->keyword;
        $tintuc = TinTuc::where('TieuDe','like',"$keyword")->orWhere('TomTat','like',"%$keyword%")
                                                           ->orWhere('NoiDung','like',"%$keyword%")
                                                           ->take(30)->paginate(5);
        return view('pages.search', compact('tintuc','keyword'));
    }

    function postSearch(Request $request){
        $keyword = $request->keyword;
        $tintuc = TinTuc::where('TieuDe','like',"$keyword")->orWhere('TomTat','like',"%$keyword%")
                                                           ->orWhere('NoiDung','like',"%$keyword%")
                                                           ->take(30)->paginate(5);
        return view('pages.search', compact('tintuc','keyword'));
    }


}
