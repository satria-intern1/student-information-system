<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif
    
    <div class="max-w-md mr-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
        <div class="p-8">
            @if ($isApproved)
            <div class="flex flex-col items-center mb-2 font-medium">
                Anda Telah Mendapat Persetujuan Pengubahan Data
            </div>
            
            @elseif($isMadeReq)
                <div class="flex flex-col items-center mb-2 font-medium">
                    Anda Telah Membuat Pengajuan Pengubahan Data
                </div>
                <div class="flex flex-col items-center font-medium mb-8">
                    Mohon Tunggu Respons Dosen Wali Anda
                </div>
                <div class="flex flex-col items-center">
                    <h3 class="text-center border-b">Keterangan Pengajuan</h3>
                    <p class="text-center">{{ $userData->requestletter->keterangan }}</p>
                </div>
            @else
            <div class="relative z-0 w-full mb-8">
                <h3>Formulir Pengajuan Perubahan Data</h3>
            </div>
            
            
            <form action="{{ route('reqCreate') }}" method="POST">
                @csrf
                
                
                <input type="hidden" name="mahasiswa_id" value="{{$userData['id']}}">
                <input type="hidden" name="kelas_id" value="{{$userData['kelas_id']}}">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="name" name="mahasiswa_name" id="studentName" value="{{ $userData['name'] }}"  disabled
                    
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-gradient-to-b from-transparent to-gray-50 border-0 border-b-2 border-gray-300 appearance-none 0 " required />
                    <label for="studentName" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Nama Mahasiswa
                    </label>
                </div>
             
                <div class="relative z-0 w-full mb-5 group">
                    <textarea name="keterangan" id="description" rows="6" placeholder=""
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" autofocus required></textarea>
                    <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Keterangan
                    </label>
                </div>
                <div>
                    <button type="submit" 
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Submit
                    </button>
                </div>
            </form>
                

            @endif
            
        </div>
    </div>
</x-layout>