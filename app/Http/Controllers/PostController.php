<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
   public function index(Request $request)
    {
        // $posts = Post::orderBy("created_at","desc")->paginate(10);
        //where route has tag ?tag=technology
         $query = Post::query();
        if ($request->has('tag')) {
            $query->where('tag', $request->tag);
        }
        return $query->get();
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        return response()->json([
            'message' => "Details of post with slug: $id",
            'post' => $post,
        ]);
    }
    public function store(Request $request) 
    { 
         $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug'=>'required|string|unique:posts,slug',
            'content' => 'required|string',
        ]);

        Gate::authorize('create-article');    

        $post = Post::create([ 
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug'=>$request->input('slug'),
            'category_id' => $request->input('category_id'),
        ]);
        
        return response()->json([
            'message' => 'Post created successfully',
            'post' => $post,
        ], 201);
      }

    public function update(Request $request, $id) 
    {   }

    public function destroy($id) 
    {  
        Gate::authorize('delete-article');
        $post = Post::find( $id )->delete();
        return response()->noContent();
    }
}
