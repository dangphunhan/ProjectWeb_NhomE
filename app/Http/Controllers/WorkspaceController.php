<?php

namespace App\Http\Controllers;


use App\Utility;
use Illuminate\Support\Facades\Auth;
use App\UserProject;
use App\Project;
use App\UserWorkspace;
use App\Workspace;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class WorkspaceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $objUser = Auth::user();
        $objWorkspace = Workspace::create(['created_by'=>$objUser->id,'name'=>$request->name]);

        UserWorkspace::create(['user_id'=>$objUser->id,'workspace_id'=>$objWorkspace->id,'permission'=>'Owner']);

        $objUser->currant_workspace = $objWorkspace->id;

        return redirect()->route('home',$objWorkspace->slug)->with('success',__('Workspace Created Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function destroy($workspaceID)
    {
        $objUser = Auth::user();
        $workspace = Workspace::find($workspaceID);
        if($workspace->created_by == $objUser->id) {
            UserWorkspace::where('workspace_id', '=', $workspaceID)->delete();
            $workspace->delete();
            return redirect()->route('home')->with('success',__('Workspace Deleted Successfully!'));
        }
        else{
            return redirect()->route('home')->with('error',__('You can\'t delete Workspace!'));
        }
    }

    /**
     * Leave the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function leave($workspaceID)
    {
        $objUser = Auth::user();

        $userProjects = Project::where('workspace', '=', $workspaceID)->get();
        foreach ($userProjects as $userProject){
            UserProject::where('project_id','=',$userProject->id)->where('user_id', '=', $objUser->id)->delete();
        }
        UserWorkspace::where('workspace_id', '=', $workspaceID)->where('user_id', '=', $objUser->id)->delete();
        return redirect()->route('home')->with('success',__('Workspace Leave Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function changeCurrantWorkspace($workspaceID)
    {
        $objUser = Auth::user();
        $objUser->currant_workspace = $workspaceID;
        $objWorkspace = Workspace::find($workspaceID);
        return redirect()->route('home',$objWorkspace->slug)->with('success',__('Workspace Change Successfully!'));
    }

}
