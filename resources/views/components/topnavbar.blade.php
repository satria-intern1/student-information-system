<nav class=" sticky top-0 z-20 w-full bg-white border-b border-gray-200 shadow-sm ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3 ">
        <div class="flex items-center justify-between h-12">
            <div class="flex items-center justify-start">
                <button @click="sidebarOpen = !sidebarOpen" class=" lg:hidden inline-flex items-center p-2 text-sm text-indigo-500 rounded-full  hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200   ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                 </button>
                 <img class=" mx-auto h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">

                <a href="/" class="flex ml-2 md:mr-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-gray-700">Universitas Nusantara</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                     <!-- User menu -->
                     <div>
                        <button @click="dropdownOpen = !dropdownOpen" type="button" class="mx-4 flex text-sm font-medium text-gray-700  " id="user-menu-button" aria-expanded="false">
                            <span class="sr-only">Open user menu</span>
                            {{ $name }}
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
                                <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Settings</a>
                            </li>
                            <li class="hover:cursor-pointer">
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
    
</nav>