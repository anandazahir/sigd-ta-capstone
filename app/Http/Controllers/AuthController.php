<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('pages.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Assuming you have a 'role' field in your users table
            $role = $user->getRoleNames();
            $rolecleaned =  str_replace(['[', ']', '"'], '', $role);
            // Redirect dengan pesan sukses
            return redirect(url('/' . $rolecleaned . '/dashboard'))->with('success', 'Selamat Datang, '.ucwords(auth()->user()->nama));
        }

        return back()->withErrors([
            'error' => 'Username atau password salah.',
        ])
        ->withInput();
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function updatePassword(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the user's password
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        $user->password = Hash::make($request->password);
        $user->save();

        // Log out the user and invalidate the session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('status', 'Password berhasil diganti! Silakan login dengan password yang baru.');
    }
}
