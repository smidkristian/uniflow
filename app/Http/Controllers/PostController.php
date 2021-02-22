<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['post_votes'])->get();
        $responses = Response::with('response_votes')->get();
        $users = User::all();

        return Inertia::render('Posts/Feed', [
            'users' => $users,
            'posts' => $posts,
            'responses' => $responses
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Post::create($request->all());

        return Redirect::route('posts');
    }

    public function view(Request $request)
    {
        $id = $request->data['id'];
        $target = Post::find($id);
        $responses = $target->responses()->get();

        return Inertia::render('Posts/PostDetail', [
            'post' => $target,
            'responses' => $responses
        ]);
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
