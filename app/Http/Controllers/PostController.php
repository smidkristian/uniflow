<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $user_post_votes = auth()->user()->post_votes()->get();

        return Inertia::render('Posts/Feed', [
            'posts' => $posts,
            'user_post_votes' => $user_post_votes
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

    public function view($id)
    {
        $target = Post::find($id);
        $responses = $target->responses()->get();

        return Inertia::render('Posts/PostDetail', [
            'post' => $target,
            'responses' => $responses
        ]);
    }

    public function vote(Request $request)
    {
        PostVote::create($request->all());
        $target = Post::find($request->post_id);

        if($request->vote == 1) {
            $target->increment('upvotes_count');
        } else {
            $target->increment('downvotes_count');
        }

        return response()->json($request);
    }

    public function create() {

        return Inertia::render('Posts/CreatePost');
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
