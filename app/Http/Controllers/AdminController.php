<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Events\ReminderSaved;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ======= KARTU =======
        $tagihanBelumLunas     = Reminder::count();
        $tagihanLunas          = History::where('status_pembayaran', 'Lunas')->count();
        $tagihanDibatalkan     = History::where('status_pembayaran', 'Dibatalkan')->count();

        // catatan: dua baris ini memang menimpa hasil History; dibiarkan sesuai kode kamu
        $totalTagihanAktif     = History::where('status_pembayaran', 'Pending')->count();
        $totalTagihanAktif     = Reminder::where('status_pembayaran', 'Pending')->count();

        $totalNominalTagihan   = History::sum('nominal_tagihan');
        $totalNominalTagihan   = Reminder::sum('nominal_tagihan');

        $totalTagihanLunas     = History::where('status_pembayaran', 'Lunas')->sum('nominal_tagihan');
        $totalTagihanDibatalkan = History::where('status_pembayaran', 'Dibatalkan')->sum('nominal_tagihan');

        // ======= DROPDOWN TAHUN & DATA CHART =======
        $currentYear = now()->year;
        $year = (int) $request->query('year', $currentYear);

        // daftar tahun yang ada datanya di history
        $yearsWithData = History::selectRaw('YEAR(tanggal_tagihan) as y')
            ->distinct()->orderBy('y', 'desc')->pluck('y')->toArray();

        // gabungkan: tahun ini + tahun yang ada data (unik & desc)
        $years = array_unique(array_merge([$currentYear], $yearsWithData));
        rsort($years);

        // label bulan (ID)
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // ambil agregat per bulan untuk tahun terpilih
        $rowsLunas = History::selectRaw('MONTH(tanggal_tagihan) m, SUM(nominal_tagihan) total')
            ->whereYear('tanggal_tagihan', $year)
            ->where('status_pembayaran', 'Lunas')
            ->groupBy('m')->pluck('total', 'm');

        $rowsCanceled = History::selectRaw('MONTH(tanggal_tagihan) m, SUM(nominal_tagihan) total')
            ->whereYear('tanggal_tagihan', $year)
            ->where('status_pembayaran', 'Dibatalkan')
            ->groupBy('m')->pluck('total', 'm');

        // pastikan selalu 12 titik (Jan–Des)
        $totals = $totalsDibatalkan = [];
        for ($i = 1; $i <= 12; $i++) {
            $totals[]            = (int) ($rowsLunas[$i] ?? 0);
            $totalsDibatalkan[]  = (int) ($rowsCanceled[$i] ?? 0);
        }

        $useDummy = false;

        if ($useDummy) {
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $totals = [2000000, 2500000, 3000000, 2800000, 3200000, 3500000, 3300000, 3400000, 3100000, 3600000, 3700000, 3900000];
            $totalsDibatalkan = [500000, 200000, 300000, 400000, 100000, 200000, 300000, 200000, 100000, 50000, 0, 100000];
        } else {
            // query aslimu di sini
        }

        // ======= KIRIM KE VIEW =======
        return view('admin.dashboard', [
            // kartu
            'tagihanLunas'            => $tagihanLunas,
            'tagihanDibatalkan'       => $tagihanDibatalkan,
            'totalTagihanAktif'       => $totalTagihanAktif,
            'totalNominalTagihan'     => $totalNominalTagihan,
            'totalTagihanLunas'       => $totalTagihanLunas,
            'totalTagihanDibatalkan'  => $totalTagihanDibatalkan,

            // chart
            'months'           => $months,
            'totals'           => $totals,
            'totalsDibatalkan' => $totalsDibatalkan,
            'years'            => $years,
            'year'             => $year,
        ]);
    }

    /**
     * Get quick stats untuk modal dashboard
     */
    public function getQuickStats(Request $request)
    {
        $type = $request->query('type', 'lunas');
        $data = [];

        switch ($type) {
            case 'lunas':
                // 10 tagihan Lunas terbaru
                $data = History::where('status_pembayaran', 'Lunas')
                    ->orderBy('tanggal_tagihan', 'desc')
                    ->limit(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->nama_nasabah,
                            'kwitansi' => $item->nomor_kwitansi,
                            'nominal' => 'Rp ' . number_format($item->nominal_tagihan, 0, ',', '.'),
                            'tanggal' => Carbon::parse($item->tanggal_tagihan)->format('d M Y'),
                        ];
                    });
                break;

            case 'dibatalkan':
                // 10 tagihan Dibatalkan terbaru
                $data = History::where('status_pembayaran', 'Dibatalkan')
                    ->orderBy('tanggal_tagihan', 'desc')
                    ->limit(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->nama_nasabah,
                            'kwitansi' => $item->nomor_kwitansi,
                            'nominal' => 'Rp ' . number_format($item->nominal_tagihan, 0, ',', '.'),
                            'tanggal' => Carbon::parse($item->tanggal_tagihan)->format('d M Y'),
                        ];
                    });
                break;

            case 'belum-lunas':
                // 10 tagihan Belum Lunas mendekati jatuh tempo (terlama dulu)
                $data = Reminder::where('status_pembayaran', 'Pending')
                    ->orderBy('tanggal_tagihan', 'asc')
                    ->limit(10)
                    ->get()
                    ->map(function ($item) {
                        $tanggal = Carbon::parse($item->tanggal_tagihan);
                        $now = Carbon::now();
                        // Cek apakah tanggal tagihan sudah lewat dari hari ini
                        $isOverdue = $tanggal->lt($now->startOfDay());

                        return [
                            'nama' => $item->nama_nasabah,
                            'kwitansi' => $item->nomor_kwitansi,
                            'nominal' => 'Rp ' . number_format($item->nominal_tagihan, 0, ',', '.'),
                            'tanggal' => $tanggal->format('d M Y'),
                            'is_overdue' => $isOverdue,
                        ];
                    });
                break;

            case 'nominal-tinggi':
                // 10 tagihan dengan nominal tertinggi (dari Belum Lunas)
                $data = Reminder::where('status_pembayaran', 'Pending')
                    ->orderBy('nominal_tagihan', 'desc')
                    ->limit(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->nama_nasabah,
                            'kwitansi' => $item->nomor_kwitansi,
                            'nominal' => 'Rp ' . number_format($item->nominal_tagihan, 0, ',', '.'),
                            'tanggal' => Carbon::parse($item->tanggal_tagihan)->format('d M Y'),
                        ];
                    });
                break;

            default:
                return response()->json(['error' => 'Invalid type'], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'count' => $data->count(),
        ]);
    }


    public function reminder(Request $request)
    {
        // Server-side search: ambil query 'q' dari querystring
        $q = $request->query('q', null);

        // Server-side sort: ambil query 'sort' dari querystring
        $sort = $request->query('sort', null);

        $query = Reminder::query();

        // Apply search filter
        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_nasabah', 'like', "%{$q}%")
                    ->orWhere('nomor_kwitansi', 'like', "%{$q}%")
                    ->orWhere('keterangan', 'like', "%{$q}%");
            });
        }

        // Apply sorting
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
                // Default sorting: data terbaru ditambahkan (created_at DESC)
                $query->orderBy('created_at', 'desc');
                break;
        }

        // total nominal for the filtered query
        $totalTagihan = (clone $query)->sum('nominal_tagihan');

        // paginate and preserve query string
        $data = $query->paginate(10)->onEachSide(2)->withQueryString();

        return view('admin.reminder', ['data' => $data, 'totalTagihan' => $totalTagihan]);
    }



    public function history(Request $request)
    {
        // Query builder untuk history
        $query = History::query();

        // Server-side search (jika ada parameter 'q')
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_nasabah', 'like', '%' . $search . '%')
                    ->orWhere('nomor_kwitansi', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
            });
        }

        // Server-side filter by status (jika ada parameter 'status')
        if ($request->has('status') && !empty($request->status) && $request->status !== 'all') {
            $query->where('status_pembayaran', $request->status);
        }

        // Server-side sort (jika ada parameter 'sort')
        $sort = $request->query('sort', null);
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
                // Default sorting: data terbaru muncul pertama (created_at DESC)
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Ambil data dengan pagination
        $data = $query->paginate(10)
            ->onEachSide(2)
            ->withQueryString();

        // Hitung total nominal tagihan lunas
        $totalTagihanLunas = History::where('status_pembayaran', 'Lunas')->sum('nominal_tagihan');

        // Kirim data dan total tagihan lunas ke view
        return view('admin.history', compact('data', 'totalTagihanLunas'));
    }

    public function getAllHistory()
    {
        $data = DB::table('history')->get(); // Ambil semua data dari tabel 'history'
        return response()->json($data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.modalReminder');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_nasabah' => 'required|string|max:255',
            'nomor_kwitansi' => 'required|string|max:255',
            'nominal_tagihan' => 'required|string',
            'status_pembayaran' => 'required|string',
            'keterangan' => 'nullable|string',
            'tanggal_tagihan' => 'required|date',
        ]);

        // Menghapus titik dari nominal_tagihan untuk mengubahnya menjadi angka
        $nominalTagihan = str_replace('.', '', $validated['nominal_tagihan']);

        try {
            // Menyimpan data ke database menggunakan Eloquent dengan nominal_tagihan yang telah dimodifikasi
            $reminder = Reminder::create([
                'nama_nasabah' => $validated['nama_nasabah'],
                'nomor_kwitansi' => $validated['nomor_kwitansi'],
                'nominal_tagihan' => $nominalTagihan,
                'status_pembayaran' => $validated['status_pembayaran'],
                'keterangan' => $validated['keterangan'] ?? null,
                'tanggal_tagihan' => $validated['tanggal_tagihan'],
                'user_id' => Auth::id(),
            ]);

            // Redirect ke halaman pertama tanpa parameter sort (default: created_at DESC)
            // Ini memastikan data baru langsung terlihat di halaman pertama
            return redirect()->route('admin.reminder')->with('success', 'Reminder berhasil ditambahkan.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error duplicate entry dari UNIQUE constraint
            if ($e->getCode() == 23000) { // SQLSTATE code untuk integrity constraint violation
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Tagihan dengan data yang sama sudah ada. Tidak bisa menambahkan data duplikat.');
            }

            // Error lainnya, throw ulang
            throw $e;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Hapus format titik dari nominal_tagihan
        $nominalTagihan = str_replace('.', '', $request->nominal_tagihan);

        $upreminder = Reminder::findOrFail($request->reminder_id);

        // Update nominal tagihan
        $upreminder->nominal_tagihan = $nominalTagihan;

        // Update other fields (nomor_kwitansi readonly di form, tapi tetap di-submit dengan value sama)
        $upreminder->update($request->except('nominal_tagihan'));

        // Cek apakah status pembayaran diubah menjadi Lunas atau Dibatalkan
        $statusBaru = $request->status_pembayaran;

        if ($statusBaru === 'Lunas' || $statusBaru === 'Dibatalkan') {
            // Pindahkan data ke tabel history
            DB::table('history')->insert([
                'nama_nasabah' => $upreminder->nama_nasabah,
                'nomor_kwitansi' => $upreminder->nomor_kwitansi,
                'nominal_tagihan' => $upreminder->nominal_tagihan,
                'status_pembayaran' => $upreminder->status_pembayaran,
                'keterangan' => $upreminder->keterangan,
                'tanggal_tagihan' => $upreminder->tanggal_tagihan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Hapus data dari tabel reminders
            $upreminder->delete();

            // Ambil parameter halaman dan query pencarian dari request
            $page = $request->input('page', 1);
            $q = $request->input('q', '');

            // Redirect dengan pesan sukses
            return redirect()->route('admin.reminder', ['page' => $page, 'q' => $q])
                ->with('success', 'Tagihan berhasil diperbarui dan dipindahkan ke Riwayat dengan status ' . $statusBaru);
        }

        // Jika status masih Pending, tetap di halaman reminder
        $page = $request->input('page', 1);
        $q = $request->input('q', '');

        return redirect()->route('admin.reminder', ['page' => $page, 'q' => $q])
            ->with('success', 'Tagihan berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $reminder = Reminder::findOrFail($id);

        // Tandai reminder sebagai dibatalkan
        $reminder->is_canceled = true;
        $reminder->status_pembayaran = 'Dibatalkan';
        $reminder->save();

        // Pindahkan data ke tabel history
        DB::table('history')->insert([
            'nama_nasabah' => $reminder->nama_nasabah,
            'nomor_kwitansi' => $reminder->nomor_kwitansi,
            'nominal_tagihan' => $reminder->nominal_tagihan,
            'status_pembayaran' => $reminder->status_pembayaran,
            'keterangan' => $reminder->keterangan,
            'tanggal_tagihan' => $reminder->tanggal_tagihan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hapus data dari tabel reminders
        $reminder->delete();

        // Ambil parameter halaman dan query pencarian dari request
        $page = $request->input('page', 1);
        $q = $request->input('q', null);

        $params = ['page' => $page];
        if ($q !== null) {
            $params['q'] = $q;
        }

        // Redirect ke halaman yang sama (preserve search)
        return redirect()->route('admin.reminder', $params)
            ->with('success', 'Reminder berhasil dibatalkan.');
    }

    /**
     * Approve the specified resource.
     */
    public function approve(Request $request, $id)
    {
        $reminder = Reminder::findOrFail($id);

        // Tandai reminder sebagai di-approve
        $reminder->is_approved = true;
        $reminder->status_pembayaran = 'Lunas';
        $reminder->save();

        // Pindahkan data ke tabel history
        DB::table('history')->insert([
            'nama_nasabah' => $reminder->nama_nasabah,
            'nomor_kwitansi' => $reminder->nomor_kwitansi,
            'nominal_tagihan' => $reminder->nominal_tagihan,
            'status_pembayaran' => $reminder->status_pembayaran,
            'keterangan' => $reminder->keterangan,
            'tanggal_tagihan' => $reminder->tanggal_tagihan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hapus data dari tabel reminders
        $reminder->delete();

        // Ambil parameter halaman dan query pencarian dari request
        $page = $request->input('page', 1);
        $q = $request->input('q', null);

        $params = ['page' => $page];
        if ($q !== null) {
            $params['q'] = $q;
        }

        // Redirect ke halaman yang sama (preserve search)
        return redirect()->route('admin.reminder', $params)
            ->with('success', 'Reminder berhasil disetujui.');
    }

    /**
     * Export History to Excel (All data with filters applied)
     */
    public function exportHistoryExcel(Request $request)
    {
        $filters = $request->only(['q', 'status', 'sort']);

        $filename = 'riwayat-tagihan-' . date('Y-m-d-His') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\HistoryExport($filters),
            $filename
        );
    }

    /**
     * Export History to PDF (All data with filters applied)
     */
    public function exportHistoryPdf(Request $request)
    {
        // Build query with filters (same logic as history method)
        $query = History::query();

        // Apply search filter
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_nasabah', 'like', '%' . $search . '%')
                    ->orWhere('nomor_kwitansi', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status) && $request->status !== 'all') {
            $query->where('status_pembayaran', $request->status);
        }

        // Apply sort
        $sort = $request->query('sort', null);
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

        // Get ALL data without pagination
        $data = $query->get();

        // Calculate total
        $totalTagihanLunas = History::where('status_pembayaran', 'Lunas')->sum('nominal_tagihan');

        // Load PDF view with better layout
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.history-pdf', [
            'data' => $data,
            'totalTagihanLunas' => $totalTagihanLunas,
            'filters' => $request->only(['q', 'status', 'sort'])
        ]);

        // Set paper size and orientation
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('riwayat-tagihan-' . date('Y-m-d-His') . '.pdf');
    }

    /**
     * Print History (All data with filters applied)
     * Opens in new window/tab with auto-print trigger
     */
    public function printHistory(Request $request)
    {
        // Build query with filters (same logic as history & export methods)
        $query = History::query();

        // Apply search filter
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama_nasabah', 'like', '%' . $search . '%')
                    ->orWhere('nomor_kwitansi', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter
        if ($request->has('status') && !empty($request->status) && $request->status !== 'all') {
            $query->where('status_pembayaran', $request->status);
        }

        // Apply sort
        $sort = $request->query('sort', null);
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

        // Get ALL data without pagination
        $data = $query->get();

        // Calculate total
        $totalTagihanLunas = History::where('status_pembayaran', 'Lunas')->sum('nominal_tagihan');

        // Load print view (clean HTML for printing)
        return view('exports.history-print', [
            'data' => $data,
            'totalTagihanLunas' => $totalTagihanLunas,
            'filters' => $request->only(['q', 'status', 'sort'])
        ]);
    }
}
