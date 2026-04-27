<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of categories',
        ]);
    }

    public function store(Request $request)     
    {   }

    public function show($id) 
    {   }
    
    public function update(Request $request, $id) 
    {   }

    public function destroy($id)
    {   }

}
