<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite('resources/css/app.css')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>

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
            </x-sidebar>
          
            <!-- Main Content -->
            <main class="p-4 w-full bg-slate-400">
                    <!-- Main content -->     
                
                    {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>