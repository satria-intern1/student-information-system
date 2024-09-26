<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif
    

    {{-- dosen info
   <div class=" max-w-md bg-white rounded-2xl shadow-md  m-4">
        <div class="px-4 py-3">
                <div class="text-md uppercase tracking-wide  text-blue-600 font-semibold">
                    Lecturer Information
                </div>
                <p class="text-sm font-medium text-gray-600">Total Lecturer 
                    <span class="font-semibold text-gray-800">{{ count($lecturers) }}</span>
                </p>
                <p class="text-sm font-medium text-gray-600">Lecturer with no classroom
                    <span class="font-semibold text-gray-800">{{ count($lecturers->where('kelas_id', null)) ??  '0' }}</span>
                </p>
        </div>
    </div> --}}
        
    <!-- Table Container -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <header class="p-6 border-b border-t border-gray-200 bg-slate-100">
                <h2 class="text-2xl font-semibold text-gray-900">List Dosen</h2>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-600">Total Dosen
                        <span class="font-semibold text-gray-800">{{ count($lecturers) }}</span>
                    </p>
                    <p class="text-sm font-medium text-gray-600">Total Dosen Wali
                        <span class="font-semibold text-gray-800">{{ count($lecturers->whereNotNull('kelas_id'))}}</span>
                    </p>
                </div>
              </header>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>

                        @if ($user['role'] != 'mahasiswa')    
                        <th scope="col" class="px-6 py-3">Kode Dosen</th>
                        @endif

                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Nama Dosen</div>
                        </th>

                        @if ($user['role'] != 'mahasiswa')    
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">NIP</div>
                        </th>
                        @endif

                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Kelas</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Email</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lecturers as $lecturer)
                    <tr class="bg-white border-b hover:bg-slate-50" >
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>

                        @if ($user['role'] != 'mahasiswa')    
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <span>{{ $lecturer['kode_dosen'] }}</span>
                                
                            </div>
                        </th>
                        @endif

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $lecturer['name'] }}</span>
                                
                            </div>
                        </td>

                        @if ($user['role'] != 'mahasiswa')    
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span>{{ $lecturer['nip'] }}</span>
                            
                            </div>
                        </td>
                        @endif

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center {{ !$lecturer->kelas ? 'text-red-500' : '' }}">{{ $lecturer->kelas->name ?? 'not assigned'}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">{{ $lecturer->user['email']}}</div>
                        </td>   
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-layout>