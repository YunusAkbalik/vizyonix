<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\FileUpload;
use App\Http\Validators\ProductValidator;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ProductValidator;

    public function index()
    {
        $products = Product::with('image')->with('category')->get();
        return view('admin.product.index')->with([
            'products' => $products,
        ]);
    }

    public function create(): Factory|View|Application
    {
        $categories = Category::all();
        return view('admin.product.create')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validations();
            $job = new FileUpload();
            $job->setMimeTypes(['png', 'jpg', 'jpeg']);
            $job->setPath('images/product');
            $job->setRequestFileName('main_image');
            if (!$job->save()) {
                throw new Exception($job->getErrorMessage());
            }
            $product = Product::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'main_image' => $job->getFilePaths()[0],
                'on_sale' => $request->input('on_sale') ? true : false,
            ]);
            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $request->input('category_id')
            ]);
            $job->setRequestFileName('files');
            if (!$job->save()) {
                throw new Exception($job->getErrorMessage());
            }
            foreach ($job->getFilePaths() as $path) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path
                ]);
            }
            DB::commit();
            return redirect()->route('admin_product_index')->with('success', 'Ürün oluşturuldu');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin_product_create')->withErrors($exception->getMessage());
        }
    }
}
