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


//            Mail::raw('Hello Kapil', function ($message) {
//                $message->to('lpkapil@mailinator.com');
//            });

            return view('admin.dashboard');
        }
        if ($request->user()->authorizeRoles(['subscriber'])) {
            return view('subscriber.dashboard');
        }

        abort(401, 'This action is unauthorized.');
    }

    /*
      public function someAdminStuff(Request $request)
      {
      $request->user()->authorizeRoles('manager');
      return view(‘some.view’);
      }
     */
}
