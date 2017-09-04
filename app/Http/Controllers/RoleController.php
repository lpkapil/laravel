<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\User;
use App\Post;
use App\Media;
use Storage;
use Illuminate\Http\Request;

class RoleController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $roles = Role::orderByDesc('created_at')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->Validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Role::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'status' => $request['status']
        ]);

        return redirect('/dashboard/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {

        if (Auth::user()->roles->first()->name == 'admin') {
            return view('admin.roles.edit', compact('role'));
        }

        return redirect('/dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {

        if (Auth::user()->roles->first()->name == 'admin') {
            $this->Validate($request, [
                'name' => 'required|string|unique:roles,name,' . $role->id,
                'description' => 'required|string',
                'status' => 'required|boolean',
            ]);


            $role = Role::find($role->id);
            $role->name = $request['name'];
            $role->description = $request['description'];
            $role->status = $request['status'];
            $role->save();

            return redirect('/dashboard/roles');
        }

        return ['status' => false, 'message' => 'Unauthorized Action!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {

        if (Auth::user()->roles->first()->name == 'admin') {
            $role = Role::find($role->id);

            //Find all users with this role
            $users = User::whereHas('roles', function ($query) use ($role) {
                        $query->where('name', '=', $role->name);
                    })->get();

            //Find Media and delete files from storage
            foreach ($users as $user) {

                $media = Media::where('user_id', $user->id)->get();

                if (!empty($media)) {
                    foreach ($media as $mediaitem) {
                        Storage::delete($mediaitem->url);
                    }
                }

                Media::where('user_id', $user->id)->delete();
                Post::where('user_id', $user->id)->delete();
            }

            //Delete users
            User::whereHas('roles', function ($query) use ($role) {
                $query->where('name', '=', $role->name);
            })->delete();

            $role->delete();
            return ['status' => true, 'message' => 'Role Deleted Successfully!'];
        }

        return ['status' => false, 'message' => 'Unauthorized Action!'];
    }

}
