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
        //
        $user = auth()->user();

        return view('dashboard',[
            'title' => 'Dashboard',
            'role' => $user,
         ]);

    }
}
