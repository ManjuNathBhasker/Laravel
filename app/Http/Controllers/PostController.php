<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $trash = false;

        $posts = Post::paginate(3);
        // $posts = Post::all();

        return view('index', compact('posts', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorys = Category::all();

        return view('create', compact('categorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'max:2000', 'image'],
            'title' => ['required', 'max:200'],
            'category' => ['required', 'integer'],
            'description' => 'required'
        ]);

        $fileName = time() . '-' . $request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads', $fileName);

        $post = new Post();
        $post->image = $filePath;
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $categorys = Category::all();

        return view('edit', compact('post', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required', 'max:2000', 'image'
            ]);

            $fileName = time() . '-' . $request->image->getCliendOriginalName();
            $filePath = $request->image->storeAs('uploads', $fileName);

            File::delete(public_path($post->image));

            $post->image = $filePath;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('post.index');
    }

    function trash()
    {

        $trash = true;

        // $posts = Post::onlyTrashed()->get();
        $posts = Post::onlyTrashed()->paginate(2);

        return view('index', compact('posts', 'trash'));
    }

    function restore(string $id)
    {

        $post = Post::onlyTrashed()->findOrFail($id);

        $post->restore();

        return redirect()->route('post.index');
    }

    function duplicate(string $id)
    {

        $post = Post::find($id);

        $newPost = $post->replicate();

        $newPost->title = $post->title . ' (copy)';

        $newPost->save();

        return redirect()->back();
    }

    function forceDelete(string $id)
    {

        $post = Post::onlyTrashed()->findOrFail($id);

        $post->forceDelete();

        return redirect()->back();
    }
}
