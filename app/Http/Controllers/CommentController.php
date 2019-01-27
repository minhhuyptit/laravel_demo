<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;    
use App\TinTuc;

class CommentController extends Controller
{
    public function getDelete($idComment, $idTinTuc){
        $comment = Comment::find($idComment);
        $comment->delete();
        return redirect('admin/tintuc/edit/'.$idTinTuc)->with('thongbao', 'Xóa thành công');
    }

    public function postComment(Request $request, $id){
        $comment = new Comment();
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();
        $tintuc = TinTuc::find($id);
        return redirect("tintuc/$id/$tintuc->TieuDeKhongDau.html")->with('thongbao','Viết bình luận thành công');
    }
}
