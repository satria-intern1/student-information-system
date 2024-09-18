<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js"></script>

</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false, dropdownOpen: false, searchOpen: false }">
        <!-- Top Navigation Bar -->
        <nav class=" sticky top-0 z-50 w-full bg-white border-b border-gray-200  ">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button @click="sidebarOpen = !sidebarOpen" class=" lg:hidden inline-flex items-center p-2 text-sm text-gray-500 rounded-lg  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                            </svg>
                         </button>
                        <a href="#" class="flex ml-2 md:mr-24">
                            <img src="/api/placeholder/32/32" class="h-8 mr-3" alt="Logo" />
                            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap ">Your Logo</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ml-3">
                            <!-- Search toggle for mobile -->
                            <button @click="searchOpen = !searchOpen" type="button" class="md:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                            <!-- Desktop Search -->
                            <div class="relative hidden md:block">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500      " placeholder="Search...">
                            </div>
                            <!-- User menu -->
                            <div>
                                <button @click="dropdownOpen = !dropdownOpen" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="/api/placeholder/32/32" alt="user photo">
                                </button>
                            </div>
                            <!-- User dropdown menu -->
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow  " id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900 ">Bonnie Green</span>
                                    <span class="block text-sm font-medium text-gray-500 truncate ">name@flowbite.com</span>
                                </div>
                                <ul class="py-1" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Settings</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Earnings</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Search -->
            <div x-show="searchOpen" class="md:hidden">
                <div class="relative p-3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="search-navbar-mobile" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500      " placeholder="Search...">
                </div>
            </div>
        </nav>

        <div class="lg:flex">
            <!-- Sidebar -->
            <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
                   class="fixed pt-6 top-16 left-0 w-64 h-screen transition-transform bg-white lg:translate-x-0 lg:sticky lg:max-w-80 lg:h-screen">
              <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
                <ul class="space-y-2 font-medium">
                  <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                      <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                      </svg>
                      <span class="ml-3">Dashboard</span>
                    </a>
                  </li>
                  <!-- Add more menu items here -->
                </ul>
              </div>
            </aside>
          
            <!-- Main Content -->
            <div class="p-4 lg:w-3/4">
              <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
                <!-- Your main content goes here -->
                <div class="grid grid-cols-3 gap-4 mb-4">
                  <div class="flex items-center justify-center h-24 rounded bg-gray-50">
                    <p class="text-2xl text-gray-400">+</p>
                  </div>
                  <div class="flex items-center justify-center h-24 rounded bg-gray-50">
                    <p class="text-2xl text-gray-400">+</p>
                  </div>
                  <div class="flex items-center justify-center h-24 rounded bg-gray-50">
                    <p class="text-2xl text-gray-400">+</p>
                  </div>
                </div>

                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-4"
            x-data="{
         role: 'mahasiswa', // Change this to 'dosen' or 'mahasiswa' to test different roles
         userData: {
             kaprodi: { name: 'Dr. Jane Doe', kode_dosen: 'KP001', nip: '198001012010011001' },
             dosen: { name: 'Prof. John Smith', kode_dosen: 'DS001', nip: '197005062005011002' },
             mahasiswa: { name: 'Alice Johnson', nim: '12345678', birthplace: 'New York', birthdate: '2000-01-15' }
         } }">
    <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-1" x-text="role"></div>
        <h2 class="block mt-1 text-lg leading-tight font-medium text-black" x-text="userData[role].name"></h2>
        <div class="mt-2 text-gray-500">
            <template x-if="role === 'kaprodi' || role === 'dosen'">
                <div>
                    <p><span class="font-semibold">Kode Dosen:</span> <span x-text="userData[role].kode_dosen"></span></p>
                    <p><span class="font-semibold">NIP:</span> <span x-text="userData[role].nip"></span></p>
                </div>
            </template>
            <template x-if="role === 'mahasiswa'">
                <div>
                    <p><span class="font-semibold">NIM:</span> <span x-text="userData[role].nim"></span></p>
                    <p><span class="font-semibold">Tempat Lahir:</span> <span x-text="userData[role].birthplace"></span></p>
                    <p><span class="font-semibold">Tanggal Lahir:</span> <span x-text="userData[role].birthdate"></span></p>
                </div>
            </template>
        </div>
    </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    {{ $slot }}
    
</body>
</html>