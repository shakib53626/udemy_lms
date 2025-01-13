<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $manager->read($file)->resize(370,246)->save('uploads/categories/'.$name_gen);
                $category['image'] = 'uploads/categories/'.$name_gen;
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

    public function updateCategory(CategoryRequest $request, $id)
    {
        try {

            $category = Category::find($id);

            $category->name    = $request->name;
            $category->slug    = Str::slug($request->name);
            $category->status  = $request->status;

            if($request->hasFile('image')){
                $file = $request->file('image');
                @unlink(public_path($category->image));
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $manager->read($file)->resize(370,246)->save('uploads/categories/'.$name_gen);
                $category['image'] = 'uploads/categories/'.$name_gen;
            }

            $category->save();

            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (Exception $th) {
            throw $th;
        }
    }
}
