<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{

    public function store(Request $request)
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

    public function delete(Request $request) {

        $voteTarget = PostVote::where('user', $request->user)->where('post_id', $request->post_id)->first();

        PostVote::destroy($voteTarget->id);

        $postTarget = Post::find($request->post_id);

        if($request->vote == 1) {
            $postTarget->decrement('upvotes_count', 1);
        } else {
            $postTarget->decrement('downvotes_count', 1);
        }

        return response()->json($postTarget->id);
    }

    public function update(Request $request) {

        $voteTarget = PostVote::where('user', $request->user)->where('post_id', $request->post_id)->first();

        $voteTarget->update($request->all());

        $postTarget = Post::find($request->post_id);

        if($request->vote == 1) {
            $postTarget->decrement('downvotes_count', 1);
            $postTarget->increment('upvotes_count', 1);
        } else {
            $postTarget->decrement('upvotes_count', 1);
            $postTarget->increment('downvotes_count', 1);
        }

        return response()->json($postTarget);
    }
}
