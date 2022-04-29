<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TeacherController extends Controller
{
    public function index(Request $request){
        Gate::authorize('tasks_applications');

        $tasks = [];

        // Get current teacher's made tasks
        foreach(Task::where('created_by', Auth()->id())->get() as $task){

            $applicants = [];
            if(isset($task->applicants[0])){
                // Applicants students can't have already assigned task
                foreach($task->applicants as $applicant){
                    if(is_null($applicant->task_id)){
                        $applicant_data = [
                            'id' => $applicant->id,
                            'name' => $applicant->name,
                        ];
                        array_push($applicants, $applicant_data);
                    }

                }
            }

            $data = [
                'id' => $task->id,
                'name' => $task->name,
                'applicants' => $applicants,
                'user' => $task->student ? ['id' => $task->student->id, 'name' => $task->student->name] : null
            ];

            array_push($tasks, $data);

        }

        return Inertia::render('Applications',[
            'role' => Auth()->user()->role_id,
            'tasks' => $tasks,
        ]);
    }

    public function create(Request $request){
        Gate::authorize('tasks_create');
    }

    public function studentStore(Request $request, $task_id){
        if($request->has('user_id')){
            $user_id = $request->get('user_id');

            $user = User::find($user_id);
            $user->task_id = $task_id;
            $user->save();

            $task = Task::find($task_id);
            $task->user_id = $user_id;
            $task->save();

            return response('Success', 200)
                ->header('Content-Type', 'text/plain');
        }
        return response('Invalid request', 400)
            ->header('Content-Type', 'text/plain');
    }

    public function studentDestroy(Request $request, $task_id){
        if($request->has('user_id')){
            $user_id = $request->get('user_id');

            $user = User::find($user_id);
            $user->task_id = null;
            $user->save();

            $task = Task::find($task_id);
            $task->user_id = null;
            $task->save();

            return response('Success', 200)
                ->header('Content-Type', 'text/plain');
        }
        return response('Invalid request', 400)
            ->header('Content-Type', 'text/plain');
    }
}
