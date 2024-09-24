<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif
        
    <!-- Table Container -->
    <div x-data="{ showDeleteModal: false, studentToDelete: null }" class="px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <header class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-900">List of Student</h2>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-600">Total Students
                        <span class="font-semibold text-gray-800">{{ count($students) }}</span>
                    </p>
                    
                </div>
              </header>
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
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
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Action</div>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr class="bg-white border-b hover:bg-gray-50" x-data="{     
                        editing: false, 
                        studentNIM: '{{ $student['nim'] }}', originalNIM: '{{ $student['nim'] }}', 
                        studentName: '{{ $student['name'] }}', originalName: '{{ $student['name'] }}',
                        birthPlace: '{{ $student['tempat_lahir'] }}', originalBPlace: '{{ $student['tempat_lahir'] }}',
                        birthDate: '{{ $student['tanggal_lahir'] }}', originalBDate: '{{ $student['tanggal_lahir'] }}',
                    }">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <span x-show="!editing">{{ $student['nim'] }}</span>
                                <input x-show="editing" type="number" x-model="studentNIM" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            
                        </th>
                        <td class="px-6 py-4">
                            <span x-show="!editing">{{ $student['name'] }}</span>
                                <input x-show="editing" type="text" x-model="studentName" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                <span x-show="!editing">{{ $student['tempat_lahir'] }}</span>
                                <input x-show="editing" type="text" x-model="birthPlace" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span x-show="!editing">{{ $student['tanggal_lahir'] }}</span>
                                <input x-show="editing" type="date" x-model="birthDate" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                <template x-if="!editing">
                                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                        <button @click="editing = true" 
                                                class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <button @click="showDeleteModal = true; studentToDelete = {{ $student['id'] }}"
                                            class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            Delete
                                        </button>
                                    </div>
                                </template>
                                <template x-if="editing">
                                    <form class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2" 
                                        method="POST" 
                                        action="{{ route('mahasiswa.update', $student['id']) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="nim" :value="studentNIM">
                                        <input type="hidden" name="name" :value="studentName">
                                        <input type="hidden" name="tempat_lahir" :value="birthPlace">
                                        <input type="hidden" name="tanggal_lahir" :value="birthDate">


                                        <button type="submit"
                                                class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Confirm
                                        </button>
                                        <button type="button"
                                                @click="editing = false;
                                                studentNIM = originalNIM; studentName = originalName; birthPlace = originalBPlace; birthDate = originalBDate;" 
                                                class="px-3 py-1 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                            Cancel
                                        </button>
                                    </form>
                                </template>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-layout>