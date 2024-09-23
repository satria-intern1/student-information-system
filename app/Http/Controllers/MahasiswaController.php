<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        $userData = null;

        $students = Mahasiswa::all();

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


        return view('mahasiswa.mahasiswaList', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'students' => $students,
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    public function formtable($id)
    {
        $user = auth()->user();
        $userData = $user->dosen;

        // $lecturers = Mahasiswa::where(,)->get();
        $studentsClass = Mahasiswa::where('kelas_id', $id)->get();



        return view('mahasiswa.mahasiswaEdit', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'students' => $studentsClass,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
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
            'nim' => ['required', 'integer', 'min:0',],
            'tempat_lahir' => ['required', 'string', ],
            'tanggal_lahir' => ['required', 'date', ],
         ]);
     
         $student = Mahasiswa::findOrFail($id);
         $student->update([
             'name' => $validatedData['name'],
             'nim' => $validatedData['nim'],
             'tempat_lahir' => $validatedData['tempat_lahir'],
             'tanggal_lahir' => $validatedData['tanggal_lahir'],
 
         ]);
     
         return back()->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }


    public function updateClass(Request $request, $classId)
    {

        $selectedStudents = json_decode($request->input('selected_students'), true);

        DB::transaction(function () use ($selectedStudents, $classId) {
            // all student in this class is null
            Mahasiswa::where('kelas_id', $classId)->update(['kelas_id' => null]);

            // assign the student to this class
            Mahasiswa::whereIn('id', $selectedStudents)->update(['kelas_id' => $classId]);
        });

        return redirect()->back()->with('success', 'Students assignments updated successfully.');
    }

}
