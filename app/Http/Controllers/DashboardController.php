<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kaprodi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
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


        return view('dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
        ]);
    }

    public function displayProfile() {

        $user = auth()->user();
        $userData = null;

        //retrieve data based on role
        switch ($user->role) {
            case 'kaprodi':
                $userData = $user->kaprodi;
                break;
            case 'dosen':
                $userData = $user->dosen;
                break;
            default:
            $userData = null;
        }       
        
        return view('profile', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
        ]);
    }


}
