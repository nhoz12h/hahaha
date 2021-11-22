<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }
    public function show_dashboard(){
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $ten_dn = $request->ten_dn;
    	$mat_khau = $request->mat_khau;

    	$result = DB::table('adm')->where('ten_dn',$ten_dn)->where('mat_khau',$mat_khau)->first();
    	if($result){
            Session::put('ten_adm',$result->ten_adm);
            Session::put('ma_adm',$result->ma_adm);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Tài khoản hoặc mật khẩu sai');
            return Redirect::to('/admin');
        }
    }
    public function log_out(){
        Session::put('ten_adm',null);
        Session::put('ma_adm',null);
        return Redirect::to('/admin');
    }
}
