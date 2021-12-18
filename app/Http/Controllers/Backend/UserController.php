<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserPasswordUpdateRequest;
use Hash;
use Route;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index', [
            'title' => 'User Table',

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
                    .'" class="detail btn btn-info btn-sm">detail</a> <a href="'.route('admin.user.edit', ['slug' => $user->profile->slug]).'" class="edit btn btn-warning btn-sm">Edit</a> <button class="delete btn btn-danger btn-sm" data-route="'.route('admin.user.delete', ['slug' => $user->profile->slug]).'">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        // }
    }
    public function store(UserCreateRequest $request)
    {
        // dd($request);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'telegram_id' => $request->telegram_id,
            'remember_token' => $request->remember_token,
        ]);
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        return redirect(route('admin.profile.create', [$user]));
    }
    public function create()
    {
        return view('backend.user.create', [
            'title' => 'User Create',
        ]);
    }
    public function show($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();

        return view('backend.user.show', [
            'title' => 'User Detail',

            'userDetail' => $profile->user,
        ]);
    }
    public function update(UpdateUserRequest $request)
    {
        $profile = Profile::where('slug', $request->slug)->firstOrFail();
        // dd($request);
        DB::transaction(function () use ($profile, $request) {
            $profile->update([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'district' => $request->district,
                'province' => $request->province,
                'state' => $request->state,
                'post_code' => $request->postCode,
            ]);
            $profile->user->update([
                'status' => $request->status,
                'telegram_id' => $request->telegramID,
                'email' => $request->email,
            ]);
        });
        return redirect(route('admin.user.show', ['slug' => $request->slug]))->with('edit', 'Edit Profile Successfully!');
    }
    public function updatePassword(UserPasswordUpdateRequest $request)
    {
        // dd($request);
        $profile = Profile::where('slug', $request->slug)->firstOrFail();
        $password = Hash::make($request->password);
        $profile->user->update(['password' => $password]);
        return redirect(route('admin.user.edit', ['slug' => $request->slug]))->with('updatePassword', 'Edit Password Successfully!');
    }
    public function edit($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        $user = User::findOrFail($profile->user_id);

        return view('backend.user.edit', [
            'title' => 'User Detail',

            'userDetail' => $user,
        ]);
    }
    public function delete($slug)
    {
        $profile = Profile::where('slug', $slug)->firstOrFail();
        $user = $profile->user;
        $profile->delete();
        $user->delete();
        alert()->success('success', 'User is Deleted successfully.');
        return response(route('admin.user.index'));
    }
}
