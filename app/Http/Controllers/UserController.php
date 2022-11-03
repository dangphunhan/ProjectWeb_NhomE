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

    public function update($slug = null,$id = null,Request $request)
    {
        if($id){
            $objUser = User::find($id);
        }else{
            $objUser = Auth::user();
        }

        $validation = [];
        $validation['name']='required';
        $request->validate($validation);

        $post = $request->all();

        $objUser->update($post);

        return redirect()->back()
            ->with('success',__('User Updated Successfully!'));
    }

    public function updatePassword(Request $request)
    {
        if(Auth::Check()) {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|same:password',
                'password_confirmation' => 'required|same:password',
            ]);
            $objUser = Auth::user();
            $request_data = $request->All();
            $current_password = $objUser->password;

            if(Hash::check($request_data['old_password'], $current_password))
            {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();
                return redirect()->route('users.my.account')
                    ->with('success', __('Password Updated Successfully!'));
            }else{
                return redirect()->route('users.my.account')
                    ->with('error', __('Please Enter Correct Current Password!'));
            }
        }
        else{
            return redirect()->route('users.my.account')
                ->with('error', __('Some Thing Is Wrong!'));
        }
    }


}
