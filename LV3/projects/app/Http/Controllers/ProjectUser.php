<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectUser extends Controller
{
    public function showProfile(Request $request, $id){
        // Get projects in which the user is a project leader via foreign key relationship
        $lead_projects = User::find($id)->leadProjects()->get();

        // Get projects in which the user is a member
        $member_projects_ids_array = DB::select('SELECT project_id FROM project_user WHERE user_id = :user_id',['user_id'=>$id]);
        $member_projects_ids = [];
        for($i = 0; $i < count($member_projects_ids_array); $i++){
            array_push($member_projects_ids, $member_projects_ids_array[$i]->project_id);
        }
        $member_projects = Project::whereIn('id',$member_projects_ids)->get(['id','name']);

        return view('profile', ['lead_projects'=>$lead_projects, 'member_projects'=>$member_projects]);
    }

    public function store(Request $request){
        // Match a member user with a project
        if($request->has('project_id') && $request->has('user_id')){
            DB::insert('insert into project_user (project_id, user_id) value (?, ?)', [$request->get('project_id'), $request->get('user_id')]);
        }
    }

    public function destroy(Request $request){
        // Destroy a record matching member user to the project
        if($request->has('project_id') && $request->has('user_id')){
            DB::table('project_user')
                ->where('project_id', '=', $request->project_id)
                ->where('user_id', '=', $request->user_id)
                ->delete();
        }
    }

    public function getMembers(Request $request, $id){
        // Get already joined members
        $user_ids_array = DB::select('SELECT user_id FROM project_user WHERE project_id = :project_id', ['project_id' => $id]);
        $user_ids = [];
        for($i = 0; $i < count($user_ids_array); $i++){
            array_push($user_ids, $user_ids_array[$i]->user_id);
        }
        $team_members = User::whereIn('id', $user_ids)->get(['id', 'name']);

        return response()->json($team_members);
    }

    public function getAvailableUsers(Request $request, $id){
        // Get already joined members
        $user_ids_array = DB::select('SELECT user_id FROM project_user WHERE project_id = :project_id', ['project_id' => $id]);
        $user_ids = [];
        for($i = 0; $i < count($user_ids_array); $i++){
            array_push($user_ids, $user_ids_array[$i]->user_id);
        }
        // Get project leader
        $team_lead_id = Project::where('id','=',$id)->get('team_lead_id')[0]->team_lead_id;
        array_push($user_ids, $team_lead_id);

        // Exclude already joined members and project leader
        $team_members = User::whereNotIn('id', $user_ids)->get(['id', 'name']);

        return response()->json($team_members);
    }


}
