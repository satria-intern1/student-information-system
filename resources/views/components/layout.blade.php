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
                             <!-- User menu -->
                             <div>
                                <button @click="dropdownOpen = !dropdownOpen" type="button" class="mx-4 flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false">
                                    <span class="sr-only">Open user menu</span>
                                    <img height="32" src="https://img.icons8.com/material-rounded/48/user-male-circle.png" alt="user-male-circle"/>  </button>
                            </div>
                            <!-- User dropdown menu -->
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="fixed z-10 top-14 right-1 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow  " id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900 ">{{ $name }}</span>
                                    <span class="block text-sm font-medium text-gray-500 truncate ">{{ $email }}</span>
                                </div>
                                <ul class="py-1" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Dashboard</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100  " >
                                            @csrf
                                            <button type="submit">Logout</button>
                                        </form>
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
                    {{-- Dashboard Sidebar --}}
                  <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                      <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                      </svg>
                      <span class="ml-3">Dashboard</span>
                    </a>
                  </li>
                  <hr>
                  
                    {{-- Kelas Sidebar --}}
                    <li>
                        <div x-data="{ openkelas: false }">
                        <button @click="openkelas = !openkelas" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kelas</span>
                            <svg class="w-3 h-3" :class="{'rotate-180': openkelas}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        {{-- Dropdown Kelas --}}
                        <ul x-show="openkelas" x-transition class="py-2 space-y-2">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">List Kelas</a>
                            </li>
                            <template x-if="{{ $role =='kaprodi'}}">
                            <li>
                                <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Edit Kelas </a>
                            </li>
                            </template>
                        </ul>
                        </div>
                    
                    </li>
                    </template>

                   <template x-if="{{ $role =='kaprodi' }}">
                    {{-- Dosen Sidebar --}}
                    <li>
                        <div x-data="{ openDosen: false }">
                        <button @click="openDosen = !openDosen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Dosen</span>
                            <svg class="w-3 h-3" :class="{'rotate-180': openDosen}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        {{-- Dropdown Dosen --}}
                        <ul x-show="openDosen" x-transition class="py-2 space-y-2">
                            <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">List Dosen</a>
                            </li>
                            <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Edit Dosen</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    </template>

                    
                    
                        {{-- Mahasiswa Sidebar --}}
                    <template x-if="{{ $role =='kaprodi' || $role == 'dosen' }}">
                    <li>
                        <div x-data="{ openMhs: false }">
                        <button @click="openMhs = !openMhs" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Mahasiswa</span>
                            <svg class="w-3 h-3" :class="{'rotate-180': openMhs}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        {{-- Dropdown Mahasiswa --}}
                        <ul x-show="openMhs" x-transition class="py-2 space-y-2">
                            <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Mahasiswa List</a>
                            </li>
                            <template x-if="{{ $role == 'dosen' }}">
                            <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Edit Mahasiswa Data</a>
                            </li>
                            </template>
                        </ul>
                        </div>
                    </li>
                    </template>
                    
                    {{-- Request Edit Data --}}
                    <template x-if="{{ $role =='dosen' || $role == 'mahasiswa' }}">
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                          <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                          </svg>
                          <span class="ml-3">Request Edit Data</span>
                        </a>
                    </li>
                    </template>


                    {{-- Arrange Kelas --}}
                    <template x-if="{{ $role =='kaprodi' }}">

                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                          <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                          </svg>
                          <span class="ml-3">Atur Kelas</span>
                        </a>
                    </li>
                    </template>





                   
                    <!-- Add more menu items here -->
                     
                </ul>
              </div>
            </aside>
          
            <!-- Main Content -->
            <main class="p-4 w-full">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg bg-green-300">
                    <!-- Your main content goes here -->     
                
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    
    
</body>
</html>