<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\Vendor;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorCreated;
use DB;
use Illuminate\Support\Str;
use Livewire\Component;
/*
 *  //$default_lang = get_default_lang();
        //        $categories = Category::where('translation_lang', $default_lang)->get();
        $default_lang = get_default_lang();
        $products = Product::where('translation_lang', $default_lang)->get();
*/
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::selection()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = MainCategory::where('translate_of', 0)->active()->get();
        return view('admin.products.create', compact('categories'));
    }


    public function store(ProductRequest $request)
    {
        try {


            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            if (!$request->has('featured'))
                $request->request->add(['featured' => 0]);
            else
                $request->request->add(['featured' => 1]);

            $filePath = "";
            if ($request->has('image')) {
                $filePath = uploadImage('products', $request->image);
            }


            $default_lang = get_default_lang();
            if ($request->translation_lang == $default_lang)
                $product = Product::create([
                    'name' => $request->name,
                    'slug' => $request->name,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'regular_price' => $request->regular_price,
                    'sale_price' => $request->sale_price,
                    'SKU' => $request->SKU,
                    'stock_status' => $request->stock_status,
                    'featured' => $request->featured,
                    'active' => $request->active,
                    'category_id' => $request->category_id,
                    'translation_of' => 0,
                    'image' => $filePath,
                ]);

            if ($request->translation_lang != $default_lang)
                $product = Product::create([
                    'name' => $request->name,
                    'slug' => $request->name,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'regular_price' => $request->regular_price,
                    'sale_price' => $request->sale_price,
                    'SKU' => $request->SKU,
                    'stock_status' => $request->stock_status,
                    'featured' => $request->featured,
                    'active' => $request->active,
                    'category_id' => $request->category_id,
                    'translation_of' => 1,
                    'translation_lang' => $request->translation_lang,
                    'image' => $filePath,
                ]);


            return redirect()->route('admin.products')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function show(Vendor $vendor)
    {
        //
    }


    public function edit($id)
    {
        try {
            $product = Product::selection()->find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود أو ربما يكون محذوفا']);

            $categories = MainCategory::where('translate_of', 0)->active()->get();

            return view('admin.products.edit', compact('product', 'categories'));
        } catch (\Exception $exception) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }



        public function update($id, ProductRequest $request)
        {
            try {
                $product = Product::selection()->find($id);
                if (!$product)
                    return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود أو ربما يكون محذوفا']);
                DB::beginTransaction();
                //photo
                if ($request->has('image')){
                    $filePath = uploadImage('products', $request->image);
                    Product::where('id', $id)
                        ->update([
                            'image' => $filePath,
                        ]);
                }
                $data = $request -> except('_token', 'id', 'photo');


                Product::where('id', $id)
                    ->update($data);

                DB::commit();
                return redirect()->route('admin.products')->with(['error' => 'تم التحديث بنجاح']);
            }catch (\Exception $exception){
                DB::rollBack();
                return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
            }

        }


            //password


    public function translate($id)
    {
        try {
            $product = Product::selection()->find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود أو ربما يكون محذوفا']);

            $categories = MainCategory::selection()->active()->get();

            return view('admin.products.create-translation', compact('product', 'categories'));
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function crateTranslation(ProductRequest $request)
    {
        try {
                if (!$request->has('active'))
                    $request->request->add(['active' => 0]);
                else
                    $request->request->add(['active' => 1]);

                if (!$request->has('featured'))
                    $request->request->add(['featured' => 0]);
                else
                    $request->request->add(['featured' => 1]);

                $filePath = "";
                if ($request->has('image')) {
                    $filePath = uploadImage('products', $request->image);
                }


                $default_lang = get_default_lang();
                if ($request->translation_lang == $default_lang)
                    $product = Product::create([
                        'name' => $request->name,
                        'slug' => $request->name,
                        'short_description' => $request->short_description,
                        'description' => $request->description,
                        'regular_price' => $request->regular_price,
                        'sale_price' => $request->sale_price,
                        'SKU' => $request->SKU,
                        'stock_status' => $request->stock_status,
                        'featured' => $request->featured,
                        'active' => $request->active,
                        'category_id' => $request->category_id,
                        'translation_of' => 0,
                        'image' => $filePath,
                    ]);

                if ($request->translation_lang != $default_lang)
                    $product = Product::create([
                        'name' => $request->name,
                        'slug' => $request->name,
                        'short_description' => $request->short_description,
                        'description' => $request->description,
                        'regular_price' => $request->regular_price,
                        'sale_price' => $request->sale_price,
                        'SKU' => $request->SKU,
                        'stock_status' => $request->stock_status,
                        'featured' => $request->featured,
                        'active' => $request->active,
                        'category_id' => $request->category_id,
                        'translation_of' => 1,
                        'translation_lang' => $request->translation_lang,
                        'image' => $filePath,
                    ]);

                DB::commit();
            return redirect()->route('admin.products')->with(['error' => 'تم انشاء الترجمة بنجاح']);
        }catch (\Exception $exception){
            return $exception;
            DB::rollBack();
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }

    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);

            $image = Str::after($product->image, 'assets/site/images/products/images/');
            $image = public_path('assets/site/images/products/' . $image);
            unlink($image);
            $product->delete();

            return redirect()->route('admin.products')->with(['success' => 'تم حذف المنتج بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function changestatus($id)
    {

        try {
            $product = Product::find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);

            $status = $product->active == 0 ? 1 : 0;

            $product->update(['active' => $status]);
            return redirect()->route('admin.products')->with(['success' => 'تم تغيير حالة المنتج بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }
}

