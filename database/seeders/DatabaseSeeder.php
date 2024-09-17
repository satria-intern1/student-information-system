<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed Users
        $userIds = $this->seedUsers();

        // Seed Kelas
        $kelasIds = $this->seedKelas();

        // Seed Mahasiswas
        $this->seedMahasiswas($userIds, $kelasIds);

        // Seed Dosens
        $this->seedDosens($userIds, $kelasIds);

        // Seed Kaprodi
        $this->seedKaprodis($userIds);
    }

    private function seedUsers()
    {
        $users = [
            [//index 0 
                'username' => 'kaprodi1',
                'email' => 'kaprodi1@example.com',
                'password' => Hash::make('password'),
                'role' => 'kaprodi',
            ],
            [//index 1
                'username' => 'dosen1',
                'email' => 'dosen1@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ],
            [
                'username' => 'dosen2',
                'email' => 'dosen2@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ],
            [//index 3
                'username' => 'dosen3',
                'email' => 'dosen3@example.com',
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ],
            [//index 4 
                'username' => 'mahasiswa1',
                'email' => 'mahasiswa1@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ],
            [
                'username' => 'mahasiswa2',
                'email' => 'mahasiswa2@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ],
            [
                'username' => 'mahasiswa3',
                'email' => 'mahasiswa3@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ],
            [//index 7
                'username' => 'mahasiswa4',
                'email' => 'mahasiswa4@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ],
            
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        return DB::table('users')->pluck('id');
    }

    private function seedKelas()
    {
        $kelas = [
            [
                'name' => 'Kelas A',
                'jumlah' => 30,
            ],
            [
                'name' => 'Kelas B',
                'jumlah' => 25,
            ],
            // Add more kelas as needed
        ];

        foreach ($kelas as $class) {
            DB::table('kelas')->insert($class);
        }

        return DB::table('kelas')->pluck('id');
    }

    private function seedMahasiswas($userIds, $kelasIds)
    {
        $mahasiswas = [
            [
                'user_id' => $userIds[4], // Assuming the 5th user is a mahasiswa
                'kelas_id' => $kelasIds[0], // Assuming the first kelas
                'nim' => 11111111,
                'name' => 'Si Ketua BEM',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-01-01',
            ],
            [
                'user_id' => $userIds[5],
                'kelas_id' => $kelasIds[0], 
                'nim' => 11111112,
                'name' => 'Si Ranking Satu',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-01-01',
            ],
            [
                'user_id' => $userIds[6], // Assuming the 7th user is a mahasiswa
                'kelas_id' => $kelasIds[1], // Assuming the 2nd kelas
                'nim' => 11111113,
                'name' => 'Kang Bolos',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2000-01-01',
            ],
            [
                'user_id' => $userIds[7], 
                'kelas_id' => $kelasIds[1], 
                'nim' => 11111114,
                'name' => 'Mahasiswa Abadi',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2001-02-15',
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            DB::table('mahasiswas')->insert($mahasiswa);
        }
    }

    private function seedDosens($userIds, $kelasIds)
    {
        $dosens = [
            [
                'user_id' => $userIds[1], 
                'kelas_id' => $kelasIds[0], //assuming in first class 
                'kode_dosen' => 22222221,
                'nip' => 22221111,
                'name' => 'Si Dosen Killer',
                
            ],
            [
                'user_id' => $userIds[2],
                'kelas_id' => $kelasIds[1], //assuming in 2nd class  
                'kode_dosen' => 22222222,
                'nip' => 22221112 ,
                'name' => 'Si Dosen Santai',
                
            ],
            [
                'user_id' => $userIds[3],
                                            //assuming in dont have class  
                'kode_dosen' => 22222223,
                'nip' => 22221113 ,
                'name' => 'Si Dosen Sesat',
                
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
                'user_id' => $userIds[0], 
                'kode_dosen' => 10000001,
                'nip' => 12222221,
                'name' => 'Si Pebisnis Ulung',
                
            ],
         
        ];

        foreach ($kaprodis as $dosen) {
            DB::table('kaprodis')->insert($dosen);
        }
    }
}
