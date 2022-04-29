<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request){
        Gate::authorize('tasks_apply');

        // Get available tasks
        $tasks = [];
        foreach(Task::all() as $task){
            $studies = [];
            foreach($task->studies as $study){
                array_push($studies, $study->name);
            }

            $data = [
                'id' => $task->id,
                'teacher' => $task->teacher->name,
                'studies' => $studies,
                'name' => $task->name,
                'name_eng' => $task->name_eng,
                'description' => $task->description
            ];

            array_push($tasks, $data);
        }
        // Get tasks current student applied for
        $applied_tasks = [];
        foreach(Auth()->user()->applications as $application){
            array_push($applied_tasks, $application->id);
        }


        $accepted_task = Auth()->user()->task->id ?? null;

        return Inertia::render('Tasks',[
            'role' => Auth()->user()->role_id,
            'tasks' => $tasks,
            'applied_tasks' => $applied_tasks,
            'accepted_task' => $accepted_task,
        ]);
    }

    public function store(Request $request, $task_id){
        $user_id = Auth()->id();
        DB::insert('INSERT INTO task_user (user_id, task_id, created_at, updated_at) VALUES (?, ?, ?, ?)', [$user_id, $task_id, now(), now()]);

        return response('Success', 200)
            ->header('Content-Type', 'text/plain');
    }

    public function show(Request $request, $user_id){
        $user = User::find($user_id);
        return response()->json($user);
    }

    public function destroy(Request $request, $task_id){
        DB::delete('DELETE FROM task_user WHERE user_id = :user_id AND task_id = :task_id', ['user_id' => Auth()->id(), 'task_id' => $task_id]);
        return response('Success', 200)
            ->header('Content-Type', 'text/plain');
    }
}
