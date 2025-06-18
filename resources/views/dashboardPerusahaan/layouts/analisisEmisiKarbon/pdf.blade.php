<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analisis Emisi Karbon</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        @page {
            margin: 40px;
        }

        body {
            font-size: 12px;
            color: #1f2937;
            line-height: 1.6;
            background-color: #ffffff;
        }

        h1 {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 0.2rem;
            color: #111827;
        }

        .text-sm {
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .filter-box {
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
            border-radius: 6px;
            padding: 0.75rem;
            margin-bottom: 1rem;
        }

        .filter-box p {
            margin: 0;
            font-size: 12px;
        }

        .filter-box .title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 1.5rem;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }

        .summary-row {
            background-color: #f9fafb;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <h1>{{ $analysisName }}</h1>
    <p class="text-sm">{{ $companyName }} | {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    {{-- Filter Info (Optional) --}}
    {{-- @if(!empty($filters['nama_karyawan']) || !empty($filters['nama_transportasi']) || !empty($filters['nama_bahan_bakar']) || !empty($filters['tanggal_perjalanan']))
        <div class="filter-box">
            <p class="title">Filter Aktif:</p>
            @if($filters['nama_karyawan']) <p class="mb-1">Nama Karyawan: {{ $filters['nama_karyawan'] }}</p> @endif
            @if($filters['nama_transportasi']) <p class="mb-1">Transportasi: {{ $filters['nama_transportasi'] }}</p> @endif
            @if($filters['nama_bahan_bakar']) <p class="mb-1">Bahan Bakar: {{ $filters['nama_bahan_bakar'] }}</p> @endif
            @if($filters['tanggal_perjalanan']) <p class="mb-1">Tanggal: {{ $filters['tanggal_perjalanan'] }}</p> @endif
        </div>
    @endif --}}

    {{-- Tabel Data --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Transportasi</th>
                <th>Bahan Bakar</th>
                <th>Alamat</th>
                <th>Tanggal Perjalanan</th>
                <th>Durasi (menit)</th>
                <th>Total Emisi Karbon (CO2e)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalKarbon = 0; @endphp
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->karyawanPerusahaan->nama_karyawan }}</td>
                    <td>{{ $item->Transportasi->nama_transportasi }}</td>
                    <td>{{ $item->BahanBakar->nama_bahan_bakar }}</td>
                    <td>{{ $item->Alamat->alamat }}</td>
                    <td>{{ $item->tanggal_perjalanan }}</td>
                    <td class="text-right">{{ $item->durasi_perjalanan }}</td>
                    <td class="text-right">{{ number_format($item->total_emisi_karbon, 2) }}</td>
                </tr>
                @php $totalKarbon += $item->total_emisi_karbon; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="summary-row">
                <td colspan="7">Total Emisi Karbon (CO2e)</td>
                <td class="text-right">{{ number_format($totalKarbon, 2) }}</td>
            </tr>
            <tr class="summary-row">
                <td colspan="7">Total Data</td>
                <td class="text-right">{{ count($data) }}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
