<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function allSubCategory(){
        $subCategory = SubCategory::latest()->get();

        return view('admin.backend.sub_category.all_sub_category', compact('subCategory'));
    }

    public function addSubCategory(){
        return view('admin.backend.sub_category.add_sub_category');
    }

    public function storeSubCategory(SubCategoryRequest $request)
    {
        try {

            $category = new SubCategory();

            $category->name        = $request->name;
            $category->slug        = Str::slug($request->name);
            $category->category_id = $request->category_id;
            $category->status      = $request->status;

            if($request->file('image')){
                $file = $request->file('image');
                $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $manager = new ImageManager(new Driver());
                $manager->read($file)->resize(370,246)->save('uploads/sub_categories/'.$name_gen);
                $category['image'] = 'uploads/sub_categories/'.$name_gen;
            }

            $category->save();

            $notification = array(
                'message' => 'SubCategory Created Successfully',
                'alert-type' => 'success'
            );

            return redirect('/all/sub-category')->with($notification);
        } catch (Exception $th) {
            throw $th;
        }
    }

    // public function updateCategory(CategoryRequest $request, $id)
    // {
    //     try {

    //         $category = SubCategory::find($id);

    //         $category->name    = $request->name;
    //         $category->slug    = Str::slug($request->name);
    //         $category->status  = $request->status;

    //         if($request->hasFile('image')){
    //             $file = $request->file('image');
    //             @unlink(public_path($category->image));
    //             $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
    //             $manager = new ImageManager(new Driver());
    //             $manager->read($file)->resize(370,246)->save('uploads/categories/'.$name_gen);
    //             $category['image'] = 'uploads/categories/'.$name_gen;
    //         }

    //         $category->save();

    //         $notification = array(
    //             'message' => 'Category Updated Successfully',
    //             'alert-type' => 'success'
    //         );

    //         return redirect()->back()->with($notification);
    //     } catch (Exception $th) {
    //         throw $th;
    //     }
    // }

    public function destroySubCategory($id)
    {
        $subCategory = SubCategory::find($id);
        $img      = $subCategory->image;
        unlink($img);

        $subCategory->delete();

        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
