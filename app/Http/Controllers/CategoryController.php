<?php

namespace App\Http\Controllers;

use App\Http\Validators\Category\CategoryValidator;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Exception;

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
}
