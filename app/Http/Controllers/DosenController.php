<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        $userData = null;

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


        $lecturers = Dosen::all();



        return view('dosen.dosenList', [
            'title' => 'DosenList',
            'user' => $user,
            'userData' => $userData,
            'lecturers' => $lecturers,
        ]);


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
            'kode_dosen' => ['required', 'integer', 'min:0',],
            'nip' => ['required', 'integer', 'min:0', ],
        ]);
            // Split the name and take the first two words
            $splitNameToArray = explode(' ', $validatedData['name']);
            $firstTwoWords = implode(' ', array_slice($splitNameToArray, 0, 2));

            // Generate username and email
            $username = Str::slug($firstTwoWords);
            $email = $username . '@lecturer.university.ac.id';

            // Generate default password using kode dosen
            // $password = $validatedData['kode_dosen'];

            
            //Create a new user
            $user = User::create(
                [
                    'username' => $username,
                    'email' => $email,
                    // 'password' => Hash::make($password),
                    'password'=> Hash::make('password'),
                    'role' => 'dosen',
                ]
            );

            // Create a new lecturer

        Dosen::Create(
            [
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'kelas_id' => null,
                'kode_dosen' => $validatedData['kode_dosen'],
                'nip' => $validatedData['nip'],
            ]
        );

 
        return back()->with('success', 'Lecturer added successfully');

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
            'title' => 'Dosen Manajemen',
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
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
           'name' => ['required', 'string','min:1' , 'max:255'],
            'kode_dosen' => ['required', 'integer', 'min:0', ],
            'nip' => ['required', 'integer', 'min:0',],
        ]);
    
        $lecturer = Dosen::findOrFail($id);
        $lecturer->update([
            'name' => $validatedData['name'],
            'kode_dosen' => $validatedData['kode_dosen'],
            'nip' => $validatedData['nip'],

        ]);
    
        return back()->with('success', 'Lecturer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $lecturer = Dosen::findOrFail($id);
        $lecturer->delete();

        return back()->with('success', 'Lecturer deleted successfully.');
    }


    public function updateClass(Request $request, $classId)
    {

        $selectedLecturer = $request['selectedId'];



        // set lecture in this class is null
        Dosen::where('kelas_id', $classId)->update(['kelas_id' => null]);

        // assign the lecture to this class
        if ($selectedLecturer != 'null') {
            Dosen::where('id', $selectedLecturer)->update(['kelas_id' => $classId]);
        }

        return back()->with('success', 'Lecturer in Class updated successfully.');
    }
}
