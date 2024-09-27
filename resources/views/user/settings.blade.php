<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:name>{{ $userData['name'] }}</x-slot>
    <x-slot:email>{{ $user['email'] }}</x-slot>
    <x-slot:role>{{ $user['role'] }}</x-slot>
    @if ($user['role'] == 'dosen' || $user['role'] == 'mahasiswa')
        <x-slot:kelasId>{{ $userData['kelas_id'] ?? 'none'}}</x-slot>
    @endif


    @if (session('success'))
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    @endif

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4">
        <div class="p-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-bold mb-4">Pengaturan Akun</h2>
                           
                        <form action="{{ route('settings.update.username') }}" method="POST" class="mb-8">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username Baru:</label>
                                <input type="text" name="username" id="username" value="{{ old('username', Auth::user()->username) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('username')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Ubah Username
                            </button>
                        </form>
                       
                        <form action="{{ route('settings.update.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Password Saat Ini:</label>
                                <input type="password" name="current_password" id="current_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('current_password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">Password Baru:</label>
                                <input type="password" name="new_password" id="new_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('new_password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru:</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Ubah Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-layout>