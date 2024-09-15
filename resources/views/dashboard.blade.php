@extends('layouts.app')

@section('dashboard','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

@if(Auth::user()->level == 'admin' || Auth::user()->level == 'guru')
<!-- Content Row Admin -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Program</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_program }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-window-restore fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Kelas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_kelas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_siswa }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_guru }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
@endif

@if(Auth::user()->level == 'siswa')
<!-- Content Row Siswa -->
<div class="row">

    @foreach($list_ujian as $data)
    <div class="col-xl-12 col-md-12 mb-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                        <div class="h5 mb-0 font-weight-bold text-primary">{{ $data->nama_ujian }}</div>
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                            <i class="fas fa-file-alt"></i> {{ $data->jumlah_soal }} Soal &nbsp;<i class="fas fa-clock"></i> 60 Menit</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="{{ url('siswa/ujian',$data->id) }}" class="btn btn-success btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Kerjakan</span>
                </a>
                <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Insight</span>
                </a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
@endif

</div>
<!-- /.container-fluid -->
@endsection