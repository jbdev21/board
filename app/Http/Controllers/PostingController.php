<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostingController extends Controller
{
    function index(){
        $response = Http::get('https://mrge-group-gmbh.jobs.personio.de/xml');
        return $response->object();
    }
}
