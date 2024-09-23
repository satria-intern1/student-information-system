<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen')
    <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
@endif
        
    <!-- Table Container -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <header class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-900">List of Student</h2>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-600">Total Students
                        <span class="font-semibold text-gray-800">{{ count($students) }}</span>
                    </p>
                    <p class="text-sm font-medium text-gray-600">Students with no classroom
                        <span class="font-semibold text-gray-800">{{ count($students->where('kelas_id', null)) ??  '0' }}</span>
                    </p>
                </div>
              </header>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>
                        <th scope="col" class="px-6 py-3">Student NIM</th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Student Name</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Classroom</div>
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
                    @foreach ($students as $student)
                    <tr class="bg-white border-b">
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
                </tbody>
            </table>
        </div>
</x-layout>