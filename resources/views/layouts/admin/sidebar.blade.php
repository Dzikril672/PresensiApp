<!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
              <img src="{{asset('tabler/static/logo.svg')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
              <li class="nav-item">
                <a class="nav-link {{ request()-> is('admin/dashboardAdmin') ? 'active' : '' }}" href="/admin/dashboardAdmin" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Home
                  </span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()-> is('presensi/monitoring') ? 'active' : '' }}" href="/presensi/monitoring" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                    stroke="currentColor" stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                    class="icon icon-tabler icons-tabler-outline icon-tabler-heart-rate-monitor">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                      <path d="M7 20h10" />
                      <path d="M9 16v4" />
                      <path d="M15 16v4" />
                      <path d="M7 10h2l2 3l2 -6l1 3h3" />
                  </svg>
                </span>
                  <span class="nav-link-title">
                    Monitoring Presensi
                  </span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ request()-> is('presensi/kelolaPengajuanIzin') ? 'active' : '' }}" href="/presensi/kelolaPengajuanIzin" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                      stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-mail-forward">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                        <path d="M3 6l9 6l9 -6" />
                        <path d="M15 18h6" />
                        <path d="M18 15l3 3l-3 3" />
                    </svg>
                </span>
                  <span class="nav-link-title">
                    Kelola Pengajuan Izin
                  </span>
                </a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()-> is(['karyawan', 'departemen']) ? 'show' : '' }}" href="#navbar-base" 
                  data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" 
                  aria-expanded="{{ request()-> is(['karyawan', 'departemen']) ? 'show' : 'true' }}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                        <path d="M12 12l8 -4.5" />
                        <path d="M12 12l0 9" />
                        <path d="M12 12l-8 -4.5" />
                        <path d="M16 5.25l-8 4.5" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Data Master
                  </span>
                </a>
                <div class="dropdown-menu {{ request()-> is(['karyawan', 'departemen']) ? 'show' : '' }}">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item {{ request()-> is(['karyawan']) ? 'active' : '' }}" href="/karyawan">
                        Karyawan
                      </a>
                      <a class="dropdown-item {{ request()-> is(['departemen']) ? 'active' : '' }}" href="/departemen">
                        Departemen 
                      </a>
                    </div>
                  </div>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-license">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                        <path d="M9 7l4 0" />
                        <path d="M9 11l4 0" />
                      </svg>
                  </span>
                  <span class="nav-link-title">
                    Data Laporan
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="/presensi/laporanPresensi">
                        Presensi Karyawan
                      </a>
                      <a class="dropdown-item" href="/presensi/rekapPresensi">
                        Rekap Presensi 
                      </a>
                    </div>
                  </div>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                      stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                      class="icon icon-tabler icons-tabler-outline icon-tabler-settings-automation">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                        <path d="M10 9v6l5 -3z" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Konfigurasi
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="/konfigurasi/lokasiKantor">
                        Lokasi Kantor
                      </a>
                    </div>
                  </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
    </aside>