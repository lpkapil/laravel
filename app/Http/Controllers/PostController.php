<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

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

        if (Auth::user()->roles->first()->name == 'admin') {
            $posts = Post::with('user')->orderByDesc('created_at')->get();
        } else {
            $posts = Post::with('user')->where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->Validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'status' => $request['status'],
            'user_id' => Auth::user()->id
        ]);

        return redirect('/dashboard/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {

        if (($post->user_id == Auth::user()->id) || (Auth::user()->roles->first()->name == 'admin')) {
            return view('admin.posts.edit', compact('post'));
        }

        return redirect('/dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {

        if (($post->user_id == Auth::user()->id) || (Auth::user()->roles->first()->name == 'admin')) {
            $this->Validate($request, [
                'title' => 'required|string',
                'content' => 'required|string',
                'status' => 'required|boolean',
            ]);


            $post = Post::find($post->id);
            $post->title = $request['title'];
            $post->content = $request['content'];
            $post->status = $request['status'];

            //Check if admin editing, don't update current user id
            if (Auth::user()->roles->first()->name == 'admin') {
                $post->user_id = $post->user_id;
            } else {
                $post->user_id = Auth::user()->id;
            }

            $post->save();

            return redirect('/dashboard/posts');
        }

        return ['status' => false, 'message' => 'Unauthorized Action!'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        
        if (($post->user_id == Auth::user()->id) || (Auth::user()->roles->first()->name == 'admin')) {
            $post = Post::find($post->id);
            $post->delete();
            return ['status' => true, 'message' => 'Post Deleted Successfully!'];
        }

        return ['status' => false, 'message' => 'Unauthorized Action!'];
    }

}
