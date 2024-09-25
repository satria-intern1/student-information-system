<aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
       class="fixed z-10 pt-6 top-16 left-0 w-64 h-screen transition-transform bg-indigo-500 lg:translate-x-0 lg:sticky lg:max-w-80 lg:h-screen">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-indigo-500">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard Sidebar -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <svg class="w-5 h-5 text-slate-200 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <hr>
      
            <!-- Profile Sidebar -->
            @if ($role != 'mahasiswa')
            <li>
                <a href="{{ ' ' }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Profil</span>
                </a>
            </li>

            @else
            <li>
                <a href="{{ route('mahasiswa.getProfile') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Profil</span>
                    {{-- profil yang editable --}}
                </a>
            </li>
            @endif
            

            @if($role=='kaprodi')
            <li>
                <a href="{{ route('kelas.edit') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Manajemen Kelas</span>
                </a>
            </li>

            <li>
                <a href="{{ route('mahasiswa.displayForm') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Manajemen Mahasiswa</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dosen.edit') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Manajemen Dosen</span>
                </a>
            </li>
            @endif


            
            @if($role=='dosen' || $role=='mahasiswa')
            <li>
                <a href="{{ route('kelas.list') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Daftar Semua Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dosen.list') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Daftar Semua Dosen</span>
                </a>
            </li>
                @if ($role=='dosen')

                <li>
                    <a href="{{ route('mahasiswa.list') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                        <span class="ml-3">Daftar Semua Mahasiswa</span>
                    </a>
                </li>
                @endif
            @endif


            @if($role=='dosen' && $kelasId !== 'none')
            <li>
                <a href="{{ route('mahasiswa.editkelas', $kelasId ) }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Manajemen Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reqletter.index', $kelasId) }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Permintaan Pengubahan</span>
                </a>
            </li>
            @endif

            @if($role=='mahasiswa' && $kelasId !== 'none')
            <li>
                <a href="{{ route('reqletter.form') }}" class="flex items-center p-2 text-slate-200 rounded-lg hover:text-white group">
                    <span class="ml-3">Pengajuan Pengubahan Data</span>
                </a>
            </li>
            @endif

            <!-- Add more here -->


            
            
        </ul>
    </div>
</aside>