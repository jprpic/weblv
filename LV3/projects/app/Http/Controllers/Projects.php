<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Projects extends Controller
{
    public function index(Request $request){

        return view('dashboard',['projects'=>Project::all()]);
    }

    public function create(Request $request){

        return view('create');
    }

    public function store(Request $request){
        $project = new Project;

        $project->name = $request->name;
        $project->price = $request->price;
        $project->description = $request->description;
        $project->team_lead_id = Auth::id();

        $project->save();
        return redirect('dashboard');
    }

    public function show(Request $request, $id){
        $project = Project::find($id);
        return view('project',[
            'project'=> $project,
            'team_lead_name' => User::find($project->team_lead_id)->name,
            ]);
    }
}
