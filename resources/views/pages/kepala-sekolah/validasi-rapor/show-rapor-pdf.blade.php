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

        header {
            text-align: center;
            margin-bottom: 10px;
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
    <header>
        <h2 class="small-margin">LAPORAN HASIL BELAJAR</h2>
        <h2 class="small-margin">(RAPOR)</h2>
    </header>
    <div class="container">
        <table class="info-table">
            <tr>
                <td>Nama Peserta Didik</td>
                <td>: {{ $siswa->nama }}</td>
                <td>Kelas</td>
                <td>: {{ $kelasSemesterSebelumnya->kelas->nama }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: {{ $siswa->NISN }}</td>
                <td>Fase</td>
                <td>: </td>
            </tr>
            <tr>
                <td>Sekolah</td>
                <td>: SD Negeri 009 Marangkayu</td>
                <td>Semester</td>
                <td>: {{ $kelasSemesterSebelumnya->semester->nama }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Jl. Batu Menetes</td>
                <td>Tahun Pelajaran</td>
                <td>: {{ $siswa->kelasSemester->kelas->periode->tahun_ajaran }}</td>
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
                    @foreach ($data as $index => $item)
                        @if ($item->mataPelajaran->kategori->nama == 'Mata Pelajaran')
                            <tr style="font-size: 12px;">
                                <td style="text-align: center">{{ $index + 1 }}</td>
                                <td>{{ $item->mataPelajaran->nama }}</td>
                                <td style="text-align: center">{{ $item->nilai_akhir }}</td>
                                <td>tes</td>
                            </tr>
                        @endif
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
                    @foreach ($data as $index => $item)
                        @if ($item->mataPelajaran->kategori->nama == 'Muatan Pelajaran')
                            <tr style="font-size: 12px;">
                                <td style="text-align: center">{{ $index + 1 }}</td>
                                <td>{{ $item->mataPelajaran->nama }}</td>
                                <td style="text-align: center">{{ $item->nilai_akhir }}</td>
                                <td>tes</td>
                            </tr>
                        @endif
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
                        <tr style="font-size: 12px;">
                            <td style="text-align: center">{{ $index + 1 }}</td>
                            <td>{{ $item->ekstrakulikuler->nama }}</td>
                            <td style="text-align: center;">{{ $item->predikat }}</td>
                            <td style="text-align: justify;">{{ $item->keterangan }}</td>
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
                            <th colspan="3" style="text-align: center;">Ketidakhadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="font-size: 12px;">
                            <td style="border-right: none; width: 60%">Sakit</td>
                            <td style="border-left: none; border-right: none; width: 20%">0</td>
                            <td style="border-left: none; width: 20%">hari</td>
                        </tr>
                        <tr style="font-size: 12px;">
                            <td style="border-right: none; width: 60%">Izin</td>
                            <td style="border-left: none; border-right: none; width: 20%">2</td>
                            <td style="border-left: none; width: 20%">hari</td>
                        </tr>
                        <tr style="font-size: 12px;">
                            <td style="border-right: none; width: 60%">Tanpa Keterangan</td>
                            <td style="border-left: none; border-right: none; width: 20%">2</td>
                            <td style="border-left: none; width: 20%">hari</td>
                        </tr>
                    </tbody>
                </table>
                <div style="width: 50%; text-align: left; font-size: 12px; padding-left: 10px; margin-top: 10px;">
                    <p>Keterangan:</p>
                    @if ($rapor->status_siswa == 'Lulus')
                        <p>Berdasarkan pencapaian kompetensi pada Semester {{ $rapor->kelasSemester->semester->nama }},
                            peserta didik dinyatakan naik ke Kelas {{ $siswa->kelasSemester->kelas->nama }} Semester {{ $siswa->kelasSemester->semester->nama }}.</p>
                    @elseif ($rapor->status_siswa == 'Tidak Lulus')
                        <p>Berdasarkan pencapaian kompetensi pada Semester {{ $rapor->kelasSemester->semester->nama }},
                            peserta didik dinyatakan harus mengulang di Kelas {{ $siswa->kelasSemester->kelas->nama }} Semester {{ $siswa->kelasSemester->semester->nama }}.
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
                <p>Guru Kelas {{ $waliKelas->kelas->nama }}</p>
                <br><br><br>
                <p>{{ $waliKelas->user->name }}</p>
                <p>NIP. {{ $waliKelas->user->NIP }}</p>
            </div>
        </div>
        <div class="center">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p>{{ $user->name }}</p>
            <p>NIP. {{ $user->NIP }}</p>
        </div>
    </div>
</body>

</html>
