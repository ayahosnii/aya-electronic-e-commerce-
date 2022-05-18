<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSliderRequest;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function redirect;
use function uploadImage;
use function view;

class HomeSliderController extends Controller
{

    public function index()
    {
        $sliders = HomeSlider::selection()->paginate();
        return view('admin.homeslider.index', compact('sliders'));
    }


    public function create()
    {
        $sliders = HomeSlider::selection()->active()->get();
        return view('admin.homeslider.create', compact('sliders'));
    }


    public function store(HomeSliderRequest $request)
    {
        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('image')) {
                $filePath = uploadImage('products', $request->image);
            }
            $sliders = HomeSlider::create([
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'price' => $request->price,
                    'link' => $request->link,
                    'active' => $request->active,
                    'image' => $filePath,
                ]);

            return redirect()->route('admin.homeslider')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.homeslider')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
      try {
        $slides = HomeSlider::find($id);
        if (!$slides)
            return redirect()->route('admin.homeslider')->with(['error' => 'هذا المنتج غير موجود']);

        $image = Str::after($slides->image, 'assets/site/images/products/images/');
        $image = public_path('assets/site/images/products/' . $image);
        unlink($image);

        $slides->delete();
        return redirect()->route('admin.homeslider')->with(['success' => 'تم حذف المنتج بنجاح']);


    } catch (\Exception $ex) {
            return redirect()->route('admin.homeslider')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function changestatus($id)
    {

        try {
            $sliders = HomeSlider::find($id);
            if (!$sliders)
                return redirect()->route('admin.homeslider')->with(['error' => 'هذا المنتج غير موجود']);

            $status = $sliders->active == 0 ? 1 : 0;

            $sliders->update(['active' => $status]);
            return redirect()->route('admin.homeslider')->with(['success' => 'تم تغيير حالة المنتج بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.homeslider')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }
}
