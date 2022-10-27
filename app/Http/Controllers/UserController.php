<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\User;
use App\Models\Platform;
use Illuminate\Support\Facades\Input;



class UserController extends Controller
{
    public function index(Request $request) {
        $user = User::with('platforms', 'positions');
        

        $platform = Platform::all();
        $position = Position::all();

        if($request->input('q')){
            $user->where('name', 'LIKE', "%{$request->input('q')}%");
            return view('admin.user.index', [
                'users'     =>  $user->get(), 
                'positions' =>  $position,
                'platforms' =>  $platform,
            ]);
        } else {
            return view('admin.user.index', [
                'users'     =>  $user->get(),
                'positions' =>  $position,
                'platforms' =>  $platform,
            ]);
        }
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name'      =>  'required',
            'email'     =>  ['required', 'email', Rule::unique('users', 'email')],
            'password'  =>  'required',
        ]);
        $users = User::create([
            'name'      =>  $validated['name'],
            'email'     =>  $validated['email'],
            'password'  =>  bcrypt($validated['password']),
        ]);
        $users->positions()->attach($request->position);
        $users->platforms()->attach($request->platform);
        return redirect()->back()->with('message', 'New admin user added successfully.');
    }

    public function edit(Request $request, $id) {
        $user_id = User::findOrfail($id);
        $position = Position::all();
        $platform = Platform::all();
        $users = User::with('platforms', 'positions')->where('id', $id);
        return view('admin.user.edit', [
            'users'         =>  $user_id,
            'positions'     =>  $position,
            'platforms'     =>  $platform,
            'users_pivot'   =>  $users->get(),
        ]);
    }

    public function update(Request $request) {
        $users = User::findOrfail($request->id);
        if($request->password == "") {
            $users->update([
                'name'      =>  $request->name,
                'email'     =>  $request->email,
            ]);
            $users->positions()->sync($request->position);
            return redirect()->back()->with('message', 'Admin user updated successfully.');
        } else {
            $users->update([
                'name'      =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
            ]);
            $users->positions()->sync($request->position);
            return redirect()->back()->with('message', 'Admin user updated successfully.');
        }
    }

    public function store_new_platform(Request $request) {
        $users = User::findOrfail($request->id);
        $users->platforms()->syncWithoutDetaching($request->platform);
        return redirect()->back()->with('message', 'New platform added successfully.');
    }

    public function remove_platform(Request $request) {
        $users = User::findOrfail($request->id);
        $users->platforms()->detach($request->platform);
        return redirect()->back()->with('message', 'New platform added successfully.');
    }
}
