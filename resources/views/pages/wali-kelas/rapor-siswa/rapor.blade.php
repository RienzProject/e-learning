<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Belajar (Rapor)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .center {
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            border-bottom: 2px solid #343a40;
            display: inline-block;
            padding-bottom: 10px;
        }

        h2.small-margin {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            font-size: 13px;
            vertical-align: top;
        }

        .info-table td:nth-child(odd) {
            font-weight: bold;
        }

        .info-table td:nth-child(even) {
            padding-right: 20px;
        }

        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table-bordered th {
            background-color: white;
            text-align: center;
        }

        .table-ketidakhadiran {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: 36px;
        }

        .table-ketidakhadiran td,
        .table-ketidakhadiran th {
            border: 1px solid black;
            padding: 8px;
        }

        .table-ketidakhadiran th {
            text-align: center;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
            border-collapse: collapse;
        }

        .signature-table td {
            text-align: center;
            vertical-align: top;
            padding: 40px 20px 20px 20px;
        }

        .parent-signature {
            margin-top: 40px;
        }

        .keterangan {
            width: 50%;
            margin: 20px auto;
            font-size: 12px;
            text-align: left;
        }

        .signature {
            margin-top: 20px;
            width: 100%;
            display: table;
        }

        .signature div {
            display: table-cell;
            text-align: center;
            vertical-align: bottom;
            padding: 10px;
        }

        .center {
            text-align: center;
        }

        .signature .right {
            text-align: right;
        }

        .parent-signature {
            margin-top: 85px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td><img src="{{ public_path('assets/img/logo-sekolah.png') }}" alt=""
                    style="width: 100px; height: 100px;"></td>
            <td class="center">
                <font size="4"><b>LAPORAN HASIL BELAJAR <br> (RAPOR) SD NEGERI 009 MARANG KAYU</b></font> <br>
                <font size="2">Alamat: Jl. Batu Menetes RT 17,
                    Marang Kayu, Sebuntal,
                    Kode Pos: 75385,
                    Kabupaten Kutai Kartanegara,
                    Provinsi Kalimantan Timur</font>
            </td>
        </tr>
    </table>
    <div class="container">
        <table class="info-table">
            <tr>
                <td>Nama Peserta Didik</td>
                <td>: {{ $siswa->nama }}</td>
                <td>Kelas</td>
                <td>: {{ $siswa->kelasSemester->kelas->nama }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $siswa->NISN }}</td>
                <td>Semester</td>
                <td>: {{ $siswa->kelasSemester->semester->nama }}</td>
            </tr>
            <tr>
                <td>Sekolah</td>
                <td>: SD Negeri 009 Marangkayu</td>
                <td>Tahun Pelajaran</td>
                <td>: {{ $siswa->kelasSemester->semester->awal_tahun_ajaran }} /
                    {{ $siswa->kelasSemester->semester->akhir_tahun_ajaran }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Jl. Batu Menetes</td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table mt-4 table-bordered">
                <thead>
                    <tr style="font-size: 14px;">
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Mata Pelajaran</th>
                        <th style="width: 15%;">Nilai Akhir</th>
                        <th style="width: 55%;">Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaMataPelajaran as $index => $item)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->mataPelajaran->nama }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item->nilai_akhir ?? '-' }}</td>
                            <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                {{ $item->capaianKompetensi->catatan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr style="font-size: 14px;">
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Muatan Pelajaran</th>
                        <th style="width: 15%;">Nilai Akhir</th>
                        <th style="width: 55%;">Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaMuatanPelajaran as $index => $item)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->mataPelajaran->nama }}</td>
                            <td class="align-middle" style="text-align: center;">{{ $item->nilai_akhir ?? '-' }}</td>
                            <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                {{ $item->capaianKompetensi->catatan ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <h4 class="small-margin">MUATAN LOKAL</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr style="font-size: 14px;">
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Ekstrakulikuler</th>
                        <th style="width: 15%;">Predikat</th>
                        <th style="width: 55%;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekstrakulikuler as $index => $item)
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-center align-middle">{{ $item->ekstrakulikuler->nama }}</td>
                            <td class="text-center align-middle">{{ $item->predikat }}</td>
                            <td style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                {{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <div style="display: flex; justify-content: space-between;">
                <table class="table mt-4 table-ketidakhadiran" style="width: 50%;">
                    <thead>
                        <tr style="font-size: 14px;">
                            <th colspan="2" style="text-align: center;">Ketidakhadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensiGrouped as $item)
                            <tr>
                                <td style="width: 50%;">{{ $item->status_presensi }}</td>
                                <td style="width: 50%;">{{ $item->count }} hari</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="width: 50%; text-align: left; font-size: 12px; padding-left: 10px; margin-top: 10px;">
                    <p>Keterangan:</p>
                    @if ($statusNaikKelas == 'Naik Kelas')
                        <p>Berdasarkan pencapaian kompetensi pada Semester {{ $siswa->kelasSemester->semester->nama }},
                            peserta didik dinyatakan naik ke Kelas berikutnya.</p>
                    @elseif ($statusNaikKelas == 'Tidak Naik Kelas')
                        <p>Berdasarkan pencapaian kompetensi pada Semester {{ $siswa->kelasSemester->semester->nama }},
                            peserta didik dinyatakan harus mengulang di Kelas {{ $siswa->kelasSemester->kelas->nama }}
                            Semester {{ $siswa->kelasSemester->semester->nama }}.
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="signature">
            <div>
                <p>Orang Tua,</p>
                <br><br>
                <p class="parent-signature">.......................................................</p>
            </div>
            <div>
                <p>Marangkayu, <?php echo \Carbon\Carbon::now()->isoFormat('D MMMM YYYY'); ?></p>
                <p>Guru Kelas {{ $user->waliKelas->kelas->nama }}</p>
                <br><br><br>
                <p>{{ $user->name }}</p>
                <p>NIP. {{ $user->NIP }}</p>
            </div>
        </div>
        <div class="center">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p>{{ $kepalaSekolah->name }}</p>
            <p>NIP. {{ $kepalaSekolah->NIP }}</p>
        </div>
    </div>
</body>

</html>
