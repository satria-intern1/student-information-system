<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

    

</head>
<body class="">
    @if (session('error'))
    <x-modal-error>
        {{ session('error') }}
    </x-modal-error>
    @endif

    <div class="flex min-h-screen items-center justify-center">
        <div class="hidden w-3/5 min-h-screen md:flex bg-cover bg-center relative" style="background-image: url('classroom.jpg');">
            <div class="absolute inset-0 bg-black opacity-50 z-[1]"></div>
            <div class=" relative z-[2] w-full backdrop-blur-sm text-slate-300 my-auto mx-10 p-16">
                <h2 class="font-bold text-lg mb-2">UNIVERSITAS NUSANTARA</h2>
                <p class="mb-3 text-sm font-semibold">Di mana pemimpin masa depan berkumpul</p>
                <p class="mb-3 italic font-semibold">Passion · Tanggung Jawab · Ketulusan · Dedikasi · Keunggulan · Nasionalisme</p>
                <p class="mb-6 text-md">Universitas Nusantara (UN) adalah salah satu universitas swasta terbaik di Indonesia (terakreditasi A). Universitas Nusantara menawarkan lingkungan belajar dan penelitian yang kuat secara internasional. Perkuliahan di Universitas Nusantara dilakukan dalam bahasa Inggris. Jumlah mahasiswa internasional di Universitas Nusantara adalah salah satu yang tertinggi di antara semua universitas di seluruh Indonesia. Universitas Nusantara terletak di salah satu kawasan industri terbesar di Asia Tenggara (Kawasan Industri Jababeka) di mana berbagai perusahaan dari banyak negara mendirikan dan menjalankan bisnis mereka.</p>
                <hr>
            </div>
        </div>
        <div class="min-h-screen md:w-2/5 flex md:bg-slate-200">
            <div class="m-auto p-16">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-black">Student Management System</h2>
                </div>
            
                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" action="/" method="POST">
                        @csrf
                        <div>
                            <label for="username" class="block text-sm font-medium leading-6 text-black">Email or username</label>
                            <div class="mt-2">
                                <input autofocus id="username" autocomplete="none" name="someText" type="text" required value='{{ old('username') }}'
                                class="p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 sm:text-sm sm:leading-6 ring-inset
                                @error('username') ring-3 ring-red-600 @else ring-1 ring-gray-300 focus:ring-2 focus:ring-indigo-600 @enderror">
                            </div>
                            <p class="text-red-500 text-sm">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium leading-6 text-black">Password</label>
                            </div>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" required 
                                class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                
                        <div>
                            <button type="submit" 
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Sign in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>