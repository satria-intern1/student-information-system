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

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
        <div class="p-8">
            <form x-data="{ 
                showModal: false,
                isEditable: {{ $userData['edit'] ? 'true' : 'false' }},
                
                studentNIM: '{{ $userData['nim'] }}', originalNIM: '{{ $userData['nim'] }}', 
                studentName: '{{ $userData['name'] }}', originalName: '{{ $userData['name'] }}',
                birthPlace: '{{ $userData['tempat_lahir'] }}', originalBPlace: '{{ $userData['tempat_lahir'] }}',
                birthDate: '{{ $userData['tanggal_lahir'] }}', originalBDate: '{{ $userData['tanggal_lahir'] }}',

                submitForm() {
                    $refs.form.submit();
                }
            }" 
            @submit.prevent="showModal = isEditable"
            x-ref="form"
            method="POST"
            action="{{ route('mahasiswa.update', $userData['id']) }}">
                @csrf
                @method('PUT')

                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="nim" id="studentNim" x-model="studentNIM" 
                        :disabled="!isEditable"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="studentNim" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        NIM
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="name" id="studentName" x-model="studentName" 
                        :disabled="!isEditable"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="studentName" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="tempat_lahir" id="birthplace" x-model="birthPlace" 
                        :disabled="!isEditable"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="birthplace" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Birth Place
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="tanggal_lahir" id="birthdate" x-model="birthDate" 
                        :disabled="!isEditable"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                    <label for="birthdate" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Birth Date
                    </label>
                </div>

                <!-- Hidden input to update the 'edit' column -->
                <input type="hidden" name="edit" value="0">

                <div x-show="isEditable">
                    <button type="submit" 
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Submit
                    </button>
                    <button type="button"
                        @click="studentNIM = originalNIM; studentName = originalName; birthPlace = originalBPlace; birthDate = originalBDate;" 
                        class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Cancel
                    </button>   
                </div>

                <!-- Message for non-editable form -->
                <div x-show="!isEditable" class="mt-4 text-red-600">
                    Please make a request to your lecturer to edit your data. Wait until your request is accepted to proceed with the edits.
                </div>

                <!-- Confirmation Modal -->
                <div x-show="showModal" class="fixed inset-0 z-30 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <!-- Background overlay -->
                        <div x-show="showModal" 
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
                        <!-- Modal content -->
                        <div x-show="showModal" 
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Confirm Submission</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">Are you sure you want to submit this form? Please review your information before confirming. After submission, you won't be able to edit this form again.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" @click="submitForm()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Confirm
                                </button>
                                <button type="button" @click="showModal = false;" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>