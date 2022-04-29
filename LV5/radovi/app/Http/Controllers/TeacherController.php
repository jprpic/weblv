<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    public function create(Request $request, $locale){
        Gate::authorize('tasks_create');
        if (! in_array($locale, ['en', 'hr'])) {
            abort(400);
        }

        App::setLocale($locale);

        return Inertia::render('Create',[
            'role' => Auth()->user()->role_id,
            'trans' => json_decode(File::get(lang_path("$locale.json")))->create
        ]);
    }

    public function store(Request $request){
        Gate::authorize('tasks_create');

        if($request->has(['name','name_eng','description','studies'])){
            $request->validate([
                'name' => ['required', 'max:100'],
                'name_eng' => ['required', 'max:100'],
                'description' => ['required', 'max:1000'],
                'studies' => 'array:0,1,2'
            ]);
            $task = new Task();
            $task->created_by = Auth()->id();
            $task->name = $request->input('name');
            $task->name_eng = $request->input('name_eng');
            $task->description = $request->input('description');

            $task->save();

            foreach($request->input('studies') as $study_id){
                DB::insert('INSERT INTO study_task (study_id, task_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[$study_id, $task->id, now(), now()]);
            }

            return redirect('dashboard');
        }
        return response('Invalid request', 400)
            ->header('Content-Type', 'text/plain');

    }

    public function studentStore(Request $request, $task_id){
        Gate::authorize('tasks_create');

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
        Gate::authorize('tasks_create');

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
