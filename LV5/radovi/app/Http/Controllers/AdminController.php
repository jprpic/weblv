<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function roles(Request $request){
        Gate::authorize('user_update_role');

        return Inertia::render('Roles',[
            'role' => Auth()->user()->role_id,
            'users' => User::all(),
        ]);
    }

    public function changeRole(Request $request, $id){
        // Array to allow cycling between roles
        $role_ids = array(3, 1, 2, 3);

        $user = User::find($id);
        $current_role = $user->role_id;
        $user->role_id = $role_ids[$current_role - 1];
        $user->save();

        return response()->json($user);
    }
}
