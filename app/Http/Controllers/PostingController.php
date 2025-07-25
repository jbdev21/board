<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostingController extends Controller
{
    function index()
    {
        $positions = Position::paginate(2);
        return view("job_posting", ['positions' => $positions]);
    }

    function show(Position $position){
        return view("job_show", ['position' => $position]);
    }
}
