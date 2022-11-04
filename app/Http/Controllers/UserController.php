<?php

namespace App\Http\Controllers;

use App\Mail\SendLoginDetail;
use App\User;
use App\UserProject;
use App\UserWorkspace;
use App\Utility;
use App\Mail\SendWorkspaceInvication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Config;

class UserController extends Controller
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
    public function index($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $users = User::select('users.*','user_workspaces.permission')->join('user_workspaces','user_workspaces.user_id','=','users.id')->where('user_workspaces.workspace_id','=',$currantWorkspace->id)->get();
        return view('users.index',compact('currantWorkspace','users'));
    }

    public function account()
    {
        $user = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug('');
        return view('users.account',compact('currantWorkspace','user'));
    }
}
