<?php

namespace App\Http\Controllers;

use App\User;
use App\Media;
use App\Post;
use Storage;
use App\Role;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::with('roles')->orderByDesc('created_at')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::where('status', '1')->pluck('name', 'id');
        $user = new \stdClass();
        $user->allroles = $roles;
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->Validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|boolean',
        ]);

        $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password']),
                    'status' => $request['status'],
        ]);

        $user->roles()->attach(Role::where('id', $request['role_id'])->first());

        return redirect('/dashboard/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $roles = Role::where('status', '1')->pluck('name', 'id');
        $user->allroles = $roles;
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {

        if (Auth::user()->roles->first()->name != 'admin') {
            return ['status' => false, 'message' => 'Unauthorized Action!'];
        }

        $this->Validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'status' => 'required|boolean',
        ]);

        //If Password
        if (!empty($request['password'])) {
            $this->Validate($request, [
                'password' => 'string|min:6',
            ]);
        }

        $user = User::find($user->id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if (!empty($request['password'])) {
            $user->password = bcrypt($request['password']);
        }
        $user->status = $request['status'];
        $user->save();

        $user->roles()->detach($user->roles->first()->id);
        $user->roles()->attach(Role::where('id', $request['role_id'])->first());

        return redirect('/dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {

        if (Auth::user()->roles->first()->name != 'admin') {
            return ['status' => false, 'message' => 'Unauthorized Action!'];
        }

        $user = User::find($user->id);
        $user->roles()->detach($user->roles->first()->id); // Detach User Roles Mapping Before Delete 
        
        //Find Media and delete files from storage
        $media = Media::where('user_id', $user->id)->get();

        if (!empty($media)) {
            foreach ($media as $mediaitem) {
                Storage::delete('/public/'.$mediaitem->url);
            }
        }

        Media::where('user_id', $user->id)->delete();
        Post::where('user_id', $user->id)->delete();
        
        $user->delete();
        return ['status' => true, 'message' => 'User Deleted Successfully!'];
    }

}
