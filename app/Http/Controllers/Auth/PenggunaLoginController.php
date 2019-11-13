<?php
namespace App\Http\Controllers\Auth;
use App\pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class PenggunaLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'pengguna';
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.penggunaLogin');
    }
    public function guard()
    {
        return auth()->guard('pengguna');
    }
    public function showRegisterPage()
    {
        return view('auth.penggunaregister');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('pengguna-login')->with('success','Registration Success');
    }
    public function login(Request $request)
    {
        if (auth()->guard('pengguna')->attempt(['username' => $request->username, 'password' => $request->password ])) {
            return redirect('/home');
        }
        return back()->withErrors(['username' => 'Username or password are wrong.']);
    }
}