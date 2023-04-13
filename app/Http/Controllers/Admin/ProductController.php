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
use Illuminate\Support\Facades\File;

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
                'link' => $request->input('link'),
            ]);
            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $request->input('category_id')
            ]);
            if (request()->file('files')) {
                $productImageUploadJob = new FileUpload();
                $productImageUploadJob->setMimeTypes(['png', 'jpg', 'jpeg']);
                $productImageUploadJob->setPath('images/product');
                $productImageUploadJob->setRequestFileName('files');
                if (!$productImageUploadJob->save()) {
                    throw new Exception($productImageUploadJob->getErrorMessage());
                }
                foreach ($productImageUploadJob->getFilePaths() as $path) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin_product_index')->with('success', 'Ürün oluşturuldu');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin_product_create')->withErrors($exception->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $product = Product::with('image')->with('category')->where('id', $request->id)->first();
            $categories = Category::all();
            if (!$product)
                throw new  Exception('Ürün bulunamadı');
            return view('admin.product.edit')->with([
                'product' => $product,
                'categories' => $categories,
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin_product_index')->withErrors($exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->validations();
            $product = Product::find($request->product_id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->on_sale = $request->input('on_sale') ? true : false;
            $product->link = $request->link;
            $job = new FileUpload();
            $job->setMimeTypes(['png', 'jpg', 'jpeg']);
            $job->setPath('images/product');
            if (request()->file('main_image')) {
                $job->setRequestFileName('main_image');
                if (!$job->save()) {
                    throw new Exception($job->getErrorMessage());
                }
                File::delete($product->main_image);
                $product->main_image = $job->getFilePaths()[0];
            }
            if (request()->file('files')) {
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
            }
            $product->save();
            DB::commit();
            return redirect()->route('admin_product_edit', ['id' => $request->product_id])->with('success', 'Ürün başarıyla güncellendi');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin_product_edit', ['id' => $request->product_id])->withErrors($exception->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);
            File::delete($product->main_image);
            $productImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($productImages as $image) {
                File::delete($image->path);
            }
            Product::destroy($request->id);
            return response()->json(['message' => 'Ürün başarıyla silindi']);
        } catch (Exception $exception) {
            return response()->json(['message' => 'Ürünü silinirken bir hata oluştu', 'error_message' => $exception->getMessage()], $exception->getCode() ?: 400);
        }
    }
}
