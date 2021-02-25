<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
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
}
