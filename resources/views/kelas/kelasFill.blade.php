<x-layout>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    
    

   {{-- class info--}}
   <div class=" mx-auto bg-white rounded-2xl shadow-md  m-4">
      <div class="px-4 py-3 flex justify-between">
            <div>
                <div class="text-lg uppercase tracking-wide text-md text-blue-600 font-semibold">

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

    <!-- Table Container -->
   <div>
        <div class="mx-auto bg-white rounded-lg shadow-md  m-4 overflow-x-auto ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Checkbox</th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Class Name</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Lecture Name</div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center">Lecture NIP</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($lecturerClass !== null)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" checked>
                            </div>
                        </th>
                        <td class="px-6 py-4">    
                            <div class="flex items-center justify-center">

                                {{ $class->name }}
                            </div>
                        </td>
                            
                        <td class="px-6 py-4">
                            {{ $lecturerClass['name']}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">{{ $lecturerClass['nip']}}</div>
                        </td>
                    </tr>
                    @endif

                    @foreach ($otherLecturers as $lecturer) 
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" >
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center {{ !$lecturer->kelas ? 'text-red-500' : '' }}">
                            {{ $lecturer->kelas['name'] ?? 'Not Assigned'}}
                            <div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $lecturer['name']}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center">{{ $lecturer['nip']}}</div>
                        </td>
                    </tr>
                        
                    @endforeach

                </tbody>
            </table>
        </div>
        




        </div>
        <div>
            <div class="mx-auto bg-white rounded-lg shadow-md  m-4 overflow-x-auto ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                            
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" checked>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $studentClass['name']}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">{{ $lecturerClass['nip']}}</div>
                            </td>
                        </tr>
                        @endforeach
    
                        @foreach ($remainingStudents as $student)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" >
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $student['name']}}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">{{ $lecturer['nip']}}</div>
                            </td>
                        </tr>
                            
                        @endforeach
    
                    </tbody>
                </table>
        </div>
   </div>

       
</x-layout>