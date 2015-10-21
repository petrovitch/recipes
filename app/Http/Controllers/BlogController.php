<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(env('PAGINATION_MAX'));
        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $comments = $post->comments()->get();
        return view('blog.show', compact('post', 'comments'));
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
