<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index', [
            'title' => 'User Table',
            'user' => Auth::user()
        ]);
    }
    public function userListDataTable(Request $request)
    {
        // if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (User $user) {
                    $btn = '<a href="'.route('admin.user.show', ['slug' => $user->profile->slug])
                    .'" class="detail btn btn-info btn-sm">detail</a> <a href="'.route('admin.user.edit', ['slug' => $user->profile->slug]).'" class="edit btn btn-warning btn-sm">Edit</a> <a href="'.route('admin.user.delete', ['slug' => $user->profile->slug]).'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
    }
    public function show($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        $user = User::findOrFail($profile->user_id);

        return view('backend.user.show', [
            'title' => 'User Detail',
            'user' => Auth::user(),
            'userDetail' => $user,
        ]);
    }
    public function edit($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        $user = User::findOrFail($profile->user_id);

        return view('backend.user.edit', [
            'title' => 'User Detail',
            'user' => Auth::user(),
            'userDetail' => $user,
        ]);
    }
    public function delete($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        $user = User::findOrFail($profile->user_id);

        return view('backend.user.delete', [
            'title' => 'User Detail',
            'user' => Auth::user(),
            'userDetail' => $user,
        ]);
    }
}
