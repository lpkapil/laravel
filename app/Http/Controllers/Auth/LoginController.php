<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function credentials(\Illuminate\Http\Request $request) {
        $credentials = $request->only($this->username(), 'password');

        return array_add($credentials, 'status', '1');
    }

    /**
     * Check account active status before login 
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request) {
        $user = User::where($this->username(), $request->input('email'))->first();

        if ($user && !$user->status) {
            $errorMessage = 'Your account is inactive, Please contact administrator.'; // you can use trans here too
        } else {
            $errorMessage = trans('auth.failed');
        }

        $errors = [$this->username() => $errorMessage];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
    }

}
