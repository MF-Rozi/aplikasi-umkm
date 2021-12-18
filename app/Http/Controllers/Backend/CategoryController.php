<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {

        return view('backend.category.index', [
            'title' => 'Categories Table',
            'user' => Auth::user(),
            'categories' => Category::latest()->paginate(3),

        ]);
    }
    public function categoryListDataTable(Request $request)
    {
        // if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Category $category) {
                    $btn = '<a href="'.route('admin.category.show', ['slug' => $category->slug])
                    .'" class="detail btn btn-info btn-sm">detail</a> <a href="'.route('admin.category.edit', ['slug' => $category->slug]).'" class="edit btn btn-warning btn-sm">Edit</a> <a href="'.route('admin.category.delete', ['slug' => $category->slug]).'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
    }
    public function create()
    {
        $categories = Category::all();
        return view('backend.category.create', [
            'title' => 'Create Category',
            'categories' => $categories,
        ]);
    }
    public function store(CreateCategoryRequest $request)
    {
        // dd($request);
        $newCategory = Category::create([
            'name' => $request->name,
            'parent' => $request->parent,
        ]);
        // dd($newCategory);
        return redirect(route('admin.category.index'))->with("success", 'Category Baru '.$newCategory->name.' Berhasil Ditambahkan');
    }
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();


        return view('backend.category.show', [
            'title' => 'Category Detail',
            'user' => Auth::user(),
            'categoryDetail' => $category,
        ]);
    }
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();

        return view('backend.category.edit', [
            'title' => 'Category Edit',
            'user' => Auth::user(),
            'categoryDetail' => $category,
            'categories' => $categories
        ]);
    }
    public function update(UpdateCategoryRequest $request)
    {
        // dd($request);
        $category = Category::find($request->id);
        // dd($category);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent' => $request->parent,
        ]);
    }
    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();


        return view('backend.category.show', [
            'title' => 'Category Detail',
            'user' => Auth::user(),
            'categoryDetail' => $category,
        ]);
    }
}
