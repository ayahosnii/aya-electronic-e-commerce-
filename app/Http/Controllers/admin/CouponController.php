<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::sel()->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(CouponRequest $request)
    {
        try {
            $coupon = Coupon::create([
                'code' => $request->code,
                'type' => $request->type,
                'value' => $request->value,
                'cart_value' => $request->cart_value,
                'expiry_date' => $request->expiry_date,

            ]);

            return redirect()->route('admin.coupon')->with('success', 'Coupon has been applied');
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.coupon')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
            $coupon = Coupon::sel()->find($id);
            if (!$coupon)
                return redirect()->route('admin.coupon')->with('error', 'Coupon isn\'t found');

            return view('admin.coupon.edit', compact('coupon'));
        DB::beginTransaction();


    }

    public function update(CouponRequest $request, $id)
    {
        try {
            $coupon = Coupon::sel()->find($id);
            if (!$coupon)
                return redirect()->route('admin.coupon')->with('error', 'الكوبون ليس موجودا');
            DB::beginTransaction();

            Coupon::where('id', $id)
                ->update([
                    'code' => $request->code,
                    'type' => $request->type,
                    'value' => $request->value,
                    'cart_value' => $request->cart_value,
                    'expiry_date' => $request->expiry_date,
                ]);

            DB::commit();
            return redirect()->route('admin.coupon')->with('success', 'تم تحديث الكوبون');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.coupon')->with(['error' => 'حدث خطأ برجاء المحاولة لاحقا']);
        }
    }


    public function destroy($id)
    {
        //
    }
}
