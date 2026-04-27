<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'message' => 'List of tags',
            'data'=> $tags
        ]);
    }

    public function store(Request $request)     
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:tags,slug',
        ]);

        $tag = Tag::create($request->all());
        return response()->json([
            'message' => 'Tag created successfully',
            'tag' => $tag,
        ], 201);    
      }

    public function show($id) 
    {  
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json([
                'message' => 'Tag not found',
            ], 404);
        }
        return response()->json([
            'message' => "Details of tag with id: $id",
            'data' => $tag
        ]);
     }
    
    public function update(Request $request, $id) 
    {  
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:tags,slug,' . $id,
        ]);
        $tag = Tag::find($id);
        Tag::where('id', $id)->update($request->all());
        if (!$tag) {
            return response()->json([
                'message' => 'Tag not found',
            ], 404);    
        }
    }

    public function destroy($id)
    { 
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json([
                'message' => 'Tag not found',
            ], 404);    
        }
        $tag->delete();
        return response()->json([
            'message' => 'Tag deleted successfully',
        ]);
    }   
}
