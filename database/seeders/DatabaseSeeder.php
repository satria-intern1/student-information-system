<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    
// Akun Representative:

// Kaprodi
// username: kaprodi1
// email: kaprodi1@lecturer.university.ac.id
// password: password

// Dosen Wali Kelas A
// username: dosen1
// email: dosen1@lecturer.university.ac.id
// password: password

// Dosen Wali Kelas B
// username: dosen2
// email: dosen2@lecturer.university.ac.id
// password: password

// Dosen Biasa
// username: dosen3
// email: dosen3@lecturer.university.ac.id
// password: password

// Mahasiswa Kelas A
// username: mahasiswa1
// email: mahasiswa1@student.university.ac.id
// password: password

// Mahasiswa Kelas B
// username: mahasiswa11
// email: mahasiswa11@student.university.ac.id
// password: password

public function run()
{
    // Seed Users
    $userIds = $this->seedUsers();

    // Seed Kelas
    $kelasIds = $this->seedKelas();

    // Seed Kaprodi
    $this->seedKaprodis($userIds);

    // Seed Mahasiswas
    $this->seedMahasiswas($userIds, $kelasIds);

    // Seed Dosens
    $this->seedDosens($userIds, $kelasIds);
}

private function seedUsers()
{
    $users = [
        // Kaprodi
        [
            'username' => 'kaprodi1',
            'email' => 'kaprodi1@lecturer.university.ac.id',
            'password' => Hash::make('password'),
            'role' => 'kaprodi',
        ],
        // Dosen (5 orang)
        ['username' => 'dosen1', 'email' => 'dosen1@lecturer.university.ac.id', 'password' => Hash::make('password'), 'role' => 'dosen'],
        ['username' => 'dosen2', 'email' => 'dosen2@lecturer.university.ac.id', 'password' => Hash::make('password'), 'role' => 'dosen'],
        ['username' => 'dosen3', 'email' => 'dosen3@lecturer.university.ac.id', 'password' => Hash::make('password'), 'role' => 'dosen'],
        ['username' => 'dosen4', 'email' => 'dosen4@lecturer.university.ac.id', 'password' => Hash::make('password'), 'role' => 'dosen'],
        ['username' => 'dosen5', 'email' => 'dosen5@lecturer.university.ac.id', 'password' => Hash::make('password'), 'role' => 'dosen'],
    ];

    // Mahasiswa (20 orang)
    for ($i = 1; $i <= 20; $i++) {
        $users[] = [
            'username' => "mahasiswa{$i}",
            'email' => "mahasiswa{$i}@student.university.ac.id",
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ];
    }

    $userIds = [];
    foreach ($users as $user) {
        $userIds[] = DB::table('users')->insertGetId($user);
    }

    return $userIds;
}

private function seedKelas()
{
    $kelas = [
        ['name' => 'Kelas A', 'jumlah' => 10],
        ['name' => 'Kelas B', 'jumlah' => 10],
    ];

    $kelasIds = [];
    foreach ($kelas as $class) {
        $kelasIds[] = DB::table('kelas')->insertGetId($class);
    }

    return $kelasIds;
}

private function seedMahasiswas($userIds, $kelasIds)
{
    $mahasiswas = [];
    $mahasiswaUserIds = array_slice($userIds, 6); // Skip kaprodi and dosen user IDs

    for ($i = 0; $i < 20; $i++) {
        $mahasiswas[] = [
            'user_id' => $mahasiswaUserIds[$i],
            'kelas_id' => $kelasIds[floor($i / 10)], // First 10 to Kelas A, next 10 to Kelas B
            'nim' => 11111111 + $i,
            'name' => "Mahasiswa " . ($i + 1),
            'tempat_lahir' => ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang'][rand(0, 4)],
            'tanggal_lahir' => date('Y-m-d', strtotime('-' . (18 + rand(0, 5)) . ' years')),
        ];
    }

    foreach ($mahasiswas as $mahasiswa) {
        DB::table('mahasiswas')->insert($mahasiswa);
    }
}

private function seedDosens($userIds, $kelasIds)
{
    $dosens = [
        // Dosen Wali (2 orang)
        [
            'user_id' => $userIds[1],
            'kelas_id' => $kelasIds[0],
            'kode_dosen' => 22222221,
            'nip' => 22221111,
            'name' => 'Dosen Wali A',
        ],
        [
            'user_id' => $userIds[2],
            'kelas_id' => $kelasIds[1],
            'kode_dosen' => 22222222,
            'nip' => 22221112,
            'name' => 'Dosen Wali B',
        ],
        // Dosen Biasa (3 orang)
        [
            'user_id' => $userIds[3],
            'kelas_id' => null,
            'kode_dosen' => 22222223,
            'nip' => 22221113,
            'name' => 'Dosen Biasa 1',
        ],
        [
            'user_id' => $userIds[4],
            'kelas_id' => null,
            'kode_dosen' => 22222224,
            'nip' => 22221114,
            'name' => 'Dosen Biasa 2',
        ],
        [
            'user_id' => $userIds[5],
            'kelas_id' => null,
            'kode_dosen' => 22222225,
            'nip' => 22221115,
            'name' => 'Dosen Biasa 3',
        ],
    ];

    foreach ($dosens as $dosen) {
        DB::table('dosens')->insert($dosen);
    }
}

private function seedKaprodis($userIds)
{
    $kaprodis = [
        [
            'user_id' => $userIds[0], // Menggunakan index 0 untuk kaprodi
            'kode_dosen' => 10000001,
            'nip' => 12222221,
            'name' => 'Kaprodi Teknik Informatika',
        ],
    ];

    foreach ($kaprodis as $kaprodi) {
        DB::table('kaprodis')->insert($kaprodi);
    }
}
}
