<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if ($request->isMethod('post')){
            if (
                !empty($request->input('category_name')) && 
                !empty($category_description = $request->input('category_description')) && 
                !empty($category_url = $request->input('category_url'))
            ){
                $category_name = $request->input('category_name');
                $category_parent_id = $request->input('parent_id');
                $category_description = $request->input('category_description');
                $category_url = $request->input('category_url');
                $category_icon = $request->input('category_icon');
                $category_position = $request->input('category_position');
                $category = new Category();
                $category->name = $category_name;
                $category->parent_id = $category_parent_id;
                $category->description = $category_description;
                $category->url = $category_url;
                $category->icon = $category_icon;
                $category->position = $category_position;
                $category->save();
                return redirect('/admin/view-categories')->with('flash_message_success', 'Успешно създадохте нова категория!');
            }else{
                return redirect('/admin/add-category')->with('flash_message_error', 'Имате непопълнено поле!');
            }
        }
        return view('admin.categories.add_category');
    }

    public function editCategory(Request $request, $id=null){
        $category = Category::where(['id'=>$id])->first();
        if ($request->isMethod('post')){
            $category->name = $request->input('category_name');
            $category->description = $request->input('category_description');
            $category->url = $request->input('category_url');
            $category->icon = $request->input('category_icon');
            $category->position = empty($request->input('category_position')) ? 0 : $request->input('category_position');
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Успешно редактирахте категорията!');
        }
        return view('admin.categories.edit_category')->with(['category'=>$category]);
    }

    public function deleteCategory(Request $request, $id=null){
        if (!empty($id)){
            $category = Category::where(['id'=>$id])->first();
            $category->delete();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Успешно изтрихте категорията!');
        }
    }

    public function viewCategory(){
        $categories = Category::all();
        
        return view('admin.categories.view_categories')->with([
            'categories'=>$categories
        ]);
    }

    public static function getCategoryById($id=null){
        if (!empty($id)){
            $category = Category::where(['id'=>$id])->first();
            return $category;
        }
    }

    public static function getSubcategoryById($id=null){
        if (!empty($id)){
            $category = Category::where(['parent_id'=>$id])->get();
            return $category;
        }
    }

    public function populateCategories(Request $request){
        if($request->isMethod('post')){
            if ($request->input('category_id') != 0){
                $category = Category::where(['parent_id'=>$request->input('category_id')])->get();
                return $category;    
            }else{
                return 'No';
            }
        }else{
            return 'No';
        }
    }

}
