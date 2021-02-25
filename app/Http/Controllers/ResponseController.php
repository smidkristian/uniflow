<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResponseController extends Controller
{
    public function store( Request $request) {

        $request->validate([
            'response' => 'required'
        ]);

        $target = Post::findOrFail($request->post_id);

        Response::create($request->all());
        $target->increment('responses_count');

        return Redirect::back();
    }
}
