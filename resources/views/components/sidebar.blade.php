<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
       class="fixed z-10 pt-6 top-16 left-0 w-64 h-screen transition-transform bg-white lg:translate-x-0 lg:sticky lg:max-w-80 lg:h-screen">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
        {{-- Dashboard Sidebar --}}
      <li>
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
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
                    <a href="{{ route('kelas.list') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">List Kelas</a>
                </li>
                <template x-if="{{ $role =='kaprodi'}}">
                <li>
                    <a href="{{ route('kelas.edit') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Edit Kelas </a>
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
                <a href="{{ route('dosen.list') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">List Dosen</a>
                </li>
                <li>
                <a href="{{ route('dosen.edit') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">Edit Dosen</a>
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

       
        <!-- Add more menu items here -->
         
    </ul>
  </div>
</aside>