<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('user.all_user', compact('users'));
    }

    public function SetAdmin($id)
    {
        User::findOrFail($id)->update([
            'role' => 'admin'
        ]);
        $notification = [
            'message' => __('User role changed to admin'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function SetNormal($id)
    {
        User::findOrFail($id)->update([
            'role' => 'normal'
        ]);
        $notification = [
            'message' => __('User role changed to normal'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function SetViewer($id)
    {
        User::findOrFail($id)->update([
            'role' => 'viewer'
        ]);
        $notification = [
            'message' => __('User role changed to viewer'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function SetProduct($id)
    {
        User::findOrFail($id)->update([
            'role' => 'product'
        ]);
        $notification = [
            'message' => __('User role changed to product'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function DeleteUser($id)
    {
        // random password with letters and numbers
        $password = \Str::random(8) . rand(1, 100);
        User::findOrFail($id)->update([
            'role' => 'deleted',
            'password' => bcrypt($password)
        ]);
        $notification = [
            'message' => __('User deleted'),
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
