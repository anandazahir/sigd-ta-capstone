<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Get the authenticated user
            $roles = $user->getRoleNames(); // This returns a collection of role names


            // If user has roles, get the first one
            $roleString = $roles->isNotEmpty() ? $roles->first() : 'default';

            // Redirect to the appropriate dashboard
            return redirect('/' . $roleString . '/dashboard');
        }

        return view('pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();


        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Assuming you have a 'role' field in your users table
            $role = $user->getRoleNames();
            $rolecleaned =  str_replace(['[', ']', '"'], '', $role);
            return redirect(url('/' . $rolecleaned . '/dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
