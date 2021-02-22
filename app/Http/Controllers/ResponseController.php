<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResponseController extends Controller
{
    public function store( Request $request) {

        $request->validate([
            'response' => 'required'
        ]);

        Response::create($request->all());

        return Redirect::back();
    }
}
