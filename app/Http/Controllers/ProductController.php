<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Category;
use Intervention\Image\Facades\Image;
use File;
use App\ProductsImage;
use App\Order;
use App\LandingPage;
use Carbon\Carbon;
use App\Favorite;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $category_id = $request->input('category_id');
            if ($category_id === "0") {
                return redirect('/admin/add-product')->with('flash_message_error', 'Необходимо е да изберете категория за продукта!');
            }
            $product_name = $request->input('product_name');
            $product_code = $request->input('product_code');
            $description = $request->input('description');
            $price = $request->input('price');
            $product = new Product();
            $product->category_id = $category_id;
            $product->product_name = $product_name;
            $product->product_code = $product_code;
            $product->description = $description;
            if (empty($description)) {
                $product->description = '';
            }
            $product->price = $price;
            $product->featured = $request->input('featured');
            $product->status = $request->input('status');
            //upload image
            if ($request->hasFile('image')) {
                $image_temp = Input::file('image');
                if ($image_temp->isValid()) {
                    $extension = $image_temp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;
                    // Resize images
                    Image::make($image_temp)->resize(null, 1200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($large_image_path);
                    Image::make($image_temp)->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($medium_image_path);
                    Image::make($image_temp)->resize(null, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($small_image_path);
                    // Store image names in table
                    $product->image = $filename;
                }
            } else {
                $product->image = '';
            }
            $product->save();
            return redirect('/admin/view-products')->with('flash_message_success', 'Успешно създадохте нов продукт!');
        }
        $categories = Category::get();
        return view('admin.products.add_product')->with([
            'categories' => $categories
        ]);
    }

    public function editProduct(Request $request, $id = null)
    {
        $product = Product::where(['id' => $id])->first();
        if ($request->isMethod('post')) {
            //upload image
            if ($request->hasFile('image')) {
                // Delete old image
                $product_image = $product->image;
                if (File::exists('images/backend_images/products/small/' . $product_image)) {
                    File::delete('images/backend_images/products/small/' . $product_image);
                }
                if (File::exists('images/backend_images/products/medium/' . $product_image)) {
                    File::delete('images/backend_images/products/medium/' . $product_image);
                }
                if (File::exists('images/backend_images/products/large/' . $product_image)) {
                    File::delete('images/backend_images/products/large/' . $product_image);
                }
                $image_temp = Input::file('image');
                if ($image_temp->isValid()) {
                    $extension = $image_temp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $filename;
                    $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                    $small_image_path = 'images/backend_images/products/small/' . $filename;
                    // Resize images
                    Image::make($image_temp)->resize(null, 1200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($large_image_path);
                    Image::make($image_temp)->resize(null, 600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($medium_image_path);
                    Image::make($image_temp)->resize(null, 300, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($small_image_path);
                }
            } else {
                $filename = $request->input('current_image');
                if (empty($request->input('current_image'))) {
                    $filename = '';
                }
            }
            $product->category_id = $request->input('category_id');
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->description = $request->input('description');
            if (empty($product->description)) {
                $product->description = '';
            }
            $product->price = $request->input('price');
            $product->image = $filename;
            $product->featured = $request->input('featured');
            $product->status = $request->input('status');

            $product->save();
            return redirect('/admin/edit-product/' . $product->id)->with('flash_message_success', 'Успешно редактирахте продукта!');
        }
        $categories = Category::all();
        return view('admin.products.edit_product')->with([
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function checkProduct(Request $request)
    {
        // Check if product code exist
        $product = Product::where(['product_code' => $request->input('product_code')])->first();
        if (empty($product) || $product->id == $request->input('id')) {
            return "true";
            die;
        } else {
            return "false";
        }
    }

    public function deleteProduct(Request $request, $id = null)
    {
        if (!empty($id)) {
            $product = Product::where(['id' => $id])->first();

            if (Order::where(['product_id' => $product->id])->first()) {
                return redirect('/admin/view-products')->with('flash_message_error', 'Продуктът не може да бъде изтрит, тъй като имате заявки за него!');
            } else {
                // Delete image
                $product_image = $product->image;
                if (File::exists('images/backend_images/products/small/' . $product_image)) {
                    File::delete('images/backend_images/products/small/' . $product_image);
                }
                if (File::exists('images/backend_images/products/medium/' . $product_image)) {
                    File::delete('images/backend_images/products/medium/' . $product_image);
                }
                if (File::exists('images/backend_images/products/large/' . $product_image)) {
                    File::delete('images/backend_images/products/large/' . $product_image);
                }
                // Delete images
                $productsImage = ProductsImage::where(['product_id' => $id])->get();
                foreach ($productsImage as $image) {
                    if (File::exists('images/backend_images/products/small/' . $image->image)) {
                        File::delete('images/backend_images/products/small/' . $image->image);
                    }
                    if (File::exists('images/backend_images/products/medium/' . $image->image)) {
                        File::delete('images/backend_images/products/medium/' . $image->image);
                    }
                    if (File::exists('images/backend_images/products/large/' . $image->image)) {
                        File::delete('images/backend_images/products/large/' . $image->image);
                    }
                    $image->delete();
                }
                // Delete products_cities
                $productsCities = ProductsCity::where(['product_id' => $id])->get();
                foreach ($productsCities as $product_city) {
                    $product_city->delete();
                }
                $productsCitiesSend = ProductsCitySend::where(['product_id' => $id])->get();
                foreach ($productsCitiesSend as $product_city) {
                    $product_city->delete();
                }
                // Delete product
                $product->delete();
                return redirect('/admin/view-products')->with('flash_message_success', 'Успешно изтрихте продукта!');
            }
        }
    }

    public function viewProducts()
    {
        $products = Product::all();
        return view('admin.products.view_products')->with(['products' => $products]);
    }

    public static function getProductById($id = null)
    {
        if (!empty($id)) {
            $product = Product::where(['id' => $id])->first();
            return $product;
        }
    }

    public function deleteProductImage(Request $request, $id = null)
    {
        if (!empty($id)) {
            $product_image = Product::where(['id' => $id])->first()->image;
            if (File::exists('images/backend_images/products/small/' . $product_image)) {
                File::delete('images/backend_images/products/small/' . $product_image);
            }
            if (File::exists('images/backend_images/products/medium/' . $product_image)) {
                File::delete('images/backend_images/products/medium/' . $product_image);
            }
            if (File::exists('images/backend_images/products/large/' . $product_image)) {
                File::delete('images/backend_images/products/large/' . $product_image);
            }
            Product::where(['id' => $id])->update(['image' => '']);
            return redirect('/admin/edit-product/' . $id)->with('flash_message_success', 'Успешно изтрихте снимката на продукта!');
        }
    }

    public function addImages(Request $request, $id = null)
    {
        $product = Product::with('images')->where(['id' => $id])->first();

        if ($request->isMethod('post')) {
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                //upload images
                foreach ($files as $file) {
                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = rand(111, 99999) . '.' . $extension;
                        $large_image_path = 'images/backend_images/products/large/' . $filename;
                        $medium_image_path = 'images/backend_images/products/medium/' . $filename;
                        $small_image_path = 'images/backend_images/products/small/' . $filename;
                        // Resize images
                        Image::make($file)->resize(null, 1200, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($large_image_path);
                        Image::make($file)->resize(null, 600, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($medium_image_path);
                        Image::make($file)->resize(null, 300, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($small_image_path);
                        // Store image in table
                        $productsImage = new ProductsImage();
                        $productsImage->product_id = $id;
                        $productsImage->image = $filename;
                        $productsImage->save();
                    }
                }
                return redirect('/admin/add-images/' . $id)->with('flash_message_success', 'Успешно добавихте снимките на продукта!');
            }
        }

        return view('admin.products.add_images')->with(['product' => $product]);
    }

    public function deleteProductImages(Request $request, $id = null)
    {
        if (!empty($id)) {
            $product_image = ProductsImage::where(['id' => $id])->first()->image;
            if (File::exists('images/backend_images/products/small/' . $product_image)) {
                File::delete('images/backend_images/products/small/' . $product_image);
            }
            if (File::exists('images/backend_images/products/medium/' . $product_image)) {
                File::delete('images/backend_images/products/medium/' . $product_image);
            }
            if (File::exists('images/backend_images/products/large/' . $product_image)) {
                File::delete('images/backend_images/products/large/' . $product_image);
            }
            ProductsImage::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Успешно изтрихте снимката на продукта!');
        }
    }

    public function frontViewProducts(Request $request)
    {
        $table = $request->session()->get('table');
        if ($table != null && $table > 0 && $table < 9){
            // Filter products result
            $products = Product::where(['status' => 'active']);
            // Get category requests
            if (!empty(request('category_id'))) {
                // filter products
                $products = $products->where('category_id', request('category_id'))->get();
                $category_name = Category::where(['id' => request('category_id')])->first()->name;
            }else{
                $category_name = "Всички";
            }

            // result products paginating
            $all_products_count = $products->count();

            // Add property
            $property = LandingPage::first();
            // Add category
            $categories = Category::all();

            $order = Order::where(['table_id'=>$table, 'status'=>'work'])->first();

            return view('/front/view_products')->with([
                'property' => $property,
                'categories' => $categories,
                'products' => $products,
                'all_products_count' => $all_products_count,
                'category_name' => $category_name,
                'order' => $order
            ]);
        }else{
            return redirect('/');
        }
    }

    public function frontGetProduct(Request $request, $id = null)
    {
        $table = $request->session()->get('table');
        if ($table != null && $table > 0 && $table < 9){
            $product = Product::where(['product_code' => $id])->first();
            $property = LandingPage::first();

            $order = Order::where(['table_id'=>$table, 'status'=>'work'])->first();
    
            return view('/front/get_product')->with([
                'product' => $product,
                'property' => $property,
                'order' => $order
            ]);    
        }else{
            return redirect('/');
        }
    }

    public static function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s');
    }

    public static function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i:s');
    }

    public static function frontGetProductByUser($user_id)
    {
        $products_by_user_count = Product::where(['user_id' => $user_id, 'status' => 'active'])->where('active_at', '>=', date("Y-m-d", strtotime("-1 months")))->count();
        if ($products_by_user_count >= 5) {
            $products_by_user_count = 5;
        }
        $products_by_user = Product::where(['user_id' => $user_id, 'status' => 'active'])->where('active_at', '>=', date("Y-m-d", strtotime("-1 months")))->inRandomOrder()->take($products_by_user_count)->get();

        return $products_by_user;
    }

}
