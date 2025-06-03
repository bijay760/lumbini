<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        // Uncomment this only for initial admin user creation
        // DB::table('admin_users')->insert([
        //     'email' => 'vijaybadhur760@gmail.com',
        //     'password' => Hash::make('Bijay760'),
        // ]);

        return view('admin.login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // can be email or username
            'password' => 'required',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['login' => 'Invalid credentials'])
            ->withInput($request->only('login', 'remember'));
    }

    /**
     * Logout the admin user
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login_form');
    }
}
