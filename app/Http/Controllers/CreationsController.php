<?php

namespace App\Http\Controllers;

use Auth;
use App\Creation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreationsController extends Controller
{
    public function index()
    {
        $data = Creation::select('id', 'cover', 'title', 'content')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            "status" => 200,
            "message" => "Success",
            "data" => $data
        ], 200);
    }
}
