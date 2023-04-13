<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function destroy(Request $request)
    {
        try {
            $productImage = ProductImage::find($request->id);
            File::delete($productImage->path);
            $productImage->delete();
            return response()->json(['message' => 'Fotoğraf silindi']);
        } catch (Exception $exception) {
            return response()->json(['message' => 'Fotoğraf silinirken bir hata oluştu', 'error_message' => $exception->getMessage()], $exception->getCode() ?: 400);
        }

    }
}
