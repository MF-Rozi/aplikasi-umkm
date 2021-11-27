<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();


        return view('backend.category.show', [
            'title' => 'User Detail',
            'user' => Auth::user(),
            'categoryDetail' => $category,
        ]);
    }
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();


        return view('backend.category.show', [
            'title' => 'User Detail',
            'user' => Auth::user(),
            'categoryDetail' => $category,
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
