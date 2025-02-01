<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login_page(){
        return view('auth.login');
    }

    public function login_post(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (!$user){
            return redirect('login')->with('php_errormsg', 'ایمیل وجود ندارد');
        }

        $password = $request->input('password');
        $password_configuration = DB::table('users')->select('password')->where('email', $email)->first();

        $pass_check = Hash::check($password, $password_configuration->password);

        $id = $user['id'];
        if(!$pass_check){
            return redirect('login')->with('php_error_pass', "پسورد شما اشتباه است.");
        }
        else{
            $request->session()->put('LoggedUser', $id );
            return redirect('dashboard');
        }

    }

    public function register_page(){
        return view('auth.register');
    }
    public function register_post(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        DB::table('users')->insert([
           'name' => $name,
           'email' => $email,
           'password' => Hash::make($password)
        ]);

        return redirect('/login')->with('create_account', "اکانت شما ساخته شد. برای استفاده از پنل کاربری ورود کنید.");
    }

    public function logout(){
        session()->forget('email');
        return redirect()->route('home');
    }
}
