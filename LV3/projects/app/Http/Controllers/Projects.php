<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Projects extends Controller
{
    public function index(Request $request){

        return view('dashboard',['projects'=>Project::all()]);
    }

    public function create(Request $request){

        return view('create');
    }

    public function finish(Request $request, $id){
        $project = Project::find($id);

        if($project->team_lead_id == Auth()->id()){
            $project->delete();
        }

        return redirect('dashboard');

    }
    public function edit(Request $request, $id){
        $project = Project::find($id);

        $isLeader = $project->team_lead_id == Auth()->id();
        // Check if user is project member
        $projectMembers = DB::table('project_user')
            ->select('user_id')
            ->where('project_id','=',$id)
            ->get();
        $isMember = false;
        foreach($projectMembers as $member){
            if($member->user_id == Auth()->id())
                $isMember = true;
        }

        // In case someone is trying to access the route
        // without being a member or a leader, send them to dashboard
        if(!($isMember || $isLeader)){
            return redirect('dashboard');
        }


        return view('create', ['project' => $project, 'isLeader' => $isLeader]);
    }

    public function store(Request $request){
        // Store new project with logged user's id as team_lead_id
        $project = new Project;

        $project->name = $request->name;
        $project->price = $request->price;
        $project->description = $request->description;
        $project->tasks_done = $request->tasks_done;
        $project->team_lead_id = Auth::id();

        $project->save();

        // Redirect user to dashboard with newly added project
        return redirect('dashboard');
    }

    public function update(Request $request, $id){

        $project = Project::find($id);
        $isLeader = Auth()->id() == $project->team_lead_id;

        // Only project leader can change everything
        if($isLeader){
            $project->name = $request->name;
            $project->price = $request->price;
            $project->description = $request->description;
        }
        // Projects members can only change tasks done
        $project->tasks_done = $request->tasks_done ?? '';

        $project->save();

        return redirect(route('project',['id' => $id]));
    }

    public function show(Request $request, $id){
        // Get info about project
        $project = Project::find($id);


        if(is_null($project)){
            return redirect('dashboard');
        }

        // Check if user is project leader
        $isLeader = $project->team_lead_id == Auth()->id();

        // Check if user is project member
        $projectMembers = DB::table('project_user')
            ->select('user_id')
            ->where('project_id','=',$id)
            ->get();
        $isMember = false;
        foreach($projectMembers as $member){
            if($member->user_id == Auth()->id())
                $isMember = true;
        }

        return view('project',[
            'project'=> $project,
            'team_lead_name' => User::find($project->team_lead_id)->name,
            'isMember' => $isMember,
            'isLeader' => $isLeader
            ]);
    }

    public function getProjects(Request $request){
        $data = Project::select('id', 'name', 'description')->get();
        return response()->json($data);
    }

}
