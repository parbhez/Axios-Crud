<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function saveCategory(Request $request)
    {
       
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255|min:4',
            'slug' => 'required|unique:categories|max:255|min:4',
        ]);

        // $data = [];
        // $data['category_name'] = $request->category_name;
        // $data['slug'] = $request->slug;
        // $data['status'] = $request->status;
        try{
            $save = Category::create([
                'category_name' => $request->category_name,
                'slug' => $request->slug,
                'status' => $request->status
            ]);
            if($save){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Category Insert Successfully',
                    'code'=> 201, 
                    'result'=> $save
                ],200);
            }else{
                return response()->json([
                    'error'=> true,
                    'message'=> 'Category Not inserted',
                    'code'=> 409, 
                    'result'=> []
                ],409);
            }
   
        }catch(QueryException $e){
            return response()->json([
                'error'=> true,
                'message'=> 'Something Went Wrong',
                'code'=> 500, 
                'result'=> $e->getMessage()
            ],500);
        }
    }

    public function getAllCategory()
    {
        $allcategory = Category::latest()->get();
        return $allcategory;
    }

    public function deleteCategory($category_id)
    {
        $findCategory = Category::where('id',$category_id)->first();
        $findCategory->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category Deleted successfully !!',
            'code' =>  200,
            'result' => $findCategory
        ]);
    }

    public function editCategory($id)
    {
        $category = Category::where('id',$id)->first();
        return $category;
    }

    public function updateCategory(Request $request,$id)
    {
        $category = Category::where('id',$id)->first();
        if($category){
           $update = Category::where('id',$id)->update([
               'category_name' => $request->category_name,
               'slug' => $request->slug,
               'status' => $request->status
           ]);

           if($update){
            return response()->json([
                'success' => true,
                'message' => 'Category Updated successfully !!',
                'code' =>  200,
                'result' => $update
            ]);
           }else{
            return response()->json([
                'error' => true,
                'message' => 'Category Not Updated !!',
                'code' =>  500,
                'result' => $update
            ]);
           }
        }
    }
}
