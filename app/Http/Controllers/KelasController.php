<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();
        $userData = null;

        $classes = Kelas::get();
        // dd($classes);
        // Kelas::all()->mahasiswa->where())

        // retrieve data based on role
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


        return view('kelas.kelasList', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'classes' => $classes,
        ]);
    }

    public function formtable()
    {
        $user = auth()->user();
        $userData = $user->kaprodi;

        $classes = Kelas::all();
        


        return view('kelas.kelasEdit', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'classes' => $classes,
        ]);
    }

    

    /**
     * Show the Plotting Classroom view
     */
    public function displayFillKelas($classId)
    {
        $user = auth()->user();
        $userData = $user->kaprodi;

        // Eager load relationships
        $class = Kelas::with([
            'mahasiswas',
            'dosen' => function ($query) {
                $query->limit(1);
            },
        ])->findOrFail($classId);

        $studentsClass = $class->mahasiswas;
        $remainingStd = Mahasiswa::whereNull('kelas_id')->get();


        $lecturerClass = $class->dosen ? $class->dosen->first() : 'none'; 
        $lecturers = Dosen::all();

        return view('kelas.kelasFill', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'class' => $class,
            'studentsClass' => $studentsClass,
            'remainingStudents' => $remainingStd,
            'lecturerClass' => $lecturerClass,
            'lecturers' => $lecturers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dump($request['name']);
        // dump($request['capacity']);

        $validatedData = $request->validate([
            'name' => ['required', 'min:1'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        Kelas::Create($validatedData);

 
        return back()->with('success', 'Lecturer added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:1'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);
    
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'name' => $validatedData['name'],
            'jumlah' => $validatedData['jumlah'],
        ]);
    
        return back()->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return back()->with('success', 'Class deleted successfully.');

    }
}
