@extends('layouts.user_type.kepala-sekolah.auth')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Siswa</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $getCountSiswa }}
                                    {{-- <span class="text-success text-sm font-weight-bolder">+55%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Siswa Naik Kelas</p>
                                <h5 class="font-weight-bolder mb-0" style="color:rgba(40, 167, 69, 0.7);">
                                    {{ $getCountHasilAkhir['naik_kelas'] }}
                                    {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Siswa Tidak Naik Kelas</p>
                                <h5 class="font-weight-bolder mb-0" style="color:rgba(220, 53, 69, 0.7);">
                                    {{ $getCountHasilAkhir['tidak_naik_kelas'] }}
                                    {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Tenaga Pelajar</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $getCountTenagaPengajar }}
                                    {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-6">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="bar-siswa-kelas" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                    <h6 class="ms-2 mt-4 mb-0"> Jumlah Siswa Per Kelas </h6>
                    <div class="container border-radius-lg">
                        <div class="row">
                            @foreach ($getCountSiswaPerKelas['kelasData'] as $index => $kelas)
                                <div class="col-2 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">{{ $kelas }}</p>
                                    </div>
                                    <h4 class="font-weight-bolder"
                                        style="color: {{ $getCountSiswaPerKelas['warnaBar'][$index] }};">
                                        {{ $getCountSiswaPerKelas['jumlahSiswa'][$index] }}</h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-lg-0 mb-6">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="bar-status-siswa" class="chart-canvas" height="170"></canvas>
                        </div>
                    </div>
                    <h6 class="ms-2 mt-4 mb-0"> Jumlah Siswa Naik dan Tidak Naik Kelas Per Kelas </h6>
                    <div class="container border-radius-lg">
                        <div class="row">
                            @foreach ($getCountSiswaStatusPerKelas['kelasData'] as $index => $kelas)
                                <div class="col-2 py-3 ps-0">
                                    <div class="d-flex mb-2">
                                        <p class="text-xs mt-1 mb-0 font-weight-bold">{{ $kelas }}</p>
                                    </div>
                                    <h4 class="font-weight-bolder" style="color:rgba(40, 167, 69, 0.7);">
                                        {{ $getCountSiswaStatusPerKelas['naikKelas'][$index] }}
                                    </h4>
                                    <h4 class="font-weight-bolder" style="color:rgba(220, 53, 69, 0.7);">
                                        {{ $getCountSiswaStatusPerKelas['tidakNaikKelas'][$index] }}
                                    </h4>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('dashboard')
        <script>
            window.onload = function() {
                // Grafik pertama (Jumlah Siswa Per Kelas)
                var barChart1 = document.getElementById("bar-siswa-kelas").getContext("2d");

                new Chart(barChart1, {
                    type: "bar",
                    data: {
                        labels: @json($getCountSiswaPerKelas['kelasData']),
                        datasets: [{
                            label: "Siswa",
                            tension: 0.4,
                            borderWidth: 0,
                            borderRadius: 4,
                            borderSkipped: false,
                            backgroundColor: @json($getCountSiswaPerKelas['warnaBar']),
                            data: @json($getCountSiswaPerKelas['jumlahSiswa']),
                            maxBarThickness: 6
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    suggestedMin: 0,
                                    suggestedMax: 500,
                                    beginAtZero: true,
                                    padding: 15,
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                    color: "#fff"
                                },
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false
                                },
                                ticks: {
                                    display: false
                                },
                            },
                        },
                    },
                });

                // Grafik kedua (Naik Kelas vs Tidak Naik Kelas)
                var barChart2 = document.getElementById("bar-status-siswa").getContext("2d");

                new Chart(barChart2, {
                    type: "bar",
                    data: {
                        labels: @json($getCountSiswaStatusPerKelas['kelasData']),
                        datasets: [{
                                label: "Naik Kelas",
                                tension: 0.4,
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                                backgroundColor: "rgba(40, 167, 69, 0.7)",
                                data: @json($getCountSiswaStatusPerKelas['naikKelas']),
                                maxBarThickness: 6
                            },
                            {
                                label: "Tidak Naik Kelas",
                                tension: 0.4,
                                borderWidth: 0,
                                borderRadius: 4,
                                borderSkipped: false,
                                backgroundColor: "rgba(220, 53, 69, 0.7)",
                                data: @json($getCountSiswaStatusPerKelas['tidakNaikKelas']),
                                maxBarThickness: 6
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                },
                                ticks: {
                                    suggestedMin: 0,
                                    beginAtZero: true,
                                    padding: 15,
                                    font: {
                                        size: 14,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                    color: "#fff"
                                },
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false
                                },
                                ticks: {
                                    display: true
                                },
                            },
                        },
                    },
                });
            }
        </script>
    @endpush
