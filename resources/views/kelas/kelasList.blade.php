<x-layout>

    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen')
    <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
@endif




    @foreach ($classes as $class )
    {{-- class info--}}
    <div x-data="{ openlist: false }" 
        class=" bg-white rounded-2xl shadow-md  m-4"
        :class="openlist ? 'container lg:max-w-6xl' : 'max-w-md md:max-w-2xl mr-auto'">
        <div class="px-4 py-3 flex justify-between">
            <div>
                <div @click="openlist = !openlist"
               
                    class="text-lg uppercase tracking-wide text-md text-blue-600 font-semibold">
                    <svg class="w-3 h-2 inline -translate-y-0.5" :class="{'rotate-180': openlist}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                    {{ $class->name }}

                </div>
                <div class="mt-2 text-gray-500">
                    <div>
                        <p><span class="font-semibold">Nama Dosen: </span> <a href="">{{ $class->dosen->name ??'none'}}</a></p>
                        <p><span class="font-semibold">Email: </span> <a href="mailto:{{ $class->dosen->user->email ?? ' '}}">{{ $class->dosen->user->email ?? 'none' }}</a></p>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="mb-2">
                    <p class="text-sm text-gray-600">Capacity</p>
                    <p class="font-semibold text-gray-800">{{ $class['jumlah'] }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total student</p>
                    <p class="font-semibold text-gray-800">{{ count($class->mahasiswas)}}</p>
                </div>
            </div>
        </div>
        <div x-show="openlist" 
            x-transition:enter="transition duration-600"
            x-transition:enter-start="opacity-0 "
            x-transition:enter-end="opacity-100 "
            x-transition:leave="transition duration-300"
            x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0 "
            class=" overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                            {{-- <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a> --}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Student Name
                            {{-- <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a> --}}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                nim
                                {{-- <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                </svg></a> --}}
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Email
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($class->mahasiswas as $mahasiswa)
                    <tr class="bg-white border-b  ">
                        <td class="px-6 py-4">
                            {{ $loop->iteration}}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $mahasiswa->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $mahasiswa->nim }}
    
                        </td>
                        <td class="px-6 py-4">
                            {{ $mahasiswa->user->email }}
    
                        </td>
                    </tr>
                    @endforeach
    
                </tbody>
            </table>
        </div>
    
    </div>
        
    

    @endforeach


    
    
</x-layout>
