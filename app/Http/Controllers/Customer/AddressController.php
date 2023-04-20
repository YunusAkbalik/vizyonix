<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Validators\AddressValidator;
use App\Models\Address;
use App\Models\Countries;
use App\Models\UserAddress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    use AddressValidator;

    public function store(Request $request)
    {
        try {
            $this->validations();
            DB::beginTransaction();
            $country = Countries::find($request->country);
            $address = Address::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $country->code,
                'country' => $country->name,
                'zip' => $request->input('zip'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);
            UserAddress::create([
                'user_id' => auth()->user()->id,
                'address_id' => $address->id,
            ]);
            DB::commit();
            return response()->json(['message' => 'Address created successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        try {
            UserAddress::where('address_id', $request->id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail()->destroy($request->input('id'));
            return response()->json(['message' => 'Address deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Adress not found"], 500);
        }
    }
}
