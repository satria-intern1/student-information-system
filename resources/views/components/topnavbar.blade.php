<nav class=" sticky top-0 z-20 w-full bg-white border-b border-gray-200  ">
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
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Dashboard</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" 
                                        @click.prevent="$refs.logoutButton.click()">Logout</a>
                                    <button type="submit" x-ref="logoutButton" style="display: none;">Logout</button>
                                    
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