<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai){
        $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        $xhtml = '';
        foreach($loaitin as $val){
            $xhtml .= '<option value="'.$val->id.'">'.$val->Ten.'</option>';
        }
        return $xhtml;
    }
}
