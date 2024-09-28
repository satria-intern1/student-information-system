<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = auth()->user();
        $userData = null;
        $students = Mahasiswa::with('kelas');

        $totalStudent = $students->count();
        $studentsNoClass = Mahasiswa::whereNull('kelas_id')->count();

        $query = $request['query'];
        if ($query) {
            $students = $students
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('tempat_lahir', 'LIKE', "%{$query}%")
                ->orWhere('nim', 'LIKE', "{$query}%");
        }

        $students = $students->get();

        

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


        return view('mahasiswa.mahasiswaList', [
            'title' => 'Mahasiswa List',
            'user' => $user,
            'userData' => $userData,
            'students' => $students,
            'totalStudent' => $totalStudent,
            'studentsNoClass' => $studentsNoClass
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
            'nim' => ['required', 'integer', 'min:0',],
            'tempat_lahir' => ['required', 'string', ],
            'tanggal_lahir' => ['required', 'date', ],
         ]);
            // Split the name and take the first two words
            $splitNameToArray = explode(' ', $validatedData['name']);
            $firstTwoWords = implode(' ', array_slice($splitNameToArray, 0, 2));

            // Generate username and email
            $username = Str::slug($firstTwoWords);
            $email = $username . '@student.university.ac.id';


            
            //Create a new user
            $user = User::create(
                [
                    'username' => $username,
                    'email' => $email,
                    'password'=> Hash::make('password'),
                    'role' => 'mahasiswa',
                ]
            );

            // Create a new student

        Mahasiswa::Create(
            [
                'user_id' => $user->id,
                'kelas_id' => null,
                'edit' => false,
                'name' => $validatedData['name'],
                'nim' => $validatedData['nim'],
                'tempat_lahir' => $validatedData['tempat_lahir'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
            ]
        );

 
        return back()->with('success', 'Student added successfully');

    }
    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    public function displayForm()
    {
        $user = auth()->user();
        $userData = $user->kaprodi;

        $studentsClass = Mahasiswa::with(['kelas', 'user'])->get();

        $totalStudents = $studentsClass->count();
        $studentsWithoutClass = $studentsClass->whereNull('kelas_id')->count();


        return view('mahasiswa.mahasiswaManage', [
            'title' => 'Mahasiswa Manajemen',
            'user' => $user,
            'userData' => $userData,
            'students' => $studentsClass,
            'totalStudents' => $totalStudents,
            'studentsWithoutClass' => $studentsWithoutClass,
        ]);
        
    }



    public function formtable($id)
    {
        $user = auth()->user();
        $userData = $user->dosen;
        $class = Kelas::with('mahasiswas')->findOrFail($id);

        return view('mahasiswa.mahasiswaEditKelas', [
            'title' => 'Kelas '. $userData->kelas->name,
            'user' => $user,
            'userData' => $userData,
            'students' => $class->mahasiswas,
            'class' => $class,
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
             'edit' => false,
             'name' => $validatedData['name'],
             'nim' => $validatedData['nim'],
             'tempat_lahir' => $validatedData['tempat_lahir'],
             'tanggal_lahir' => $validatedData['tanggal_lahir'],
 
         ]);
     
         return back()->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $student = Mahasiswa::findOrFail($id);
        $student->delete();

        return back()->with('success', 'Student deleted successfully.');
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

        return back()->with('success', 'Students in Class updated successfully.');
    }

    public function detach($id)
    {
        $student = Mahasiswa::findOrFail($id);
        $student->update([
             'kelas_id' => null, 
         ]);
           

        return back()->with('success', 'Students in Class removed successfully.');
    }

    public function displayReqEdit() {

        $user = auth()->user();
        $userData = $user->mahasiswa;
        
        return view('mahasiswa.mahasiswaProfil', [
            'title' => 'Profil',
            'user' => $user,
            'userData' => $userData,
        ]);
    }

    public function updateEdit(Request $request)
    {
        //
     
         $student = Mahasiswa::findOrFail($request['mahasiswa_id']);
         $student->update([
             'edit' => true, 
         ]);

     
         return back()->with('success', 'Edit permission updated successfully');    }

}
