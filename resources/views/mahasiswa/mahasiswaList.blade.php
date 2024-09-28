<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif
        
    <!-- Table Container -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <header class="p-6 border-b border-t border-gray-200 bg-slate-100">
                <h2 class="text-2xl font-semibold text-gray-900">List Mahasiswa</h2>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-600">Total Mahasiswa
                        <span class="font-semibold text-gray-800">{{ $totalStudent }}</span>
                    </p>
                    <p class="text-sm font-medium text-gray-600">Mahasiswa tanpa kelas
                        <span class="font-semibold text-gray-800">{{ $studentsNoClass }}</span>
                    </p>
                </div>
                <x-search-bar>
                    <x-slot:route>{{ route('mahasiswa.list') }}</x-slot>
                    <x-slot:placeholder>Search</x-slot>
                </x-search-bar>
              </header>
              
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-slate-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>
                        <th scope="col" class="px-6 py-3">NIM</th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Nama Mahasiswa</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Kelas</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Email</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Tempat Lahir</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Tanggal Lahir</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($students->isNotEmpty())

                    @foreach ($students as $student)
                     
                    <tr class="bg-white border-b hover:bg-slate-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <span>{{ $student['nim'] }}</span>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $student['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center {{ !$student->kelas ? 'text-red-500' : '' }}">{{ $student->kelas->name ?? 'not assigned'}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $student->user['email'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $student['tempat_lahir'] }}</span>    
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $student['tanggal_lahir'] }}</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @else
                        <p class="mx-auto font-medium text-md">Tidak ada hasil pencarian</p>
                    @endif
                </tbody>


            </table>
        </div>
</x-layout>