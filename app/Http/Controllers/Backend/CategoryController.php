<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory(){
        $category = Category::latest()->get();

        return view('admin.backend.category.all_category', compact('category'));
    }

    public function addCategory(){
        return view('admin.backend.category.add_category');
    }

    public function storeCategory(CategoryRequest $request)
    {
        try {

            $category = new Category();

            $category->name    = $request->name;
            $category->slug    = Str::slug($request->name);
            $category->status  = $request->status;

            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('uploads/categories/'.$category->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('uploads/categories'), $filename);
                $category['image'] = $filename;
            }

            $category->save();

            $notification = array(
                'message' => 'Category Created Successfully',
                'alert-type' => 'success'
            );

            return redirect('/all/category')->with($notification);
        } catch (Exception $th) {
            throw $th;
        }
    }
}
