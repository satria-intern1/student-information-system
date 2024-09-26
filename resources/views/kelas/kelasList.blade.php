<x-layout>

    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif




    <section class="grid xl:grid-cols-2"> 
    
        @foreach ($classes as $class )
        <!-- class info-->
        <div class=" bg-white rounded-2xl shadow-md  m-4">
            <div class="px-4 py-3 flex justify-between">
                <div>
                    <div class="text-lg uppercase tracking-wide text-md text-blue-600 font-semibold">
                        
                        {{ $class->name }}

                    </div>
                    <div class="mt-2 text-gray-500">
                        <div>
                            <p><span class="font-semibold">Dosen Wali: </span> <a href="">{{ $class->dosen->name ??'none'}}</a></p>
                            <p><span class="font-semibold">Email: </span> <a href="mailto:{{ $class->dosen->user->email ?? ' '}}">{{ $class->dosen->user->email ?? 'none' }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="mb-2">
                        <p class="text-sm text-gray-600">Kapasitas</p>
                        <p class="font-semibold text-gray-800">{{ $class['jumlah'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Mahasiswa</p>
                        <p class="font-semibold text-gray-800">{{ count($class->mahasiswas)}}</p>
                    </div>
                </div>
            </div>
            
        
        </div> 
            
        

        @endforeach

    </section>
    
    
</x-layout>
