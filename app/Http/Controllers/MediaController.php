<?php

namespace App\Http\Controllers;

use Storage;
use Auth;
use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller {

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
            $mediaitems = Media::with('user')->orderByDesc('created_at')->get();
        } else {
            $mediaitems = Media::with('user')->where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        }
        return view('admin.media.index', compact('mediaitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $file = $request->file('file');
        $this->Validate($request, [
            'file' => 'required|image|max:2000'
        ]);

        $filePath = Storage::url($request->file('file')->store('public'));

        Media::create([
            'name' => $file->getClientOriginalName(),
            'type' => $file->getClientMimeType(),
            'size' => $file->getClientSize(),
            'url' => $filePath,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/dashboard/media');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function show(Media $medium) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $medium) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $medium) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $medium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $medium) {
        
        if (($medium->user_id == Auth::user()->id) || (Auth::user()->roles->first()->name == 'admin')) {
            $medium = Media::find($medium->id);
            Storage::delete($medium->url);
            $medium->delete();
            return ['status' => true, 'message' => 'Media Deleted Successfully!'];
        }

        return ['status' => false, 'message' => 'Unauthorized Action!'];
    }

}