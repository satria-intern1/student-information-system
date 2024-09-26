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
    

   <!-- class info-->
   <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-md  m-4">
      <div class="px-4 py-3 flex justify-between">
            <div>
                <div class="text-lg uppercase tracking-wide text-blue-600 font-semibold">

                    {{ $class->name }}

                </div>
                <div class="mt-2 text-gray-500">
                    <div>
                        <p><span class="font-semibold">Nama Dosen: </span> <a href="">{{ $lecturerClass['name'] ??'none'}}</a></p>
                        <p><span class="font-semibold">Email: </span> <a href="mailto:{{ $lecturerClass->user->email ?? ' '}}">{{$lecturerClass->user->email ?? 'none' }}</a></p>
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
   </div>

    <!-- Table Lecturer -->
   <div class="2xl:grid 2xl:grid-cols-2 2xl:gap-8">
        <div x-data="{
                selectedId: {{ $lecturerClass->id ?? 'null' }},
            lecturerClassId: {{ $lecturerClass->id ?? 'null' }},
            isChangedA: false,
            submitForm() {
                document.getElementById('assign-lecturer-form').submit();
            },
            cancelChanges() {
                this.selectedId = this.lecturerClassId;
                this.isChanged = false;
            },
            isDisabled(lecturerId, hasClass) {
                if (this.selectedId === null) {
                    return hasClass && lecturerId !== this.lecturerClassId;
                }
                return this.selectedId !== lecturerId;
            },
            handleChange(event, lecturerId) {
                this.isChangedA = true;
                if (event.target.checked) {
                    this.selectedId = lecturerId;
                } else {
                    this.selectedId = null;
                }
            }
        }"class="mb-8">
            <form id="assign-lecturer-form" method="POST" action="{{ route('dosen.update.class' , $class['id'])}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="selectedId" x-bind:value="JSON.stringify(selectedId)">
                <input type="hidden" name="class_id" value="{{ $class['id'] }}">
                <div class=" max-w-5xl 2xl:max-w-4xl mx-auto overflow-x-auto shadow-md sm:rounded-lg">
                    <header class="p-6 border border-gray-200 bg-slate-100">
                        <div class="mt-1">
                            <p class="text-sm font-medium text-gray-800">
                                List of all lecturer
                            </p>

                        </div>
                      </header>
                    <table class=" w-full text-sm text-left text-gray-500">
                        
                        <thead class="text-xs text-gray-700 uppercase bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Assigned</th>
                                <th scope="col" class="px-6 py-3">Class Name</th>
                                <th scope="col" class="px-6 py-3">Lecturer Name</th>
                                <th scope="col" class="px-6 py-3">Lecturer NIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lecturers as $lecturer)
                                <tr class="bg-white border-b hover:bg-slate-50">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" 
                                            :checked="selectedId == {{ $lecturer->id }}"
                                            @change="handleChange($event, {{ $lecturer->id }})"
                                            :disabled="isDisabled({{ $lecturer->id }}, {{ $lecturer->kelas ? 'true' : 'false' }})"
                                            :class="{ 'opacity-50 cursor-not-allowed': isDisabled({{ $lecturer->id }}, {{ $lecturer->kelas ? 'true' : 'false' }}) }">
                                    </td>
                                    <td class="px-6 py-4" :class="{ 'text-red-500': {{ $lecturer->kelas ? 'false' : 'true' }} }">
                                        {{ $lecturer->kelas->name ?? 'Not Assigned' }}
                                    </td>
                                    <td class="px-6 py-4">{{ $lecturer->name }}</td>
                                    <td class="px-6 py-4">{{ $lecturer->nip }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div x-show="isChangedA" class="mt-4 mb-8 flex justify-end space-x-2">
                    <button @click="cancelChanges" :disabled="!isChanged" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Cancel</button>
                    <button @click="submitForm"  type='button' :disabled="!isChanged" class="px-4 py-2 bg-blue-500 text-white rounded">Save Changes</button>
                </div>
            </form>
        </div>

    <!-- Table Student -->
            <div x-data="{
                selectedStudents: [],
                capacity: {{ $class['jumlah'] }},
                isChangedB: false,
                submitForm() {
                    document.getElementById('assign-students-form').submit();
                },
                cancelChanges() {
                    this.selectedStudents = [];
                    this.isChanged = false;
                    this.initializeSelectedStudents();
                },
                isDisabled(studentId) {
                    return this.selectedStudents.length >= this.capacity && !this.selectedStudents.includes(studentId);
                },
                handleChange(event, studentId) {
                    this.isChangedB = true;
                    if (event.target.checked) {
                        if (this.selectedStudents.length < this.capacity) {
                            this.selectedStudents.push(studentId);
                        }
                    } else {
                        this.selectedStudents = this.selectedStudents.filter(id => id !== studentId);
                    }
                },
                initializeSelectedStudents() {
                    this.selectedStudents = @json($studentsClass->pluck('id'));
                }
                }" x-init="initializeSelectedStudents()">
                    <form class="-translate-y-4" id="assign-students-form" method="POST" action="{{ route('mahasiswa.update.class' , $class['id'])}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="selected_students" x-bind:value="JSON.stringify(selectedStudents)">
                        <input type="hidden" name="class_id" value="{{ $class['id'] }}">
                        <div class="max-w-5xl 2xl:max-w-4xl mx-auto rounded-lg shadow-md m-4 overflow-x-auto">
                            <header class="p-6 border border-gray-200 bg-slate-100">
                                <div class="mt-1">
                                    <p class="text-sm font-medium text-gray-800">
                                        Class Students and Unassigned Students
                                    </p>
        
                                </div>
                              </header>
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-slate-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Checkbox</th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center justify-center">Student Name</div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <div class="flex items-center justify-center">Student NIM</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentsClass as $studentClass)
                                    <tr class="bg-white border-b hover:bg-slate-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <input type="checkbox" 
                                                    :checked="selectedStudents.includes({{ $studentClass['id'] }})"
                                                    @change="handleChange($event, {{ $studentClass['id'] }})"
                                                    :disabled="isDisabled({{ $studentClass['id'] }})"
                                                    :class="{ 'opacity-50 cursor-not-allowed': isDisabled({{ $studentClass['id'] }}) }">
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $studentClass['name'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center">{{ $studentClass['nim'] }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                    
                                    @foreach ($remainingStudents as $student)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <input type="checkbox" 
                                                    :checked="selectedStudents.includes({{ $student['id'] }})"
                                                    @change="handleChange($event, {{ $student['id'] }})"
                                                    :disabled="isDisabled({{ $student['id'] }})"
                                                    :class="{ 'opacity-50 cursor-not-allowed': isDisabled({{ $student['id'] }}) }">
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $student['name'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center">{{ $student['nim'] }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                            <div x-show="isChangedB"class="mt-4 flex justify-end space-x-2">
                                <button @click="cancelChanges" :disabled="!isChanged" class="px-4 py-2 bg-gray-300 text-gray-700 rounded">Cancel</button>
                                <button @click="submitForm"  type='button' :disabled="!isChanged" class="px-4 py-2 bg-blue-500 text-white rounded">Save Changes</button>
                            </div>
                    </form>

                </div>
            
   </div>

</x-layout>