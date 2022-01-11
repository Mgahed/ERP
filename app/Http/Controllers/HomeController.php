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
}
