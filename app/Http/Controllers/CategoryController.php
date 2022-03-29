<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function saveCategory(Request $request)
    {
       
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'status' => 'required',
        ]);
            Category::insertGetId([
                'category_name' => $request->category_name,
                'slug' => $request->slug,
                'status' => $request->status,
            ]);
            return 1;
        
    }
}
