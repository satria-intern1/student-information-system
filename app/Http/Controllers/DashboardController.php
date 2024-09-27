<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $userData = null;
        $class = null;

        $infoKaprodi = User::where('role', 'kaprodi')->first();

        $kaprodiEmail = $infoKaprodi['email'];
        $KaprodiName = $infoKaprodi->kaprodi->name;

        //retrieve data based on role
        switch ($user->role) {
            case 'kaprodi':
                $userData = $user->kaprodi;
                break;
            case 'dosen':
                $userData = $user->dosen;
                $class = $userData->kelas;
                break;
            case 'mahasiswa':
                $userData = $user->mahasiswa;
                $class = $userData->kelas;

                break;
            default:
            $userData = null;
            $class = null;

        }

        $jumlahKelas = count(Kelas::get());
        $totalKapasitas = Kelas::sum('jumlah');

        $totalDosen = count(Dosen::get());
        $totalDosenWali = count(Dosen::whereNotNull('kelas_id')->get());

        $totalMahasiswa = count(Mahasiswa::get());
        $mahasiswaNoKelas = count(Mahasiswa::whereNull('kelas_id')->get());

        return view('dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'userData' => $userData,
            'class' => ($class ?? 'none'),
            'kaprodiData' => [
                'email' => $kaprodiEmail,
                'name' => $KaprodiName,
            ],
            'classData' => [
                'jumlah' => $jumlahKelas,
                'totalKapasitas' => $totalKapasitas,
            ],
            'dosenData' => [
                'totalDosen' => $totalDosen,
                'totalDosenWali' => $totalDosenWali,
            ],
            'mahasiswaData' => [
                'totalMahasiswa' => $totalMahasiswa,
                'mahasiswaNoKelas' => $mahasiswaNoKelas,
            ],
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
            'title' => 'Profil User',
            'user' => $user,
            'userData' => $userData,
        ]);
    }


}
