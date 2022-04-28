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
        return response()->json($id);
    }
}
