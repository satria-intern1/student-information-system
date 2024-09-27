<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif


    <div class="flex justify-center flex-wrap">

        <div class="border-l-8 border-indigo-500 max-w-sm w-full  bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">{{ $user->role }}</div>
                <h2 class="block mt-1 text-lg leading-tight font-medium text-black">{{ $userData['name'] }}</h2>
                <div class="mt-2 text-gray-500">
                    <template x-if="{{ $user->role == 'kaprodi' || $user->role == 'dosen' }}">
                        <div>
                            <p><span class="font-semibold">Kode Dosen:</span> <span x-text="'{{ $userData['kode_dosen'] }}'"></span></p>
                            <p><span class="font-semibold">NIP:</span> <span x-text="'{{ $userData['nip'] }}'"></span></p>
                        </div>
                    </template>
                    <template x-if="{{ $user->role == 'mahasiswa' }}">
                        <div>
                            <p><span class="font-semibold">NIM:</span> <span x-text="'{{ $userData['nim'] }}'"></span></p>
                            <p><span class="font-semibold">Tempat Lahir:</span> <span x-text="'{{ $userData['tempat_lahir'] }}'"></span></p>
                            <p><span class="font-semibold">Tanggal Lahir:</span> <span x-text="'{{ $userData['tanggal_lahir'] }}'"></span></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        @if ($user['role'] != 'kaprodi')
        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Kelas Terdaftar</div>

                @if ($class != 'none')
                <h2 class=" block text-2xl leading-tight font-medium text-black">{{ $class->name }}</h2>
                <div class="text-gray-500 mb-4 mt-1">
                    <p><span class="font-semibold">Dosen Wali:</span> <span x-text="'{{ $class->dosen->name }}'"></span></p>
                    <p><span class="font-semibold">Email:</span> <span x-text="'{{ $class->dosen->user->email }}'"></span></p>

                </div>
    
                @else
                <h2 class=" block text-2xl leading-tight font-medium text-black">Tidak Terdaftar</h2>
                @endif

                <a href="{{route('kelas.list')}}">
                    <button class="my-4 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Lihat Semua Kelas
                    </button>
                </a>
                @if ($user['role'] == 'dosen' && $class != 'none')
                <a href="{{ route('mahasiswa.editkelas', $userData['kelas_id']) }}">
                    <button class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Manajemen Kelas
                    </button>
                </a>
                @endif
               
            </div>
        </div>
        @endif

        @if($user['role'] == 'mahasiswa' && $class != 'none')
        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Status Pengajuan Edit Data</div>
                <h2 class=" block text-2xl leading-tight font-medium text-black">
                    @if ($userData['edit'])
                        Diizinkan
    
                    @elseif ($userData->requestletter)
                        Dalam List Tunggu
                    @else
                        Tidak Mengajukan
                    @endif

                </h2>
                <a href="{{ route('mahasiswa.getProfile') }}">
                    <button class="my-4 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Edit Profil
                    </button>
                </a>
                <a href="{{ route('reqletter.form') }}">
                    <button class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Buat Pengajuan
                    </button>
                </a>
            </div>
        </div>
        @endif

        @if($user['role'] == 'dosen' && $class != 'none')
        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Permintaan Edit Data</div>
                <h2 class=" block text-2xl leading-tight font-medium text-black">
                    {{ count($class->requestletters)}}

                </h2>
                <a href="{{ route('reqletter.index', $userData['kelas_id']) }}">
                    <button class="my-4 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Lihat Permintaan
                    </button>
                </a>
            </div>
        </div>
        @endif

        @if ($user['role'] != 'kaprodi')
        <div class="border-l-8 border-indigo-500 max-w-sm w-full  bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Informasi Kaprodi</div>
                <h2 class="block mt-1 text-lg leading-tight font-medium text-black">{{ $kaprodiData['name'] }}</h2>
                <div class="mt-2 text-gray-500">

                    <p><span class="font-semibold">Email:</span> {{ $kaprodiData['email'] }}</p>
                 
                </div>
            </div>
        </div>
        @endif

        @if ($user['role'] == 'kaprodi')
        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Jumlah Kelas</div>

                <h2 class=" block text-2xl leading-tight font-medium text-black">{{$classData['jumlah']}}</h2>
                <div class="text-gray-500 mb-4 mt-1">
                    <p><span class="font-semibold">Seluruh Total Kapasitas:</span> {{$classData['totalKapasitas']}}</p>
                </div>
    
                <a href="{{ route('kelas.edit') }}">
                    <button class="my-1 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Manajemen Kelas
                    </button>
                </a>
               
            </div>
        </div>

        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Data Dosen</div>
                <div class="text-gray-500 mb-4 mt-1">
                    <p><span class="font-semibold">Jumlah Dosen:</span> {{$dosenData['totalDosen']}}</p>
                    <p><span class="font-semibold">Jumlah Dosen Wali:</span> {{$dosenData['totalDosenWali']}}</p>

                </div>
    
                <a href="{{ route('dosen.edit') }}">
                    <button class="my-1 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Manajemen Dosen
                    </button>
                </a>
               
            </div>
        </div>

        <div class="border-l-8 border-indigo-500 max-w-sm w-full bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
            <div class="p-6 align-middle h-full">
                <div class="uppercase tracking-wide text-md text-indigo-500 font-semibold mb-1">Data Mahasiswa</div>
                <div class="text-gray-500 mb-4 mt-1">
                    <p><span class="font-semibold">Total Mahasiswa:</span> {{$mahasiswaData['totalMahasiswa']}}</p>
                    <p><span class="font-semibold">Mahasiswa tanpa kelas:</span> {{$mahasiswaData['mahasiswaNoKelas']}}</p>

                </div>
    
                <a href="{{ route('mahasiswa.displayForm') }}">
                    <button class="my-1 sm:mb-0 mr-2 text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Manajemen Mahasiswa
                    </button>
                </a>
               
            </div>
        </div>


        @endif

        
            
        
        


    </div>

    
    
</x-layout>
