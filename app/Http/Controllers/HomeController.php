<?php

namespace App\Http\Controllers;

use App\ClientWorkspace;
use App\User;
use App\Utility;
use App\UserProject;
use App\Task;
use App\Todo;
use App\UserWorkspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
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
    public function index($slug = '')
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        if($currantWorkspace) {
            $userObj = Auth::user();
            $totalProject = UserProject::join("projects","projects.id","=","user_projects.project_id")->where("user_id","=",$userObj->id)->where('projects.workspace','=',$currantWorkspace->id)->count();
            if($currantWorkspace->permission == 'Owner') {
                $totalTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->count();
                $completeTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.status', '=', 'done')->count();
                $tasks = Task::select('tasks.*')->join("user_projects", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->orderBy('tasks.id','desc')->limit(4)->get();
            }
            else{
                $totalTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->count();
                $completeTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->where('tasks.status', '=', 'done')->count();
                $tasks = Task::select('tasks.*')->join("user_projects", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->orderBy('tasks.id','desc')->limit(4)->get();
            }


            $totalMembers = UserWorkspace::where('workspace_id','=',$currantWorkspace->id)->count();

           

           

            $startDate = date('Y-m-d 00:00:00');
            $endDate = date('Y-m-d H:i:s',strtotime($startDate."+1 day"));
            
            return view('home', compact('currantWorkspace','totalProject','totalTask','totalMembers','completeTask','tasks'));
        }
        else{
            return view('home', compact('currantWorkspace'));
        }
    }
}
