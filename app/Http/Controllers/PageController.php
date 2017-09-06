<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller {

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function __construct() {
        
    }

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function index() {
        $posts = Post::with('user')->where('status', '1')->orderByDesc('created_at')->paginate(5);
        if ($posts->total() > 0) {
            return view('posts', compact('posts'));
        } else {
            return view('welcome');
        }
    }

    /**
     * Add a single condition, or an array of conditions to the WHERE clause of the query.
     * 
     * @param   mixed   $conditions  A string or array of where conditions.
     * @return  JDatabaseQuery  Returns this object to allow chaining.
     * @since   1.0
     */
    public function singlepost($post) {
        $post = Post::find($post);
        if (!empty($post)) {
            return view('postdetail', compact('post'));
        } else {
            return response()->view('message.404', [], 404);
        }
    }

}
