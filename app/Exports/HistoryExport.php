<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistoryExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $query;
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
        $this->buildQuery();
    }

    protected function buildQuery()
    {
        $query = History::query();

        // Apply search filter
        if (isset($this->filters['q']) && !empty($this->filters['q'])) {
            $search = $this->filters['q'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_nasabah', 'like', '%' . $search . '%')
                    ->orWhere('nomor_kwitansi', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter
        if (isset($this->filters['status']) && !empty($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->where('status_pembayaran', $this->filters['status']);
        }

        // Apply sort
        $sort = $this->filters['sort'] ?? null;
        switch ($sort) {
            case 'tanggal-desc':
                $query->orderBy('tanggal_tagihan', 'desc');
                break;
            case 'tanggal-asc':
                $query->orderBy('tanggal_tagihan', 'asc');
                break;
            case 'nominal-desc':
                $query->orderBy('nominal_tagihan', 'desc');
                break;
            case 'nominal-asc':
                $query->orderBy('nominal_tagihan', 'asc');
                break;
            default:
                $query->orderBy('tanggal_tagihan', 'desc');
                break;
        }

        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Nasabah',
            'Nomor Kwitansi',
            'Nominal Tagihan',
            'Tanggal Tagihan',
            'Status Pembayaran',
            'Keterangan',
        ];
    }

    public function map($history): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $history->nama_nasabah,
            $history->nomor_kwitansi,
            'Rp. ' . number_format($history->nominal_tagihan, 0, ',', '.'),
            \Carbon\Carbon::parse($history->tanggal_tagihan)->format('d-m-Y'),
            $history->status_pembayaran,
            $history->keterangan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 25,  // Nama Nasabah
            'C' => 20,  // Nomor Kwitansi
            'D' => 20,  // Nominal Tagihan
            'E' => 18,  // Tanggal Tagihan
            'F' => 20,  // Status Pembayaran
            'G' => 35,  // Keterangan
        ];
    }
}
