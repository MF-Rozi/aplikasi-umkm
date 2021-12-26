<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(3);

        return view('frontend.home.index', [
            'products' => $product,
        ]);
    }
    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }
    public function notFound()
    {
        return view('frontend.home.404');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('frontend.home.profile', [
            'user' => $user,
        ]);
    }
    public function profileUpdate(Request $request)
    {
        $profile = Auth::user()->profile()->firstOrFail();
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'district' => 'required',
            'province' => 'required',
            'state' => 'required',
            'postCode' => 'nullable',
            'status' => 'required',
            'telegramID' => 'nullable',
            'email' => 'required'
        ]);
        // dd($profile);
        DB::transaction(function () use ($profile, $validated) {
            $profile->update([
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'address1' => $validated['address1'],
                'address2' => $validated['address2'],
                'district' => $validated['district'],
                'province' => $validated['province'],
                'state' => $validated['state'],
                'post_code' => $validated['postCode'],
            ]);
            $profile->user->update([
                'status' => $validated['status'],
                'telegram_id' => $validated['telegramID'],
                'email' => $validated['email'],
            ]);
        });
        return redirect(Route('frontend.home.profile'))->with('success', 'Profile Updated Successfully');
    }
    public function passwordUpdate(Request $request)
    {
        $profile = Auth::user()->profile()->firstOrFail();
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $password = Hash::make($validated['password']);
        $profile->user->update(['password' => $password]);
        Alert::success('Password Update', $profile->slug.' Password Updated Successfully');
        Auth::logout();
        return redirect(Route('login'));
    }
}
