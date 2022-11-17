<?php
namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Utility
{
    public function createSlug($table,$title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title,'-');
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($table,$slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
    protected function getRelatedSlugs($table,$slug, $id = 0)
    {
        return DB::table($table)->select()->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public static function getWorkspaceBySlug($slug){

        $objUser = Auth::user();
        if($objUser && $objUser->currant_workspace){
            $rs  = Workspace::select(['workspaces.id','workspaces.lang','workspaces.name','workspaces.slug','user_workspaces.permission','workspaces.created_by'])->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')->where('workspaces.id', '=', $objUser->currant_workspace)->where('user_id','=',$objUser->id)->first();
            if($rs){
                Utility::setLang($rs);
                return $rs;
            }
        }
        if($objUser) {
            $rs = Workspace::select(['workspaces.id', 'workspaces.lang', 'workspaces.name', 'workspaces.slug', 'user_workspaces.permission', 'workspaces.created_by'])->join('user_workspaces', 'workspaces.id', '=', 'user_workspaces.workspace_id')->where('user_id', '=', $objUser->id)->orderBy('workspaces.id', 'desc')->limit(1)->first();
            if ($rs) {
                Utility::setLang($rs);
                return $rs;
            }
        }
        else{
            $rs = Workspace::select(['workspaces.id', 'workspaces.lang', 'workspaces.name', 'workspaces.slug', 'workspaces.created_by'])->where('slug','=',$slug)->limit(1)->first();
            if ($rs) {
                Utility::setLang($rs);
                return $rs;
            }
        }
    }
}