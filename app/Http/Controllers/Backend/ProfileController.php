<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileCreateRequest;

class ProfileController extends Controller
{
    public function create($id)
    {

        $users = User::findOrFail($id);
        return view('backend.profile.create', [
            'title' => 'Profile Create for '.$users->email,
            'user' => $users,

        ]);
    }
    public function store(ProfileCreateRequest $request)
    {
        $profile = Profile::create([
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'district' => $request->district,
            'province' => $request->province,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'photo_profile' => $request->photo_profile,

        ]);
        return redirect(route('admin.user.index'))->with('success', 'User And Profile Created!');
    }
}
