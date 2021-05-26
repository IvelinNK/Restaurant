<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;
use App\Product;
use App\Payment;

class AdminController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')){
            if (Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password'), 'admin'=>'1'])){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error', 'Грешно Потребителско име или парола. Нямате необходимите права за това действие!');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function chkPassword(Request $request){
        if (Hash::check($request->input('current_pwd'), User::where(['admin'=>'1'])->first()->password)){
            return response()->json([
                'check' => true
            ]);
        }else{
            return response()->json([
                'check' => false
            ]);
        }
    }

    public function updatePassword(Request $request){
        if (Hash::check($request->input('current_pwd'), User::where(['email'=>Auth::user()->email])->first()->password)){
            $password = bcrypt($request->input('new_pwd'));
            User::where(['admin'=>'1'])->update(['password'=>$password]);
            return redirect('/admin/settings')->with('flash_message_success', 'Успешно променихте вашата парола!');
        }else{
            return redirect('/admin/settings')->with('flash_message_error', 'Текущата въведена парола не съответства на истинската!');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('/admin')->with('flash_message_logout', 'Благодарим Ви за използването на нашата програма. Заповядайте отново при нас!');
    }
}
