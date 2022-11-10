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
}
