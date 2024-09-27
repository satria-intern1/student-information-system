<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    public function showSettingsForm()
    {
        $user = Auth::user();
        $userData = null;
       

        //retrieve data based on role
        switch ($user->role) {
            case 'kaprodi':
                $userData = $user->kaprodi;
                break;
            case 'dosen':
                $userData = $user->dosen;
                break;
            case 'mahasiswa':
                $userData = $user->mahasiswa;

                break;
            default:
            $userData = null;


        }
        

        return view('user.settings', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
        ]);
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->username = $request['username'];
        $user->save();

        return redirect()->back()->with('success', 'Username berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        //check if current password is correct
        if (!Hash::check($request['current_password'], $user['password'])) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        $user['password'] = Hash::make($request['new_password']);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
