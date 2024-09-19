<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // mahasiswa
        // class name, class capacity
        // lecturer name and email
        // //

        // lecturer
        // class name, class capacity,
        // student that attach, with their email and nim ?
        // lecturer name that attach with their email

        // kaprodi
        // class name, class capacity,
        // lecturer that teach, with their email,
        // student that attach, with their email and nim


        $user = auth()->user();
        $userData = null;

        $classes = Kelas::all();
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


        return view('kelasList', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'classes' => $classes,
        ]);
    }

    public function formtable()
    {
        $user = auth()->user();
        $userData = null;

        $classes = Kelas::all();
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


        return view('kelasEdit', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'classes' => $classes,
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
        // dump($request['name']);
        // dump($request['capacity']);

        $validatedData = $request->validate([
            'name' => ['required', 'min:1'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        Kelas::Create($validatedData);

 
        return redirect(route('kelas.edit'));

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
    
        return redirect()->route('kelas.edit')->with('success', 'Class updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            return redirect()->route('kelas.edit')->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.edit')->with('error', 'Failed to delete class. ' . $e->getMessage());
        }
    }
}
