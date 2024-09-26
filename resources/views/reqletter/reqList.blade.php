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


   
    
    <div class="max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-3xl m-4">
        <div class="p-8">
            <!-- Show kelas name -->
            <h2 class="text-xl font-bold mb-4">{{$className}}</h2>

            
            @if ($reqLetters->count() == 0)
                <p>Tidak ada pengajuan pengubahan data.</p>
            @endif


            @foreach ($reqLetters as $reqLetter)

                <div class="mb-4 p-4 border rounded-lg">
                    <!-- Show student name -->
                    <p class="text-lg font-semibold"> {{ $reqLetter->mahasiswa->name }}</p>
                    
                    <!-- Show letter description -->
                    <p class="text-gray-600 mb-8"> 
                        {{ $reqLetter['keterangan']}}

                    </p>
    
                    <!-- Action buttons -->
                    <div x-data="{
                        accept() {
                            this.submitForm('editForm', () => {
                                setTimeout(() => {
                                    this.submitForm('deleteForm');
                                }, 50); // Adjust the delay as needed
                            });
                        },
                        reject() {
                            this.submitForm('deleteForm');
                        },
                        submitForm(formId, callback) {
                            let form = document.getElementById(formId);
                            if (form) {
                                form.submit();
                                if (callback) callback();
                            }
                        }
                    }" class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form action={{route('reqletter.updateEdit', $userData['kelas_id'])}} method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="mahasiswa_id" value="{{ $reqLetter['mahasiswa_id'] }}">
                        </form>

                        <form action={{route('reqletter.destroy', $userData['kelas_id'])}} method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="reqLetter_id" value="{{ $reqLetter['id']}}">
                        </form>

                        <button @click="accept" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Accept</button>
                        <button @click="reject" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Reject</button>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    

    
</x-layout>