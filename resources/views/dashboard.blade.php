<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif




    <div class="max-w-md mr-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
        <div class="p-8">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-1">{{ $user->role }}</div>
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

    
    
</x-layout>
