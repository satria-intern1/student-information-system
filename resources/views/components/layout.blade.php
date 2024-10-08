<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">


</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false, dropdownOpen: false, searchOpen: false }">
        <!-- Top Navigation Bar -->
        <x-topnavbar>
            <x-slot:name>{{ $name}}</x-slot>
            <x-slot:email>{{ $email }}</x-slot>
        </x-topnavbar>

        <div class="lg:flex">
            <!-- Sidebar -->
            <x-sidebar>
                <x-slot:role>{{$role }}</x-slot>
                
                @if ($role == 'dosen' || $role == 'mahasiswa')
                    <x-slot:kelasId>{{ $kelasId}}</x-slot>
                @endif

            </x-sidebar>
          
            <!-- Main Content -->
            <main class="p-4 w-full">                
                    {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>