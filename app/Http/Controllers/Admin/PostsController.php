<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\PostEditFormRequest;
use App\Http\Requests\PostFormRequest;
use App\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostFormRequest $request)
    {
        $post= new Post(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => Str::slug($request->get('title'), '-'),
        ));

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect('/admin/posts/create')->with('status', 'The post has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->categories->lists('id')->toArray();;
        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, PostEditFormRequest $request)
    {
        $post = Post::whereId($id)->firstOrFail();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->slug = Str::slug($request->get('title'), '-');

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect(action('Admin\PostsController@edit', $post->id))->with('status', 'The post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
