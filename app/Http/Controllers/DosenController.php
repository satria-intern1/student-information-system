<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => ['required', 'string','min:1' , 'max:255'],
            'kode_dosen' => ['required', 'integer', 'min:0', 'digits:10'],
            'nip' => ['required', 'integer', 'min:0', 'digits:18'],
        ]);
        dd($request);
            // Split the name and take the first two words
            $splitNameToArray = explode(' ', $validatedData['name']);
            $firstTwoWords = implode(' ', array_slice($splitNameToArray, 0, 2));

            // Generate username and email
            $username = Str::slug($firstTwoWords);
            $email = $username . ' @university.ac.id';

            // Generate a default password
            $password = $validatedData['kode_dosen'];
            
            //Create a new user

            // Create a new lecturer



        Dosen::Create($validatedData);

 
        return redirect(route('kelas.edit'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    public function formtable()
    {
        $user = auth()->user();
        $userData = $user->kaprodi;

        $lecturers = Dosen::all();



        return view('dosen.dosenEdit', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'lecturers' => $lecturers,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
