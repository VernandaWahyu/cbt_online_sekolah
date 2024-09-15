<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div> -->
    <div class="sidebar-brand-text mx-3">CBT Online</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item  @yield('dashboard')">
    <a class="nav-link" href="{{ url('admin') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

@if(Auth::user()->level == 'admin')
<!-- Heading -->
<div class="sidebar-heading">
    Master
</div>

<!-- Nav Item - Charts -->
<li class="nav-item @yield('list-siswa')">
    <a class="nav-link" href="{{ url('siswa/list') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Siswa</span></a>
</li>

<li class="nav-item @yield('list-program-bimbel')">
    <a class="nav-link" href="{{ url('program_bimbel') }}">
        <i class="fas fa-fw fa-window-restore"></i>
        <span>Program</span></a>
</li>

<li class="nav-item @yield('list-kelas')">
    <a class="nav-link" href="{{ url('kelas') }}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Kelas</span></a>
</li>

<li class="nav-item @yield('list-guru')">
    <a class="nav-link" href="{{ url('guru') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Guru</span></a>
</li>

<li class="nav-item @yield('list-bank-soal')">
    <a class="nav-link" href="{{ url('bank_soal') }}">
        <i class="fas fa-fw fa-question-circle"></i>
        <span>Bank Soal</span></a>
</li>

<li class="nav-item @yield('list-ujian')">
    <a class="nav-link" href="{{ url('ujian') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Ujian</span></a>
</li>

<!-- <li class="nav-item @yield('list-ujian-hasil')">
    <a class="nav-link" href="{{ url('ujian_hasil') }}">
        <i class="fas fa-fw fa-id-card"></i>
        <span>Hasil Ujian</span></a>
</li> -->
@endif

@if(Auth::user()->level == 'guru')
<li class="nav-item @yield('list-bank-soal')">
    <a class="nav-link" href="{{ url('bank_soal') }}">
        <i class="fas fa-fw fa-question-circle"></i>
        <span>Bank Soal</span></a>
</li>

<li class="nav-item @yield('list-ujian')">
    <a class="nav-link" href="{{ url('ujian') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Ujian</span></a>
</li>
@endif

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->