<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif

    @if ($errors->any())
    <x-alert-error>
        @foreach ($errors->all() as $error)
            <li class="text-red-700 text-base leading-relaxed">
                {{ $error }}</li>
        @endforeach
    </x-alert-error>
    @endif

    @if (session('success'))
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    @endif
    

        

    <!-- Add Class Button -->
    <x-addbutton-modalform>
        <x-slot:buttonText>Tambah Dosen Baru</x-slot:buttonText>
        <x-slot:route>{{ route('dosen.add')}}</x-slot:route>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Dosen:</label>
            <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="kode_dosen" class="block text-gray-700 text-sm font-bold mb-2">Kode Dosen:</label>
            <input type="number" name="kode_dosen" id="kode_dosen" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP:</label>
            <input type="number" name="nip" id="nip" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
    </x-addbutton-modalform>

    <!-- Table Container -->
    <div x-data="{ showDeleteModal: false, dosenToDelete: null }" class="px-4 sm:px-6 lg:px-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <header class="p-6 border border-gray-200 bg-slate-100">
                <h2 class="text-2xl font-semibold text-gray-900">List Dosen</h2>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-600">Total Dosen
                        <span class="font-semibold text-gray-800">{{ count($lecturers) }}</span>
                    </p>
                    <p class="text-sm font-medium text-gray-600">Total Dosen Wali
                        <span class="font-semibold text-gray-800">{{ $lecturers->whereNotNull('kelas_id')->count() }}</span>
                    </p>
                </div>
              </header>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>
                        <th scope="col" class="px-6 py-3">Kode Dosen</th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Nama Dosen</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">NIP</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Kelas</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Email</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Action</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lecturers as $lecturer)
                    <tr class="bg-white border-b hover:bg-slate-50" x-data="{     
                        editing: false, 
                        lecturerCode: '{{ $lecturer['kode_dosen'] }}', originalCode: '{{ $lecturer['kode_dosen'] }}', 
                        lecturerName: '{{ $lecturer['name'] }}', originalName: '{{ $lecturer['name'] }}',
                        lecturerNIP: '{{ $lecturer['nip'] }}', originalNIP: '{{ $lecturer['nip'] }}',
                    }">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <span x-show="!editing">{{ $lecturer['kode_dosen'] }}</span>
                                <input x-show="editing" type="number" x-model="lecturerCode" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span x-show="!editing">{{ $lecturer['name'] }}</span>
                                <input x-show="editing" type="text" x-model="lecturerName" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">
                                <span x-show="!editing">{{ $lecturer['nip'] }}</span>
                                <input x-show="editing" type="number" x-model="lecturerNIP" 
                                    class="w-full min-w-[200px] px-2 py-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-md text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center {{ !$lecturer->kelas ? 'text-red-500' : '' }}">{{ $lecturer->kelas->name ?? 'not assigned'}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">{{ $lecturer->user['email']}}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-2">
                                <template x-if="!editing">
                                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                                        <button @click="editing = true" 
                                                class="px-3 py-1 text-sm font-medium text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                                            Edit
                                        </button>
                                        <button @click="showDeleteModal = true; dosenToDelete = {{ $lecturer['id'] }}"
                                            class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                                            Delete
                                        </button>
                                    </div>
                                </template>
                                <template x-if="editing">
                                    <form class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2" 
                                        method="POST" 
                                        action="{{ route('dosen.update', $lecturer['id']) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="kode_dosen" :value="lecturerCode">
                                        <input type="hidden" name="name" :value="lecturerName">
                                        <input type="hidden" name="nip" :value="lecturerNIP">
                                        <button type="submit"
                                                class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Confirm
                                        </button>
                                        <button type="button"
                                                @click="editing = false;
                                                lecturerCode = originalCode; lecturerName = originalName; lecturerNIP = originalNIP;"
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

        <!--  Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-30 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                {{-- background modal --}}
                <div x-show="showDeleteModal" 
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Modal delete content --}}
                <div x-show="showDeleteModal" 
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Lecturer</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete this lecturer? This action cannot be undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form method="POST" :action="'{{ route('dosen.delete', '') }}/' + dosenToDelete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                        </form>
                        <button type="button" @click="showDeleteModal = false; classToDelete = null" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>