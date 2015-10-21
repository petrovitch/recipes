<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function last($n = 3){
        $posts = Post::all()
            ->with(['tags' => function($q){
                $q->select('id', 'title');
            }])
            ->with(['comments' => function($q){
                $q->active()->select('active', 'post_id');
            }])
            ->orderBy('id', 'desc')
            ->take($n)
            ->get();
    }
}
