<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        if ($request->user()->authorizeRoles(['admin'])) {
            return view('admin.dashboard');
        }
        if ($request->user()->authorizeRoles(['subscriber'])) {
            return view('subscriber.dashboard');
        }
        
        return response()->view('message.404', ['message' => 'Error : View Needs to be created for '.$request->user()->roles->first()->name.' role.'], 404);
    }
}
