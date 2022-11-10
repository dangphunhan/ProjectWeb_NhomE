<?php

namespace App\Http\Controllers;

use App\Client;
use App\ActivityLog;
use App\ClientProject;
use App\Mail\SendWorkspaceInvication;
use App\Mail\ShareProjectToClient;
use App\Milestone;
use App\SubTask;
use App\UserWorkspace;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\ProjectFile;
use App\Task;
use App\Comment;
use App\TaskFile;
use App\Utility;
use App\User;
use App\UserProject;
use App\Mail\SendInvication;
use App\Mail\SendLoginDetail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $projects = Project::select('projects.*')->join('user_projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$objUser->id)->where('projects.workspace','=',$currantWorkspace->id)->get();
        return view('projects.index',compact('currantWorkspace','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $request->validate([
            'name' => 'required',
        ]);

        $objUser = Auth::user();

        $post = $request->all();

        $post['workspace'] = $currantWorkspace->id;
        $post['created_by'] = $objUser->id;
        $userList = [];
        if(isset($post['users_list'])) {
            $userList = $post['users_list'];
        }
        $userList[] = $objUser->email;
        $userList = array_filter($userList);
        $objProject = Project::create($post);

        foreach ($userList as $email){
            $permission = 'Member';
            $registerUsers =  User::where('email',$email)->first();
            if($registerUsers){
                if($registerUsers->id == $objUser->id){
                    $permission = 'Owner';
                }
                $this->inviteUser($registerUsers,$objProject,$permission);
            }
            else{
                $arrUser = [];
                $arrUser['name'] = 'No Name';
                $arrUser['email'] = $email;
                $password = Str::random(8);
                $arrUser['password'] = Hash::make($password);
                $arrUser['currant_workspace'] = $objProject->workspace;
                $registerUsers = User::create($arrUser);
                $registerUsers->password = $password;

                try {
                    Mail::to($email)->send(new SendLoginDetail($registerUsers));
                }catch (\Exception $e){
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                $this->inviteUser($registerUsers,$objProject,$permission);
            }
        }

        return redirect()->route('projects.index',$currantWorkspace->slug)
            ->with('success',__('Project Created Successfully!').((isset($smtp_error))?' <br> <span class="text-danger">'.$smtp_error.'</span>':''));
    }

    public function inviteUser(User $user,Project $project,$permission){

        // assign workspace first
        $is_assigned = false;
        foreach ($user->workspace as $workspace){
            if($workspace->id == $project->workspace){
                $is_assigned = true;
            }
        }

        if(!$is_assigned){
            UserWorkspace::create(['user_id'=>$user->id,'workspace_id'=>$project->workspace,'permission'=>$permission]);
            try {
                Mail::to($user->email)->send(new SendWorkspaceInvication($user, $project->workspaceData));
            }catch (\Exception $e){
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }
        }

        // assign project
        $arrData = [];
        $arrData['user_id'] = $user->id;
        $arrData['project_id'] = $project->id;
        $is_invited = UserProject::where($arrData)->first();
        if(!$is_invited) {
            UserProject::create($arrData);
            if ($permission != 'Owner'){
                try {
                    Mail::to($user->email)->send(new SendInvication($user, $project));
                }catch (\Exception $e){
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }
            }
        }
    }

    public function invite($slug,$projectID,Request $request){
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = $request->all();
        $userList = $post['users_list'];

        $objProject = Project::find($projectID);

        foreach ($userList as $email){
            $permission = 'Member';
            $registerUsers =  User::where('email',$email)->first();
            if($registerUsers){
                $this->inviteUser($registerUsers,$objProject,$permission);
            }
            else{
                $arrUser = [];
                $arrUser['name'] = 'No Name';
                $arrUser['email'] = $email;
                $password = Str::random(8);
                $arrUser['password'] = Hash::make($password);
                $arrUser['currant_workspace'] = $objProject->workspace;
                $registerUsers = User::create($arrUser);
                $registerUsers->password = $password;

                try {
                    Mail::to($email)->send(new SendLoginDetail($registerUsers));
                }catch (\Exception $e){
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                $this->inviteUser($registerUsers,$objProject,$permission);
            }
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'project_id' => $objProject->id,
                'log_type' => 'Invite User',
                'remark' => Auth::user()->name.__(' Invite new User ').'<b>'.$registerUsers->name.'</b>'
            ]);

        }

        return redirect()->route('projects.index',$currantWorkspace->slug)
            ->with('success',__('Users Invited Successfully!').((isset($smtp_error))?' <br> <span class="text-danger">'.$smtp_error.'</span>':''));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug,$projectID)
    {
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$objUser->id)->where('projects.workspace','=',$currantWorkspace->id)->where('projects.id','=',$projectID)->first();
        $chartData = $this->getProjectChart(['project_id'=>$projectID,'duration'=>'week']);
        return view('projects.show',compact('currantWorkspace','project','chartData'));
    }

    public function getProjectChart($arrParam){
        $arrDuration = [];
        if($arrParam['duration']){

            if($arrParam['duration'] == 'week'){
                $previous_week = strtotime("-1 week +1 day");


                for ($i=0;$i<7;$i++){
                    $arrDuration[date('Y-m-d',$previous_week)] = date('D',$previous_week);
                    $previous_week = strtotime(date('Y-m-d',$previous_week). " +1 day");
                }
            }
        }
//        dd($arrDuration);
        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['done'] = [];
        $arrTask['progress'] = [];
        $arrTask['review'] = [];
        $arrTask['todo'] = [];
        foreach ($arrDuration as $date => $label){


            $objProject = Task::select('status', DB::raw('count(*) as total'))
                ->whereDate('updated_at','=',$date)
                ->groupBy('status');

            if(isset($arrParam['project_id'])){
                $objProject->where('project_id','=',$arrParam['project_id']);
            }
            if(isset($arrParam['workspace_id'])){

                $objProject->whereIn('project_id',function($query) use ($arrParam){
                    $query->select('id')->from('projects')->where('workspace','=',$arrParam['workspace_id']);
                });
            }
            $data = $objProject->get();
            $done = 0;
            $progress = 0;
            $review = 0;
            $todo = 0;
            foreach ($data as $item){
                if($item->status == 'done')
                    $done = $item->total;
                elseif($item->status == 'in progress')
                    $progress = $item->total;
                elseif($item->status == 'review')
                    $review = $item->total;
                elseif($item->status == 'todo')
                    $todo = $item->total;
            }
            $arrTask['label'][]=__($label);
            $arrTask['done'][]=$done;
            $arrTask['progress'][]=$progress;
            $arrTask['review'][]=$review;
            $arrTask['todo'][]=$todo;
        }
        return $arrTask;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$projectID)
    {
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$objUser->id)->where('projects.workspace','=',$currantWorkspace->id)->where('projects.id','=',$projectID)->first();
        return view('projects.edit',compact('currantWorkspace','project'));
    }

    public function create($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('projects.create',compact('currantWorkspace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function popup($slug,$projectID)
    {
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$objUser->id)->where('projects.workspace','=',$currantWorkspace->id)->where('projects.id','=',$projectID)->first();
        return view('projects.invite',compact('currantWorkspace','project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,$projectID)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $project = Project::select('projects.*')->join('user_projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$objUser->id)->where('projects.workspace','=',$currantWorkspace->id)->where('projects.id','=',$projectID)->first();
        $project->update($request->all());

        return redirect()->back()
            ->with('success',__('Project Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $projectID
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$projectID)
    {
        $objUser = Auth::user();
        $project = Project::find($projectID);

        if($project->created_by == $objUser->id) {
            UserProject::where('project_id', '=', $projectID)->delete();
            $project->delete();
            return redirect()->route('projects.index',$slug)->with('success',__('Project Deleted Successfully!'));
        }
        else{
            return redirect()->route('projects.index',$slug)->with('error',__('You can\'t Delete Project!'));
        }
    }

    /**
     * Leave the specified resource from storage.
     *
     * @param  Int  $projectID
     * @return \Illuminate\Http\Response
     */
    public function leave($slug,$projectID)
    {
        $objUser = Auth::user();
        $userProject = Project::find($projectID);
        UserProject::where('project_id','=',$userProject->id)->where('user_id', '=', $objUser->id)->delete();
        return redirect()->route('projects.index',$slug)->with('success',__('Project Leave Successfully!'));
    }
}
