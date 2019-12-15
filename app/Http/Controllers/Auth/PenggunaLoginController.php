<?php
namespace App\Http\Controllers\Auth;
use App\models\pengguna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class PenggunaLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard = 'pengguna';
    protected $redirectTo = '/home';

    //===============================================================
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //===============================================================
    public function showLoginForm()
    {
        $websetting = DB::table('setting')->limit(1)->get();
        return view('auth.penggunaLogin',['websetting'=>$websetting]);
    }

    //===============================================================
    public function guard()
    {
        return auth()->guard('pengguna');
    }

    //===============================================================
    public function showRegisterPage()
    {
        return view('auth.penggunaregister');
    }

    //===============================================================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username'=>'required'
        ]);
        pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('pengguna-login')->with('successmsg','Registrasi sukses silahkan login menggunakan akun baru anda');
    }

    //===============================================================
    public function login(Request $request)
    {
        if (auth()->guard('pengguna')->attempt(['username' => $request->username, 'password' => $request->password ])) {
            return redirect('/home');
        }
        return back()->withErrors(['username' => 'Username or password are wrong.']);
    }
}