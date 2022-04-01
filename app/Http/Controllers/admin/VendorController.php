<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorCreated;
use DB;
use Illuminate\Support\Str;

class VendorController extends Controller
{

    public function index()
    {
        $vendors = Vendor::selection()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $categories = MainCategory::where('translate_of', 0)->active()->get();
        return view('admin.vendors.create', compact('categories'));
    }


    public function store(VendorRequest $request)
    {
        try {

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active' => $request->active,
                'address' => $request->address,
                'category_id' => $request->category_id,
                'logo' => $filePath,
            ]);

            Notification::send($vendor, new VendorCreated($vendor));

            return redirect()->route('admin.vendors')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function show(Vendor $vendor)
    {
        //
    }


    public function edit($id)
    {
        try {
            $vendor = Vendor::selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود أو ربما يكون محذوفا']);

            $categories = MainCategory::where('translate_of', 0)->active()->get();

            return view('admin.vendors.edit', compact('vendor', 'categories'));
        } catch (\Exception $exception) {
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }


    public function update($id, VendorRequest $request)
    {
        try {
            $vendor = Vendor::selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود أو ربما يكون محذوفا']);
            DB::beginTransaction();
            //photo
            if ($request->has('logo')){
                $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }
            $data = $request -> except('_token', 'id', 'photo', 'password');
            if ($request->has('password')) {
                $data['password'] == $request -> password;
            }

            Vendor::where('id', $id)
                ->update($data);

            DB::commit();
            return redirect()->route('admin.vendors')->with(['error' => 'تم التحديث بنجاح']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.vendors')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }

    }


        //password


        public function destroy($id)
        {
            try {
                $vendor = Vendor::find($id);
                if (!$vendor)
                    return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود']);

                $image = Str::after($vendor->logo, 'assets/');
                $image = public_path('assets/' . $image);
                unlink($image);
                $vendor->delete();
                return redirect()->route('admin.vendors')->with(['success' => 'تم حذف المتجر بنجاح']);
            } catch (\Exception $ex) {
                return redirect()->route('admin.vendors')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
            }
        }
        public function changestatus($id)
        {

            try {
                $vendor = Vendor::find($id);
                if(!$vendor)
                    return redirect()->route('admin.vendors')->with(['error' => 'هذا المتجر غير موجود']);

                $status = $vendor -> active == 0 ? 1 : 0;

                $vendor -> update(['active' => $status]);
                return redirect()->route('admin.vendors')->with(['success' => 'تم تغيير حالة المتجر بنجاح']);

            }catch (\Exception $ex){
                return redirect()->route('admin.vendors')->with(['error' =>'حدث خطأ برجاء المحاولة لاحقا']);
            }
        }
        }
