<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getList(){
        $user = User::all();
        return view('admin.user.list', compact('user'));
    }
    public function getAdd(){
        return view('admin.user.add');
    }
    public function postAdd(Request $request){
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
        $user->quyen        = $request->quyen;
        $user->password     = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->save();
        return redirect('admin/user/add')->with('thongbao', 'Bạn đã thêm user thành công');
    }

    public function getEdit($id){
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function postEdit(Request $request, $id){
        $user = User::find($id);
        $this->validate($request,
        [
            'name'          =>  'required'
        ],
        [
            'name.required'         => 'Bạn chưa nhập tên'
        ]);
        $user->name         = $request->name;
        $user->quyen        = $request->quyen;
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
        return redirect('admin/user/edit/'.$id)->with('thongbao', 'Bạn đã sửa user thành công');
    }

    public function getDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/list')->with('thongbao', 'Xóa thành công');
    }

    public function getLoginAdmin(){
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request){
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
            return redirect('admin/theloai/list');
        }else{
            return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
        }
    }

    public function getLogoutAdmin(){
        Auth::logout();
        return redirect('admin/login');
    }

}
