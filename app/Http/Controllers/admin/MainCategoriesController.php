<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategories;
use App\Models\MainCategory;
use DB;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function collect;
use function get_default_lang;
use function redirect;
use function uploadImage;
use function view;

class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $default_lang = get_default_lang();
        $categories = MainCategory::where('translation_lang', $default_lang)
            ->selection()
            ->get();

        return view('admin.maincategories.index', compact('categories'));
    }

    public function create()
    {
       return view('admin.maincategories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        try {

            //Add values for requests//
            //1- collect Requests
            $main_categories = collect($request->category);

            //2- return the category which in default lang
            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_default_lang();
            });

            //3- Count Value
            $default_category = array_values($filter->all()) [0];

            //Upload Image
            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
            }


            #Not commit before end my code and write this [DB::commit();]
            DB::beginTransaction();

            //4-  Count values(id) for each requests in default language and will
            // begin with 0 by [array_values]
            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translate_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath,
            ]);

            //5- add values for requests in non default lang
            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_default_lang();
            });

            //6-  Count requests in array
            if (isset($categories) && $categories->count()) {
                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translate_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath,
                    ];
                }

                MainCategory::insert($categories_arr);
            }

            DB::commit();

            return redirect() -> route('admin.maincategories')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.maincategories')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainCategories  $mainCategories
     * @return \Illuminate\Http\Response
     */
    public function show(MainCategories $mainCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainCategories  $mainCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($mainCat_id)
    {
        $mainCategory = MainCategory::with('categories')
            ->selection()
            ->find($mainCat_id);

        if(!$mainCategory)
            return redirect() -> route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);

        return view('admin.maincategories.edit', compact('mainCategory'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainCategories  $mainCategories
     * @return MainCategoryRequest|Request|\Illuminate\Http\Response
     */
    public function update($mainCat_id, MainCategoryRequest $request)
    {
        try {


            //validation
            //find main id
            $main_category = MainCategory::find($mainCat_id);
            if (!$main_category)
                return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);

            //update
            $category = array_values($request->category) [0];
            if (!$request->has('category.0.active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            MainCategory::where('id', $mainCat_id)
                ->update([
                    'name' => $category['name'],
                    'active' => $request->active,
                ]);

            //save image

            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
                MainCategory::where('id', $mainCat_id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }

            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
        }catch (\Exception $ex){

            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }

    }


    public function destroy($id)
    {
        //validate
        try {
            $maincategory = MainCategory::find($id);
            if(!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);
        $vendors = $maincategory -> vendors();
        if(isset($vendors) && $vendors -> count() > 0){
            return redirect()->route('admin.maincategories')->with(['error' => 'لا يمكن حذف هذا القسم']);
        }

        $image = Str::after($maincategory -> photo, 'assets/');
        $image = public_path('assets/'.$image);
        unlink($image);  // Delete From Folder

            //delete translation
        $maincategory -> categories() -> delete();
        $maincategory -> delete();
        return redirect()->route('admin.maincategories')->with(['success' => 'تم حذف القسم بنجاح']);

        }catch (\Exception $ex){
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $maincategory = MainCategory::find($id);
            if(!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);

            $status = $maincategory -> active == 0 ? 1 : 0;

            $maincategory -> update(['active' =>$status ]);

            return redirect()->route('admin.maincategories')->with(['success' => 'تم تغيير حالة القسم بنجاح']);


        }catch (\Exception $ex){
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }
}
