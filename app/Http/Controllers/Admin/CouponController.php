<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Validators\CouponValidator;
use App\Models\Coupon;
use App\Models\CouponStatus;
use Illuminate\Http\Request;
use Exception;

class CouponController extends Controller
{
    use CouponValidator;

    public function index()
    {
        $coupons = Coupon::query()->with('coupon_status')->get();
        return view('admin.coupon.index')->with([
            'coupons' => $coupons
        ]);
    }

    public function edit($id)
    {
        try {
            $coupon = Coupon::query()->with('coupon_status')->find($id);
            if (!$coupon)
                throw new Exception('Kupon bulunamadı');
            $statuses = CouponStatus::all();
            return view('admin.coupon.edit')->with([
                'coupon' => $coupon,
                'statuses' => $statuses,
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin_coupon_index')->withErrors($exception->getMessage());
        }

    }

    public function update(Request $request)
    {
        try {
            $this->validations();
            $coupon = Coupon::query()->find($request->input('id'));
            $coupon->code = $request->input('code');
            $coupon->discount = $request->input('discount');
            $coupon->min_purchase = $request->input('min_purchase');
            $coupon->usage_limit = $request->input('usage_limit');
            $coupon->usage_date_start = $request->input('usage_date_start');
            $coupon->usage_date_end = $request->input('usage_date_end');
            $coupon->status = $request->input('status');
            $coupon->save();
            return redirect()->route('admin_coupon_index')->with('success', 'Kupon başarıyla güncellendi');
        } catch (Exception $exception) {
            return redirect()->route('admin_coupon_edit', $request->id)->withErrors($exception->getMessage());
        }
    }

    public function create()
    {
        $statuses = CouponStatus::all();
        return view('admin.coupon.create')->with([
            'statuses' => $statuses
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validations();
            Coupon::create([
                'code' => $request->input('code'),
                'discount' => $request->input('discount'),
                'min_purchase' => $request->input('min_purchase'),
                'usage_limit' => $request->input('usage_limit'),
                'usage_date_start' => $request->input('usage_date_start'),
                'usage_date_end' => $request->input('usage_date_end'),
                'status' => $request->input('status'),
            ]);
            return redirect()->route('admin_coupon_index')->with('success', 'Kupon başarıyla eklendi');
        } catch (Exception $exception) {
            return redirect()->route('admin_coupon_create')->withErrors($exception->getMessage());
        }
    }
}
