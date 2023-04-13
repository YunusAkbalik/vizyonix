<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Validators\CategoryValidator;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use CategoryValidator;

    public function index(): Factory|View|Application
    {
        $categories = Category::all();
        return view('admin.category.index')->with([
            'categories' => $categories
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validations();
            Category::create([
                'title' => $request->title
            ]);
            return redirect()->route('admin_category_index')->with('success', 'Kategori Oluşturuldu');
        } catch (Exception $exception) {
            return redirect()->route('admin_category_create')->withErrors($exception->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $category = Category::find($request->id);
            if (!$category)
                throw new Exception('Kategori bulunamadı');
            return view('admin.category.edit')->with([
                'category' => $category
            ]);
        } catch (Exception $exception) {
            return redirect()->route('admin_category_index')->withErrors($exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $this->validations();
            $category = Category::find(request()->input('category_id'));
            $category->title = request()->input('title');
            $category->save();
            return redirect()->route('admin_category_index', ['id' => $category->id])->with('success', 'Kategori Güncellendi');
        } catch (Exception $exception) {
            return redirect()->route('admin_category_edit')->withErrors($exception->getMessage());
        }
    }
}
