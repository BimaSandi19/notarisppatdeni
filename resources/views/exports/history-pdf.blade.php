<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tagihan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2c5aa0;
        }
        
        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #2c5aa0;
        }
        
        .header p {
            font-size: 11px;
            color: #666;
            margin: 3px 0;
        }
        
        .info-bar {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            padding: 10px 12px;
            background-color: #f8f9fa;
            border-left: 4px solid #2c5aa0;
            font-size: 10px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        .info-bar table {
            width: 100%;
            margin: 0;
            border: none;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        .info-bar td {
            border: none;
            padding: 0 10px;
            font-size: 10px;
            vertical-align: middle;
        }
        
        .info-bar strong {
            color: #2c5aa0;
        }
        
        .info-left {
            text-align: left;
        }
        
        .info-center {
            text-align: center;
        }
        
        .info-right {
            text-align: right;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background-color: #2c5aa0 !important;
            color: white !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        table th {
            padding: 10px 6px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #2c5aa0;
            background-color: #2c5aa0 !important;
            color: white !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }
        
        table td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            font-size: 9px;
            vertical-align: top;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .status-lunas {
            color: #28a745 !important;
            font-weight: bold;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .status-dibatalkan {
            color: #dc3545 !important;
            font-weight: bold;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
            font-size: 9px;
            color: #666;
            width: 100%;
        }
        
        .footer table {
            width: 100%;
            margin: 0;
            border: none;
        }
        
        .footer td {
            border: none;
            padding: 0;
            font-size: 9px;
        }
        
        .footer-left {
            text-align: left;
            width: 50%;
        }
        
        .footer-right {
            text-align: right;
            width: 50%;
        }
        
        .total-box {
            margin-top: 15px;
            padding: 12px;
            background-color: #e8f4f8 !important;
            border-left: 4px solid #2c5aa0;
            text-align: right;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        .total-box strong {
            font-size: 13px;
            color: #2c5aa0;
        }
        
        /* Column widths */
        .col-no { width: 4%; }
        .col-nama { width: 18%; }
        .col-kwitansi { width: 12%; }
        .col-nominal { width: 14%; }
        .col-tanggal { width: 10%; }
        .col-status { width: 11%; }
        .col-keterangan { width: 31%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>RIWAYAT TAGIHAN</h1>
        <p>Laporan Riwayat Pembayaran Tagihan</p>
        @if(isset($filters['q']) && !empty($filters['q']))
            <p style="margin-top: 5px; font-weight: bold;">📌 Pencarian: "{{ $filters['q'] }}"</p>
        @endif
        @if(isset($filters['status']) && !empty($filters['status']) && $filters['status'] !== 'all')
            <p style="font-weight: bold;">🔖 Status: {{ $filters['status'] }}</p>
        @endif
        @if(isset($filters['sort']) && !empty($filters['sort']))
            <p style="font-weight: bold;">
                📊 Urutan: 
                @switch($filters['sort'])
                    @case('tanggal-desc')
                        Tanggal (Terbaru - Terlama)
                        @break
                    @case('tanggal-asc')
                        Tanggal (Terlama - Terbaru)
                        @break
                    @case('nominal-desc')
                        Nominal (Tertinggi - Terendah)
                        @break
                    @case('nominal-asc')
                        Nominal (Terendah - Tertinggi)
                        @break
                @endswitch
            </p>
        @endif
    </div>
    
    <div class="info-bar">
        <table>
            <tr>
                <td class="info-left"><strong>Tanggal Cetak:</strong> {{ date('d-m-Y H:i:s') }}</td>
                <td class="info-center"><strong>Total Data:</strong> {{ $data->count() }} tagihan</td>
                <td class="info-right"><strong>Dicetak oleh:</strong> {{ Auth::user()->name ?? 'Admin' }}</td>
            </tr>
        </table>
    </div>
    
    <table>
        <thead>
            <tr>
                <th class="col-no text-center">No</th>
                <th class="col-nama">Nama Nasabah</th>
                <th class="col-kwitansi">Nomor Kwitansi</th>
                <th class="col-nominal text-right">Nominal Tagihan</th>
                <th class="col-tanggal text-center">Tanggal</th>
                <th class="col-status text-center">Status</th>
                <th class="col-keterangan">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $d->nama_nasabah }}</td>
                    <td>{{ $d->nomor_kwitansi }}</td>
                    <td class="text-right">Rp. {{ number_format($d->nominal_tagihan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($d->tanggal_tagihan)->format('d-m-Y') }}</td>
                    <td class="text-center {{ $d->status_pembayaran === 'Lunas' ? 'status-lunas' : 'status-dibatalkan' }}">
                        {{ $d->status_pembayaran }}
                    </td>
                    <td>{{ $d->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px; color: #999;">
                        Tidak ada data untuk dicetak
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($data->count() > 0)
        <div class="total-box">
            <strong>Total Tagihan Lunas: Rp. {{ number_format($totalTagihanLunas, 0, ',', '.') }}</strong>
        </div>
    @endif
    
    <div class="footer">
        <table>
            <tr>
                <td class="footer-left"><strong>Website DN</strong> - Sistem Manajemen Tagihan</td>
                <td class="footer-right">Dicetak pada: {{ date('d F Y, H:i:s') }} WIB</td>
            </tr>
        </table>
    </div>
</body>
</html>
